<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        request()->validate([
            'username' => ['alpha_num','required','unique:users,username'],
            'email' => ['email','required','unique:users,email']
        ]);

        User::create([
            'username' => $request['username'],
            'email' => $request['email']
        ]);

        return response('Telah teregister');
    }
}
