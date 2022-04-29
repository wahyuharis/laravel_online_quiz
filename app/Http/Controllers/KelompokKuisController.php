<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use Validator;
use Whoops\Run;

class KelompokKuisController extends Controller
{
    //
    function index(Request $request)
    {
        $sess = $request->session()->all();

        $kelompok_kuis = DB::table('kelompok_kuis')
            ->get();

        $form = new stdClass();

        $content_data = [
            'kelompok_kuis' => $kelompok_kuis,
            'form' => $form
        ];

        $content = view('admin/kelompok_kuis', $content_data);

        $view_data = array(
            'contents' => $content,
            'title' => 'Kelompok Kuis'
        );

        return view('admin/layout_admin', $view_data);
    }

    function datatables(Request $request)
    {
        $request->session()->all();
        $content_data = array();

        $kelompok_kuis = DB::table('kelompok_kuis')
            ->selectRaw('`id_kelompok_kuis`,
        `nama_kuis`,
        `detail`,
        `waktu_mulai`,
        `waktu_selesai`
        ')->whereRaw('1')
        ->orderByDesc('id_kelompok_kuis')
            ->get();

        $res = array();
        foreach ($kelompok_kuis as $row) {
            $buff = array();

            $buff[] = $row->id_kelompok_kuis;
            $buff[] = '<a class="btn btn-primary btn-sm"
                        href="' . url('admin/kelompok_kuis/edit/?id=' . $row->id_kelompok_kuis)
                . '" >edit</a>'
                . '<a  class="btn btn-danger btn-sm delete_btn"
                        href="' . url('admin/kelompok_kuis/delete/?id=' . $row->id_kelompok_kuis)
                . '" >delete</a>';

            $buff[] = $row->nama_kuis;
            $buff[] = $row->waktu_mulai;
            $buff[] = $row->waktu_selesai;
            $buff[] = $row->detail;

            array_push($res, $buff);
        }

        $response = array();
        $response['data'] = $res;

        return response()->json($response);
    }

    function edit(Request $request){
        $id = $request->input('id');
        $id = trim($id);

        $subtitle = '';
        if (!empty(trim($id))) {
            $subtitle = 'Ubah';
        } else {
            $subtitle = 'Tambah';
        }

        $content_data = array();
        $form = new stdClass();

        $form->primary_id = '';
        $form->nama_kuis = '';
        $form->detail = '';
        $form->waktu_mulai = '';
        $form->waktu_selesai = '';

        $kelompok_kuis = DB::table('kelompok_kuis')->select('*')->where('id_kelompok_kuis', '=', $id)->first();

        if ($kelompok_kuis) {
            $form->primary_id = $kelompok_kuis->id_kelompok_kuis;
            $form->nama_kuis = $kelompok_kuis->nama_kuis;
            $form->detail =$kelompok_kuis->detail;
            $form->waktu_mulai = $kelompok_kuis->waktu_mulai;
            $form->waktu_selesai = $kelompok_kuis->waktu_selesai;
        }

        $content_data['form'] = $form;

        $content = view('admin/kelompok_kuis_edit', $content_data);

        $view_data = array(
            'contents' => $content,
            'title' => 'Kelompok Kuis '.$subtitle
        );

        return view('admin/layout_admin', $view_data);

    }

    function submit(Request $request)
    {

        $success = false;
        $message = '';

        $post_data = $request->all();

        $primary_id = $post_data['primary_id'];
        // $post_data=

        // echo "<pre>";
        // print_r($post_data);
        // die();

        $validation_rule = array();
        $validation_rule['nama_kuis'] = 'required|max:255';
        // $validation_rule['nama_peserta'] = 'required|max:255';

    

        $validator = Validator::make($post_data, $validation_rule);

        if ($validator->passes()) {
            $success = true;
        } else {
            $success = false;
            $err = $validator->errors()->all();
            foreach ($err as $err_msg) {
                $message .= '' . $err_msg . "\n";
            }
        }
        if ($success) {
            $insert = array();
            $insert['nama_kuis'] = $post_data['nama_kuis'];
            $insert['waktu_mulai'] = $post_data['waktu_mulai'];
            $insert['waktu_selesai'] = $post_data['waktu_selesai'];
            $insert['detail'] = $post_data['detail'];

            if (empty(trim($primary_id))) {
                DB::table('kelompok_kuis')->insert($insert);
            } else {

                DB::table('kelompok_kuis')
                    ->where(['id_kelompok_kuis' => $primary_id])
                    ->update($insert);
            }
            $request->session()->flash('status', 'Data Telah Disimpan!');
        }

        $response = array(
            'success' => $success,
            'message' => $message
        );
        return response()->json($response);

    }

    function delete(Request $request){
        $request->session()->flash('status', 'Data Telah Dihapus!');

        $deleted = DB::table('kelompok_kuis')
            ->where('id_kelompok_kuis', '=', $request->input('id'))
            ->delete();

        return redirect('admin/kelompok_kuis');
    }
}
