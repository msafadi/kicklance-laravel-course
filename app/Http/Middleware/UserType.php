<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$type)
    {
        $user = Auth::user();
        
        if (!in_array($user->type, $type)) {
            //Auth::logout();
            abort(403, 'You are not Admin!');
            return view('');
        }

        return $next($request);
    }
}
