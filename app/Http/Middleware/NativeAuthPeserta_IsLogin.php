<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class NativeAuthPeserta_IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $username = $request->session()->get('no_induk');
        $password = $request->session()->get('password');


        $peserta = DB::table('peserta')
            ->whereRaw('no_induk= ? and password = ? ', [$username, $password])
            ->get();

        // dd($users);

        if (count($peserta)< 1 ) {
            $request->session()->flash('status', 'Maaf Anda Belum Login!');
            return  redirect('peserta/login');
        } 

        return $next($request);
    }
}
