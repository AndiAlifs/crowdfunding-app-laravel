<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


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
            'email' => ['email','required','unique:users,email'],
            'name' => ['required']
        ]);

        User::create([
            'id' => (string)Str::uuid(),
            'username' => $request['username'],
            'email' => $request['email'],
            'name' => $request['name']
        ]);

        return response("telah teregister");
    }
}
