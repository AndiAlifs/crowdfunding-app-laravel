<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans;

class MidtransController extends Controller
{
    public function generate()
    {
        // Set your Merchant Server Key
        Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Midtrans\Config::$is3ds = true;

        $midtrans_transaction = Midtrans\Snap::createTransaction([
            'transaction_details' => [
                "order_id" => uniqid(),
                "gross_amount" => 10000
            ]
        ]);

        return response()->json([
            'response_code' => '100',
            'response_msg' => 'succes',
            'data' => $midtrans_transaction
        ]);
    }
}
