<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Mpesa;
use App\Models\order;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{

    function generate_token()
    {

        $consumer_key = env('MPESA_CONSUMER_KEY');
        $consumer_secret = env('MPESA_CONSUMER_SECRET');
        $credentials = base64_encode($consumer_key . ":" . $consumer_secret);
        $url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic " . $credentials));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token = json_decode($curl_response);
        return $access_token->access_token;
    }
    public function lipaNaMpesaPassword()
    {
        $passkey = env('MPESA_PASSKEY');
        $BusinessShortCode = env('MPESA_SHORT_CODE');
        $timestamp = date('YmdHis');
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode . $passkey . $timestamp);
        return $lipa_na_mpesa_password;
    }
    public function Callback($id)
    {

        $res = request();
        Log::channel('mpesa')->info(json_encode(['whole' => $res['Body']]));
        // if ($res['Body']['stkCallback']['ResultCode'] == 0) {
        $message = $res['Body']['stkCallback']['ResultDesc'];
        $amount = $res['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
        $TransactionId = $res['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
        $phne = $res['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];
        Log::channel('mpesaSuccess')->info(json_encode(['whole' => $res['Body']]));
        Mpesa::create([
            'TransactionType' => 'Paybill',
            'Receipt' => $id,
            'MpesaReceiptNumber' =>$TransactionId,
            'TransactionDate' =>date('d-m-Y') ,
            'TransAmount' =>$amount,
            'PhoneNumber' => '+' . $phne,
            'response' => $message
        ]);
        $orders = order::where('receipt', $id)->get();
        foreach ($orders as $order) {
            order::where('id', $order->id)->update(['payment', 'Paid']);
            if ($order->product->category == 'Ebook') {
                $fileUrl = Storage::path($order->product->file_path);
                Mail::send('mails.message', [], function ($message) use ($fileUrl) {
                    $message->to(auth()->user()->email)->subject('Test mail attach');
                    $message->attach($fileUrl);
                });
            }
        }
        $response = new Response();
        $response->headers->set("Content-Type", "text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult" => "Success"]));
        return $response;
    }
    function Pay($codec, $contact, $amount, $state)
    {
        $phone = $contact;
        $amount = $amount;
        $code = str_replace('+', '', substr('254', 0, 1)) . substr('254', 1);
        $originalStr = $phone;
        $prefix = substr($originalStr, 0, 1);
        $contact = str_replace('0', $code, $prefix) . substr($originalStr, 1);
        $url = (env('MPESA_ENV') == 'live') ? 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest' : 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $this->generate_token()));
        $curl_post_data = [
            'BusinessShortCode' => env('MPESA_SHORT_CODE'),
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => date('YmdHis'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $contact,
            'PartyB' => env('MPESA_SHORT_CODE'),
            'PhoneNumber' => $contact,
            'CallBackURL' => 'https://healthandlifecentre.com/api/v1/callback/' . $codec,
            'AccountReference' => $state,
            'TransactionDesc' => $state,
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        $res = json_decode($curl_response);
        return $res;
    }

    public function index()
    {
        if (Auth()->user()->role == 'Admin') {
            $orders = order::all();
            return view('orders.show', compact('orders'))->with('products', 'buyer');
        } else {
            $orders = order::where('buyer_id', Auth()->user()->id)->get();
            return view('orders.index', compact('orders'))->with('products');
        }
    }

    public function create()
    {
        return view('product.create');
    }

    public function store()
    {
        $carts = cart::where('buyer_id', (Auth()->user()->id))->get();
        $total = 0;
        $phone = request()->phone;
        $receipt = 'HLC' . date('YmdHs');
        foreach ($carts  as $cart) {
            $total += ($cart->product->price) * ($cart->quantity);
        }
        $res = $this->Pay($receipt, $phone, $total, 'Product purchase. Receipt no. ' . $receipt);
        if ($res->ResponseCode == 0) {
            $orders = [];
            foreach ($carts as $cart) {
                $order = order::create([
                    'buyer_id' => $cart->buyer_id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'pickup' => Auth()->user()->residence,
                    'more' => request()->more,
                    'receipt' => $receipt
                ]);
                array_push($orders, $cart);
                cart::destroy($cart->id);
            }

            Mail::send('mails.order', ['orders' => $orders], function ($message) {
                $message->to(auth()->user()->email, auth()->user()->name)->subject('Receipt of an Order ' . date('d/m/Y'));
            });
            return redirect(route('order.index'));
        } else {
            echo "<script>alert('Something wrong happened. Try  again.');</script>";
        }
    }

    public function show($id)
    {
        $order = order::findOrFail($id);
        $res = $this->Pay($order->receipt, request()->phone, request()->amount, 'Settlement of order no. ' . $order->receipt);
        // return ($res->ResponseCode);
        if ($res->ResponseCode == 0) {
            return redirect()->back()->with('success', 'A payment pop-up message sent to your phone. Proceed to pay.');
        } else {
            return redirect()->back()->with('success', 'There was an error.');
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
