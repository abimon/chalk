<?php

namespace App\Http\Controllers;

use App\Models\Mpesa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


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
    public function Callback($serial)
    {
        $res = request();
        if($res['Body']['stkCallback']['ResultCode']==0){
        Log::channel('mpesa')->info(json_encode(['massage'=>$res['Body']['stkCallback']['ResultDesc'],'Amount'=>$res['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'],'TransactionId'=>$res['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value']]));
        Mpesa::create([
                'TransactionType' => 'Paybill',
                'Receipt' => $serial,
                'TransAmount' => $res['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'],
                'MpesaReceiptNumber' => $res['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'],
                'TransactionDate' => $res['Body']['stkCallback']['CallbackMetadata']['Item'][2]['Value'],
                'PhoneNumber' => $res['Body']['stkCallback']['CallbackMetadata']['Item'][3]['Value'],
                'response' => 'Success'
            ]);
            $this->updateOrder($serial);
        }
        else{
            Log::channel('mpesaErrors')->info((json_encode($res['Body']['stkCallback']['ResultDesc'])));
        }
        $response = new Response();
        $response->headers->set("Content-Type", "text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult" => "Success"]));
        return $response;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
