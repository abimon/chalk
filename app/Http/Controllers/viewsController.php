<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class viewsController extends Controller
{
    function testLog()
    {

        $response = json_encode(array (
            'Body' => 
            array (
              'stkCallback' => 
              array (
                'MerchantRequestID' => '24719-163288506-1',
                'CheckoutRequestID' => 'ws_CO_26092023132612272701583807',
                'ResultCode' => 1037,
                'ResultDesc' => 'DS timeout user cannot be reached',
              ),
            ),
        ));
        $res=json_decode($response,true);
        Log::channel('mpesa')->info($res);
        $log=$res['Body']['stkCallback']['ResultCode'];
        Log::channel('mpesaErrors')->info($log);
        $request=$res;
        return $request['Body']['stkCallback']['ResultCode'];
    }
}
