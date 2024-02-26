<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use Illuminate\Http\Request;
use App\Models\Mpesa;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TransportController extends Controller
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
        
        $response = new Response();
        $response->headers->set("Content-Type", "text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult" => "Success"]));
        return $response;
    }
    function lipa($codec, $contact, $amount, $state)
    {
        $amount = $amount;
        $code = str_replace('+', '', substr('254', 0, 1)) . substr('254', 1);
        $prefix = substr($contact, 0, 1);
        $phone = str_replace('0', $code, $prefix) . substr($contact, 1);
        // dd($phone);
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
            'PartyA' => $phone,
            'PartyB' => env('MPESA_SHORT_CODE'),
            'PhoneNumber' => $phone,
            'CallBackURL' => 'https://healthandlifecentre.com/api/transport/callback/' . $codec,
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
        $items = Pickup::all();
        return view('transport.index',compact('items'));
    }

    public function create()
    {
        $amount = 2950;
        $service=Pickup::create([
            'name'=>request()->name,
            'contact'=>request()->contact,
            'location'=>request()->location,
            'desc'=>request()->desc,
            'duration'=>request()->duration,
            'value'=>(request()->duration)*2950,
            'balance'=>$amount,
            'date'=>request()->date
        ]);
        
        return view('transport.pay',compact('service'));
    }

    public function pay($id){
        $res=$this->lipa($id,request()->contact,request()->amount,'Payment for transport service.');
        if($res->ResponseCode==0){
            return redirect('/')->with('message','Payment successful');
        }
        else{
            return redirect()->back()->withInput()->with('error','Something went wrong. Please try again.');
        }
    }
    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        //
    }
}
