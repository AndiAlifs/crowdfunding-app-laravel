<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use App\Models\User;

class OTPController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ]);

        $user = User::where('id', $request->user_id)->first();

        $user -> regenerate_otp_code();

        $data['user'] = $user;

        return response()->json([
            'response_code' => '00',
            'response_message' => 'otp berhasil di regenerate, silahkan cek email anda',
            'data' => $data
        ], 200);
    }
}
