<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class notAdmin
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
        $user = \App\User::where('email', $request->email)->first();
        if ($user->role->role_name != 'admin'){
            return redirect("/");
        } else {
            return redirect("/admin");
        }
        return $next($request);

    }
}
