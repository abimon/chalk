<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Mpesa;
use App\Models\order;
use App\Models\product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
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
    function stkpush($phone, $amount, $serial)
    {
        //dd(request());
        $code = str_replace('+', '', substr('254', 0, 1)) . substr('254', 1);
        $originalStr = $phone;
        $prefix = substr($originalStr, 0, 1);
        $contact = str_replace('0', $code, $prefix) . substr($originalStr, 1);
        $url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $this->generate_token()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'BusinessShortCode' => env('MPESA_SHORT_CODE'),
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => date('YmdHis'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $contact, // replace this with your phone number
            'PartyB' => env('MPESA_SHORT_CODE'),
            'PhoneNumber' => $contact, // replace this with your phone number
            'CallBackURL' => 'https://jkusda.apekinc.top/api/v1/callback' . $serial,
            'AccountReference' => 'Receipt ' . $serial,
            'TransactionDesc' => $serial
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        $res = json_decode($curl_response);
        return $res;
        if ($res->ResponseCode == 0) {
            return response()->json('Success', 200);
        } else {
            return response()->json('Something wrong happened. Try  again.', 400);
        }
    }
    public function Callback($serial)
    {
        $res = request();
        Log::channel('mpesa')->info($res);
        Log::channel('mpesaErrors')->info((json_encode($res['Body'])));
        Mpesa::create([
            'TransactionType' => 'Paybill',
            'Receipt' => '$serial',
            'TransAmount' => $res['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'],
            'MpesaReceiptNumber' => $res['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'],
            'TransactionDate' => $res['Body']['stkCallback']['CallbackMetadata']['Item'][2]['Value'],
            'PhoneNumber' => $res['Body']['stkCallback']['CallbackMetadata']['Item'][3]['Value'],
            'response' => 'Success'
        ]);
        $response = new Response();
        $response->headers->set("Content-Type", "text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult" => "Success"]));
        return $response;
    }
    function makeOrder()
    {
        $carts = DB::table('carts')->where('buyer_id', (Auth()->user()->id))->join('products', 'carts.product_id', '=', 'products.id')->select('carts.*', 'products.price')->get();
        $total = 0;
        $phone = request()->phone;
        $receipt = 'HLC' . date('YmdHs');
        foreach ($carts  as $cart) {
            $total += ($cart->price) * ($cart->quantity);
        }
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
            'Amount' => $total,
            'PartyA' => $contact,
            'PartyB' => env('MPESA_SHORT_CODE'),
            'PhoneNumber' => $contact,
            'CallBackURL' => 'https://chalkorganic.apekinc.top/api/v1/callback/' . $receipt,
            'AccountReference' => 'Receipt ' . $receipt,
            'TransactionDesc' => $receipt
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        $res = json_decode($curl_response);
        // return $res;
        if ($res->ResponseCode == 0) {
            foreach ($carts as $cart) {
                order::create([
                    'buyer_id' => $cart->buyer_id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'pickup' => Auth()->user()->residence,
                    'more' => request()->more,
                    'receipt' => $receipt
                ]);
                cart::destroy($cart->id);
            }
            return redirect('/orders');
        } else {
            echo "<script>alert('Something wrong happened. Try  again.');</script>";
        }
    }
    function updateOrder($id)
    {
        order::where()->update([
            'payment' => request()->payment,
            'delivery' => request()->delivery,
        ]);
        return redirect()->back();
    }
    function viewOrder()
    {
        $orders = DB::table('orders')->where('buyer_id', (Auth()->user()->id))->join('products', 'orders.product_id', '=', 'products.id')->select('orders.*', 'products.product_name', 'products.path', 'products.price')->get();
        $data = [
            'orders' => $orders,
        ];
        return view('orders', $data);
    }
    function payOrder()
    {
        $order = order::where('id', request()->orderNo)->first();
        $item = product::where('id', $order->product_id)->first();
        $total = ($order->quantity) * ($item->price);
        // return [$order,$item];
        // return $total;
        $receipt = $order->receipt;
        $code = str_replace('+', '', substr('254', 0, 1)) . substr('254', 1);
        $originalStr = request()->phone;
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
            'Amount' => $total,
            'PartyA' => $contact,
            'PartyB' => env('MPESA_SHORT_CODE'),
            'PhoneNumber' => $contact,
            'CallBackURL' => 'https://chalkorganic.apekinc.top/api/v1/callback/' . $receipt,
            'AccountReference' => 'Receipt ' . $receipt,
            'TransactionDesc' => $receipt
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        $res = json_decode($curl_response);
        // return $res;
        $code = $res->ResponseCode;
        if ($code == 0) {
            return redirect('/orders');
        } else {
            echo "<script>alert('Something wrong happened. Try  again.');</script>";
        }
    }
    function orders()
    {
        $orders = DB::table('orders')->where('buyer_id', (Auth()->user()->id))->join('products', 'orders.product_id', '=', 'products.id')->join('users', 'users.id', '=', 'orders.buyer_id')->select('orders.*', 'products.product_name', 'products.price', 'users.name', 'users.contact')->get();
        $total = 0;
        $data = [
            'orders' => $orders,
        ];
        return view('ordersList', $data);
    }
}
