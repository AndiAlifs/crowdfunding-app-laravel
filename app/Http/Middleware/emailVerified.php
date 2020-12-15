<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class emailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        $user = \App\Models\User::where('id',Auth::id())->first();
        if ($user->email_verified_at != null){
            return $next($request);
        } else {
            return response()->json([
                'message' => 'email anda belum terverifikasi'
            ]);
        }
    }
}
