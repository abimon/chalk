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
                'MerchantRequestID' => '27967-98210968-1',
                'CheckoutRequestID' => 'ws_CO_26092023160158434701583807',
                'ResultCode' => 0,
                'ResultDesc' => 'The service request is processed successfully.',
                'CallbackMetadata' => 
                array (
                  'Item' => 
                  array (
                    0 => 
                    array (
                      'Name' => 'Amount',
                      'Value' => 1.0,
                    ),
                    1 => 
                    array (
                      'Name' => 'MpesaReceiptNumber',
                      'Value' => 'RIQ0SJ9022',
                    ),
                    2 => 
                    array (
                      'Name' => 'TransactionDate',
                      'Value' => 20230926160208,
                    ),
                    3 => 
                    array (
                      'Name' => 'PhoneNumber',
                      'Value' => 254701583807,
                    ),
                  ),
                ),
              ),
            ),
          ));
        $res=json_decode($response,true);
        Log::channel('mpesa')->info($res);
        $log=$res['Body']['stkCallback']['ResultCode'];
        Log::channel('mpesaErrors')->info($log);
        $request=$res;
        return $request['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
    }
}
