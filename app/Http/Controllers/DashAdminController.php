<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashAdminController extends Controller
{
    //
    function index(Request $request)
    {

        $sess = $request->session()->all();

        // dd($sess);

        $contents = '';
        $view_data = array(
            'contents' => $contents,
            'title'=>'Beranda'
        );

        return view('admin/layout_admin', $view_data);
    }
}
