<?php

namespace App\Http\Middleware;

use App\Models;
use Closure;
use Illuminate\Http\Request;

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
        $user = Models\User::where('email', $request->email)->first();
        if ($user->role()->role_name == 'null'){
            return redirect("/");
        };
        return $next($request);
    }
}
