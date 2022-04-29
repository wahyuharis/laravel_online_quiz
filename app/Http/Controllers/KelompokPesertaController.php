<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use Validator;

class KelompokPesertaController extends Controller
{
    //
    function index(Request $request)
    {
        $sess = $request->session()->all();

        $subtitle='';
        if($request->input('tambah')==1){
            $subtitle='Tambah';
        }
        if($request->input('edit')==1){
            $subtitle='Ubah';
        }
      
        $kelompok_peserta = DB::table('kelompok_peserta')
            ->get();


        $form = new stdClass();
        $form->primary_id = '';
        $form->nama_kelompok_peserta = '';

        if (!empty(trim($request->input('id')))) {
            $row = DB::table('kelompok_peserta')->where('id_kelompok_peserta', '=', $request->input('id'))
                ->first();

            $form->primary_id = $row->id_kelompok_peserta;
            $form->nama_kelompok_peserta = $row->nama_kelompok_peserta;
        }

        $content_data = [
            'kelompok_peserta' => $kelompok_peserta,
            'form' => $form
        ];

        $content = view('admin/kelompok_peserta', $content_data);

        $view_data = array(
            'contents' => $content,
            'title'=>'Kelompok Peserta '.$subtitle
        );

        return view('admin/layout_admin', $view_data);
    }

    function edit(Request $request)
    {
        $sess = $request->session()->all();


        $subtitle='Tambah';
        // if($request->input('tambah')==1){
        //     $subtitle='Tambah';
        // }

        $content = '';
        $view_data = array(
            'contents' => $content,
            'title'=>'Kelompok asd Peserta '.$subtitle
        );

        return view('admin/layout_admin', $view_data);
    }

    function submit(Request $request)
    {
        $success = false;
        $message = '';


        // echo "<pre>";
        // print_r($request->all());
        // die();

        $validation_rule = array();
        if (empty(trim($request->input('primary_id')))) {
            $validation_rule['nama_kelompok_peserta'] = 'required|max:255';
        } else {
            $validation_rule['nama_kelompok_peserta'] = 'required|max:255';
        }
        $validator = Validator::make($request->all(), $validation_rule);
        if ($validator->passes()) {
            $success = true;
        } else {
            $success = false;
            $err = $validator->errors()->all();
            foreach ($err as $err_msg) {
                $message .= '<p>' . $err_msg . "</p>";
            }
        }

        if ($success) {
            $insert = array();
            $insert['nama_kelompok_peserta'] = $request->input('nama_kelompok_peserta');

            if (empty(trim($request->input('primary_id')))) {
                DB::table('kelompok_peserta')->insert($insert);
            } else {

                DB::table('kelompok_peserta')
                    ->where(['id_kelompok_peserta' => $request->input('primary_id')])
                    ->update($insert);
            }
            $request->session()->flash('status', 'Data Telah Disimpan!');
        } else {
            $request->session()->flash('status_error', $message);
        }

        return redirect('admin/kelompok_peserta');
    }

    function delete(Request $request)
    {
        $request->session()->flash('status', 'Data Telah Dihapus!');

        $deleted = DB::table('kelompok_peserta')
            ->where('id_kelompok_peserta', '=', $request->input('id'))
            ->delete();

        return redirect('admin/kelompok_peserta');
    }
}

