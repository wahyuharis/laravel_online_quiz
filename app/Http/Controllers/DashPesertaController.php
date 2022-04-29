<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashPesertaController extends Controller
{
    //
    function index(Request $request){
        $sess = $request->session()->all();

        // dd($sess);

        $contents = '';
        $view_data = array(
            'contents' => $contents,
            'title'=>'Beranda Peserta Test'
        );

        return view('peserta/layout_admin', $view_data);
    }
}
