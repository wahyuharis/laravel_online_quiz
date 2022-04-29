<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NativeAuth_IsLogin
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
        $username = $request->session()->get('username');
        $password = $request->session()->get('password');
        $users = DB::table('administrator')
            ->whereRaw('( username = ? or email = ? ) and password = ? ', [$username, $username, $password])
            ->get();

        // dd($users);

        if (count($users)< 1 ) {
            $request->session()->flash('status', 'Maaf Anda Belum Login!');
            return  redirect('admin/login');
        } 

        return $next($request);
    }
}
