<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthPesertaController extends Controller
{
    //
    function login()
    {

        return view('auth/peserta_login');
    }

    function login_submit(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $users = DB::table('peserta')
            ->whereRaw('( no_induk = ? ) and password = ? ', [$username, md5($password)])
            ->first();

        if ($users) {
            
            // echo "<pre>";
            // print_r((array) $users);
            // die();
            $userts_arr=(array) $users;

            session($userts_arr);

            // $request->session()->put('username',$username);
            // $request->session()->put('password',md5($username));

            return redirect('admin/dash');
        } else {

            $request->session()->flash('status', 'Gagal Login, Check Kembali username dan password!');
            return  redirect('admin/login');
        }
    }

    function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('peserta/login');
    }
}
