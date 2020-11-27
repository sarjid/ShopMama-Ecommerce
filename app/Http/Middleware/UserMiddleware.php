<?php

namespace App\Http\Middleware;

use App\Cart;
use App\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
           // user banned & Unbanned  
        if (Auth::check() && Auth::user()->isban) {
            $banned = Auth::user()->isban == '1';
            Auth::logout();

            if ($banned == 1) {
                $message = 'Your Account Has been Banned. Please Contact Administrator.';
            }
            return redirect()->route('login')->with('status', $message)->withErrors([
                'banned' => 'Your Account Has been Banned. Please Contact Administrator'
            ]);
        }

        // user active inactive 
        if (Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online' . Auth::user()->id, true, $expiresAt);
            
            // last seen 
            User::where('id',Auth::user()->id)->update(['last_seen' => Carbon::now()]);
        }
        return $next($request);
    }
}
