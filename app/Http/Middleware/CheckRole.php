<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    //LIST OF CONSTANT VALUE FOR MEMBER JABATAN
    public const KETUA = 1;
    public const SEKRETARIS = 2;
    public const BENDAHARA = 3;
    public const TAKMIR = 4;
    public const REMAS = 5;

    public function handle($request, Closure $next)
    {
        //hide untuk selain sekretaris dan ketua
        $sekretaris = array(self::KETUA, self::SEKRETARIS);

        //jika user terotentikasi merupakan ketua atau sekretaris bisa lanjutkan, jika tidak maka alihkan route '/' 
        $authUser = Auth::user();
        $inside_sekretaris = in_array($authUser->id_jabatan, $sekretaris);
        if ($inside_sekretaris) {
            return $next($request);
        }
        return redirect('/');
    }
}
