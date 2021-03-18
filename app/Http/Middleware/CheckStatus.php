<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    //LIST OF CONSTANT VALUE FOR MEMBER STATUS
    public const ACTIVE_MEMBER = 1;
    public const NON_ACTIVE_MEMBER = 2;
    public const UNVERIFIED_MEMBER = 3;

    public function handle($request, Closure $next)
    {
        //jika user belum terverifikasi
        if (Auth::user()->id_status == self::UNVERIFIED_MEMBER) {
            Auth::logout();
            return redirect('/login');
        } 
        else if (Auth::user()->id_status == self::NON_ACTIVE_MEMBER){
            return redirect('/');
        }
        return $next($request);        
    }
}
