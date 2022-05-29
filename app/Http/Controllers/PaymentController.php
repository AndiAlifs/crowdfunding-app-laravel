<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaymentController extends Controller
{   
    public function store()
    {
        $response_midtrans = $this->midtrans_store();

        return response()->json([
            'response_code' => '100',
            'response_msg' => 'succes',
            'data' => $response_midtrans
        ]);
    }

    protected function midtrans_store()
    {
        $server_key = base64_encode(env('MIDTRANS_SERVER_KEY'));
        $base_uri = env('MIDTRANS_BASE_URI');
        $uri = $base_uri.'/v2/charge';

        $client = new Client([
            'base_uri' => $base_uri,
        ]);

        $headers = [
            'Accept'            => 'application/json',
            'Authorization'     => 'Basic '.$server_key,
            'Content-Type'      => 'application/json',
        ];

        $body = [
            'payment_type' => 'permata',
            'transaction_details' => [
                "order_id" => uniqid(),
                "gross_amount" => 10000
            ]
        ];

        $res = $client->post('/v2/charge',[
            'headers' => $headers,
            'body' => json_encode($body)
        ]);

        return json_decode($res->getBody());
    }
}
