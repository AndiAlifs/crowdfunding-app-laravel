<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider){
        $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();

        return response()->json([
            'url' => $url
        ]);
    }

    public function handleProviderCallback($provider){
        $socialUser = Socialite::driver($provider)->stateless()->user();
        // dd($socialUser);

        if (!$socialUser){
            return response()->json([
                'response_code' => '01',
                'response_message' => 'login failed'
            ], 401);
        }

        $user = User::whereEmail($socialUser->email)->first();
        // dd($user);
        if (!$user){
            $user = User::create([
                'email' => $socialUser->email,
                'name' => $socialUser->name,
                'username' => $socialUser->name,
                'email_verified_at' => Carbon::now(),
            ]);
        };

        $data['user'] = $user;
        $data['token'] = auth()->login($user);

        return response()->json([
            'response_code' => '01',
            'response_message' => 'login success',
            'data' => $data
        ], 401);

    }
}
