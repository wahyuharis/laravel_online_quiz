<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use stdClass;
use Validator;

class DaftarKuisController extends Controller
{
    //

    function index(Request $request)
    {
        $sess = $request->session()->all();
        $content_data = array();


        $kelompok_kuis = DB::table('kelompok_kuis')->select('*')->get();
        $content_data['kelompok_kuis'] = $kelompok_kuis;

        // dd($kelompok_peserta);

        $content = view('admin/daftar_kuis', $content_data);

        $view_data = array(
            'contents' => $content,
            'title' => 'Daftar Kuis'
        );

        return view('admin/layout_admin', $view_data);
    }

    function datatables(Request $request)
    {
        $sess = $request->session()->all();
        $content_data = array();

        // $where = '1';
        // $whereval = [];
        // if ($request->input('id_kelompok_peserta')) {
        $where = "1 and (kuis_item.id_kelompok_kuis = ?) ";
        $whereval = [$request->input('id_kelompok_kuis')];
        // }

        $daftar_kuis = DB::table('kuis_item')->selectRaw(
            "`id_kuis_item`,
            kuis_item.`id_kelompok_kuis`,
            kelompok_kuis.nama_kuis,
            `pertanyaan`,
            `ans_a`,
            `ans_b`,
            `ans_c`,
            `ans_d`,
            `key_ans`"
        )
            ->leftJoin('kelompok_kuis', 'kelompok_kuis.id_kelompok_kuis', '=', 'kuis_item.id_kelompok_kuis')
            ->whereRaw($where, $whereval)
            ->orderByDesc('id_kuis_item')
            ->get();

        // echo "<pre>";
        // print_r($daftar_kuis);
        // die();

        $res = array();
        foreach ($daftar_kuis as $row) {
            $buff = array();
            $buff[] = $row->id_kuis_item;

            $buff[] = '<div style="width:150px">'
                . '<a href="' . url('admin/daftar_kuis/edit/?id=' . $row->id_kuis_item) . '" 
                        class="btn btn-primary btn-sm" >edit</a>' .

                '&nbsp<a href="' . url('admin/daftar_kuis/delete/?id=' . $row->id_kuis_item) . '"  
                        class="btn btn-danger btn-sm delete_btn" >delete</a>'
                . '</div>';

            $buff[] = $row->nama_kuis;
            $buff[] = $row->pertanyaan;
            $buff[] = $row->ans_a;
            $buff[] = $row->ans_b;
            $buff[] = $row->ans_c;
            $buff[] = $row->ans_d;
            $buff[] = $row->key_ans;



            array_push($res, $buff);
        }

        $response = array();
        $response['data'] = $res;

        return response()->json($response);
    }

    function edit(Request $request)
    {
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
        $form->id_kelompok_kuis = '';
        $form->pertanyaan = '';
        $form->ans_a = '';
        $form->ans_b = '';
        $form->ans_c = '';
        $form->ans_d = '';
        $form->key_ans = '';

        $daftar_kuis = DB::table('kuis_item')->select('*')->where('id_kuis_item', '=', $id)->first();
        $kelompok_kuis = DB::table('kelompok_kuis')->select('*')->get();

        $key_ans_opt=array(
            'a','b','c','d'
        );



        // echo json_encode($kelompok_peserta);
        // die();

        if ($daftar_kuis) {
            $form->primary_id =  $daftar_kuis->id_kuis_item;
            $form->id_kelompok_kuis = $daftar_kuis->id_kelompok_kuis;
            $form->pertanyaan = $daftar_kuis->pertanyaan;
            $form->ans_a = $daftar_kuis->ans_a;
            $form->ans_b = $daftar_kuis->ans_b;
            $form->ans_c = $daftar_kuis->ans_c;
            $form->ans_d = $daftar_kuis->ans_d;
            $form->key_ans = $daftar_kuis->key_ans;
          
        }


        $content_data['form'] = $form;
        $content_data['daftar_kuis'] = $daftar_kuis;
        $content_data['kelompok_kuis'] = $kelompok_kuis;
        $content_data['key_ans_opt'] = $key_ans_opt;
        // resources/views/admin/daftar_kuis_edit.blade.php
        $content = view('admin/daftar_kuis_edit', $content_data);

        $view_data = array(
            'contents' => $content,
            'title' => 'Daftar Kuis '.$subtitle
        );

        return view('admin/layout_admin', $view_data);
    }

    function submit(Request $request){
        $success = false;
        $message = '';

        $post_data = $request->all();

        $primary_id = $post_data['primary_id'];
        // $post_data=

        // echo "<pre>";
        // print_r($post_data);
        // die();

        $validation_rule = array();
        $validation_rule['id_kelompok_kuis'] = 'required';
        $validation_rule['pertanyaan'] = 'required|max:255';
        $validation_rule['ans_a'] = 'required|max:255';
        $validation_rule['ans_b'] = 'required|max:255';
        $validation_rule['ans_c'] = 'required|max:255';
        $validation_rule['ans_d'] = 'required|max:255';
        $validation_rule['key_ans'] = 'required|max:255';
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
            $insert['id_kelompok_kuis'] = $post_data['id_kelompok_kuis'];
            $insert['pertanyaan'] = $post_data['pertanyaan'];
            $insert['ans_a'] = $post_data['ans_a'];
            $insert['ans_b'] = $post_data['ans_b'];
            $insert['ans_c'] = $post_data['ans_c'];
            $insert['ans_d'] = $post_data['ans_d'];
            $insert['key_ans'] = $post_data['key_ans'];

            if (empty(trim($primary_id))) {
                DB::table('kuis_item')->insert($insert);
            } else {

                DB::table('kuis_item')
                    ->where(['id_kuis_item' => $primary_id])
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

}
