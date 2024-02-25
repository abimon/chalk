<?php

namespace App\Http\Controllers;

use App\Models\Mpesa;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\Pickup;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::all();
        $data = [
            'products' => $products,
        ];
        return view('products.index', $data);
    }

    public function create()
    {
        $extension = request()->file('file')->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        request()->file('file')->storeAs('public/images/products', $filename);
        product::create([
            'product_name' => request()->name,
            'path' => $filename,
            'price' => request()->price,
            'details' => request()->desc,
            'category' => request()->category,
        ]);
        return redirect()->back();
    }
    public function store()
    {
        $products = product::all();
        $data = [
            'items' => $products,
        ];
        return view('products.stock', $data);
    }
    public function show($category)
    {
        $products = product::where('category',$category)->get();
        $data = [
            'products' => $products,
        ];
        return view('products.index', $data);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    function search(){
        $keyword=request()->search;
        $products = product::where('product_name','LIKE','%'.$keyword.'%')->get();
        $data = [
            'products' => $products,
        ];
        return view('products.index', $data);
    }
    public function destroy($id)
    {
        product::destroy($id);
        return redirect()->back();
    }
    public function transport(){
        $phone = request()->contact;
        
        $amount = 3000*(request()->duration);
        $service=Pickup::create([
            'name'=>request()->name,
            'contact'=>$phone,
            'location'=>request()->location,
            'desc'=>request()->desc,
            'duration'=>request()->duration,
            'date'=>request()->date,
            'value'=>$amount,
            'balance'=>$amount,
            
        ]);
        return view('pay',compact('service'));
    }
    
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
            'TransAmount' => $amount,
            'MpesaReceiptNumber' => $TransactionId,
            'TransactionDate' => date('d-m-Y'),
            'PhoneNumber' => '+' . $phne,
            'response' => $message
        ]);
        $student = Pickup::findOrFail($id);
        $student->balance -= $amount;
        $student->update();
        
        $response = new Response();
        $response->headers->set("Content-Type", "text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult" => "Success"]));
        return $response;
    }
    function Pay($codec)
    {
        $phone = request()->contact;
        $amount = request()->amount;
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
            'CallBackURL' => 'https://healthandlifecentre.com/api/services/callback/' . $codec,
            'AccountReference' => 'Transport Services Fee',
            'TransactionDesc' => 'Transport Services Fee',
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        $res = json_decode($curl_response);
        // return $res;
        if ($res->ResponseCode == 0) {
            return redirect('/');
        } else {
            return redirect()->back()->withInput()->with('message', "Error. Try again.");
        }
    }
    function updatePay($id)
    {
        $service = Pickup::find($id);
        return view('pay', compact('service'));
    }
}
