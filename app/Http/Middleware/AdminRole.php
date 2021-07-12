<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class AdminRole
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
        $role = session('user_role');

        if ($role === 'admin') return $next($request);

        \Auth::logout();
        return redirect()->route('auth');
    }
}
