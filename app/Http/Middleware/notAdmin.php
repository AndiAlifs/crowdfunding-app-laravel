<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = \App\Models\User::where('id',Auth::id())->first();
        if ($user->role->role_name != 'admin'){
            return response()->json([
                'message' => 'anda bukan admin'
            ]);
        } else {
            return redirect("/admin");
        }
        return $next($request);

    }
}
