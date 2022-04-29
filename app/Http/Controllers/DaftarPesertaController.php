<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use stdClass;
use Validator;


class DaftarPesertaController extends Controller
{
    // 
    function index(Request $request)
    {
        $sess = $request->session()->all();
        $content_data = array();

        $daftar_peserta = DB::table('peserta')->select(
            'peserta.id_peserta',
            'peserta.id_kelompok_peserta',
            'peserta.no_induk',
            'peserta.password',
            'peserta.nama_peserta',
            'peserta.keterangan_lain',
            'kelompok_peserta.nama_kelompok_peserta'
        )
            ->leftJoin('kelompok_peserta', 'peserta.id_kelompok_peserta', '=', 'kelompok_peserta.id_kelompok_peserta')
            ->get();
        // ->get();
        $kelompok_peserta = DB::table('kelompok_peserta')->select('*')->get();
        $content_data['daftar_peserta'] = $daftar_peserta;
        $content_data['kelompok_peserta'] = $kelompok_peserta;

        // dd($kelompok_peserta);

        $content = view('admin/daftar_peserta', $content_data);

        $view_data = array(
            'contents' => $content,
            'title' => 'Daftar Peserta'
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
        $where = "1 and (peserta.id_kelompok_peserta = ?) ";
        $whereval = [$request->input('id_kelompok_peserta')];
        // }

        $daftar_peserta = DB::table('peserta')->selectRaw(
            "peserta.id_peserta,
            peserta.no_induk,
            peserta.id_kelompok_peserta,
            peserta.password,
            peserta.nama_peserta,
            peserta.keterangan_lain,
            kelompok_peserta.nama_kelompok_peserta"
        )->leftJoin('kelompok_peserta', 'peserta.id_kelompok_peserta', '=', 'kelompok_peserta.id_kelompok_peserta')
            ->whereRaw($where, $whereval)
            ->orderByDesc('id_peserta')
            ->get();

        $res = array();
        foreach ($daftar_peserta as $row) {
            $buff = array();
            $buff[] = $row->id_peserta;

            $buff[] = '<a href="' . url('admin/daftar_peserta/edit/?id=' . $row->id_peserta) . '" 
                        class="btn btn-primary btn-sm" >edit</a>' .

                '&nbsp<a href="' . url('admin/daftar_peserta/delete/?id=' . $row->id_peserta) . '"  
                        class="btn btn-danger btn-sm delete_btn" >delete</a>';
            $buff[] = $row->no_induk;

            $buff[] = $row->nama_peserta;
            $buff[] = $row->nama_kelompok_peserta;

            $ket_lain_arr = json_decode($row->keterangan_lain, true);
            $html_ket_lain = '';;
            foreach ($ket_lain_arr as $rkl) {
                $html_ket_lain .= $rkl['parameter'] . " : " . $rkl['value'] . "<br>";
            }
            $buff[] = $html_ket_lain;

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
        $form->id_kelompok_peserta = '';
        $form->opt_kelompok_peserta = '';
        $form->no_induk = '';
        $form->password = '';
        $form->nama_peserta = '';
        $form->keterangan_lain = array();

        $daftar_peserta = DB::table('peserta')->select('*')->where('id_peserta', '=', $id)->first();
        $kelompok_peserta = DB::table('kelompok_peserta')->select('*')->get();

        $form->opt_kelompok_peserta = $kelompok_peserta;


        // echo json_encode($kelompok_peserta);
        // die();

        if ($daftar_peserta) {
            $form->primary_id =  $daftar_peserta->id_peserta;
            $form->id_kelompok_peserta = $daftar_peserta->id_kelompok_peserta;
            $form->no_induk = $daftar_peserta->no_induk;
            $form->password = '';
            $form->nama_peserta = $daftar_peserta->nama_peserta;

            if (is_array((json_decode($daftar_peserta->keterangan_lain, true)))) {
                $form->keterangan_lain = json_decode($daftar_peserta->keterangan_lain, true);
            }
        }


        $content_data['form'] = $form;

        $content = view('admin/daftar_peserta_edit', $content_data);

        $view_data = array(
            'contents' => $content,
            'title' => 'Daftar Peserta ' .  $subtitle
        );

        return view('admin/layout_admin', $view_data);
    }

    function submit(Request $request)
    {
        $success = false;
        $message = '';

        $post_data = json_decode($request->input('datapost'), true);

        $primary_id = $post_data['primary_id'];
        // $post_data=

        // echo "<pre>";
        // print_r($post_data);
        // die();

        $validation_rule = array();
        $validation_rule['no_induk'] = 'required|max:255';
        $validation_rule['nama_peserta'] = 'required|max:255';

        if (empty(trim($primary_id))) {
            $validation_rule['password'] = 'required|min:5';
        }

        $validator = Validator::make($post_data, $validation_rule);

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
            $insert['id_kelompok_peserta'] = $post_data['id_kelompok_peserta'];
            $insert['no_induk'] = $post_data['no_induk'];
            $insert['nama_peserta'] = $post_data['nama_peserta'];
            $insert['keterangan_lain'] = json_encode($post_data['detail_lain']);

            if (empty(trim($primary_id))) {
                $insert['password'] = md5($post_data['password']);
                DB::table('peserta')->insert($insert);
            } else {
                if (!empty(trim($post_data['password']))) {
                    $insert['password'] = md5($post_data['password']);
                }

                DB::table('peserta')
                    ->where(['id_peserta' => $primary_id])
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

    function delete(Request $request)
    {
        $request->session()->flash('status', 'Data Telah Dihapus!');

        $deleted = DB::table('peserta')
            ->where('id_peserta', '=', $request->input('id'))
            ->delete();

        return redirect('admin/daftar_peserta');
    }
}
