<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use Validator;

class UjianDibukaController extends Controller
{
    //
    function  index(Request $request)
    {
        $sess = $request->session()->all();
        // dd($request->session()->get('id_peserta')  );
        // $sess->
        $id_peserta = $request->session()->get('id_peserta');

        $ujian_open = DB::table('kelompok_kuis')
            ->whereRaw('
        kelompok_kuis.id_kelompok_kuis not in 
        (
            SELECT kuis_selesai.id_kelompok_kuis FROM `kuis_selesai` WHERE 
            kuis_selesai.id_peserta= ? 
        )', [$id_peserta])
            ->get();

        // dd($ujian_open);

        $content_data = array();
        $content_data['ujian_open'] = $ujian_open;

        $contents = view('peserta/ujian_dibuka', $content_data);
        $view_data = array(
            'contents' => $contents,
            'title' => 'Ujian Dibuka'
        );

        return view('peserta/layout_admin', $view_data);
    }

    function mulai_ujian(Request $request)
    {
        $id_ujian = $request->input('id_ujian');

        $sess = $request->session()->all();

        $soal_test = DB::table('kuis_item')
            ->where('id_kelompok_kuis', '=', $id_ujian)
            ->get();

        $soal_arr = $soal_test->toArray();

        $request->session()->put('soal', $soal_arr);


        $content_data = array();

        $contents = view('peserta/mulai_ujian');
        $view_data = array(
            'contents' => $contents,
            'title' => 'Ujian Online'
        );

        return view('peserta/layout_admin', $view_data);
    }

    function ujian(Request $request)
    {
        $no_soal = $request->input('no');

        $sess = $request->session()->all();

        $soals = $request->session()->get('soal');

        if (count($soals) < 1) {
            return redirect('peserta/ujian_dibuka');
        }


        $content_data = array();
        $content_data['soals'] = $soals;

        $contents = view('peserta/ujian_jalan', $content_data);
        $view_data = array(
            'contents' => $contents,
            'title' => 'Ujian Online'
        );

        return view('peserta/layout_admin', $view_data);
    }

    function ujian_ans_submit(Request $request)
    {

        $post = $request->all();
        $sess = $request->session()->all();
        $id_kelompok_kuis = $sess['soal'][0]->id_kelompok_kuis;
        $soals = $sess['soal'];

        $soals2 = array();
        $i = 1;
        foreach ($soals as $row) {
            $soals2[$i] = $row->key_ans;
            $i++;
        }

        // echo "<pre>";
        // print_r($res);
        // die();

        $buff = array();
        foreach ($post  as $key => $val) {

            $key2 = str_replace('ans_', '', $key);
            $buff[$key2] = $val;
        }

        $length = count($soals2);
        // echo $leng;

        $nilai = 0;
        $nilai_max = $length;
        for ($incr = 1; $incr <= $length; $incr++) {
            if ($buff[$incr] == $soals2[$incr]) {
                $nilai = $nilai + 1;
            }
        }

        echo $nilai;
    }
}
