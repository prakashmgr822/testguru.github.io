<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        $admin = auth('admins')->user();
        $superAdmin = auth('superAdmin')->user();
        $user = auth()->user();
        if ($admin) {
            return redirect('/admins/home');
        } elseif ($superAdmin) {
            return redirect('/superadmin/home');
        } elseif ($user) {
            return redirect('/user/home');
        }

        return $next($request);
    }
}
