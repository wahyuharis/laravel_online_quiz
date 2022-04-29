<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();



        // for ($i = 0; $i <= 100; $i++) {
        //     DB::table('kelompok_peserta')->insert([
        //         'nama_kelompok_peserta' => Str::random(10),
        //     ]);
        // }

        // for ($i = 0; $i <= 100; $i++) {
        //     DB::table('peserta')->insert([
        //         'id_kelompok_peserta' => 6,
        //         'no_induk' => Str::random(10),
        //         'password' => Str::random(10),
        //         'nama_peserta' => Str::random(10),
        //         'keterangan_lain' => '[]',
        //     ]);
        // }

        for ($i = 0; $i <= 100; $i++) {

            DB::table('kelompok_kuis')->insert([
                'nama_kuis' => Str::random(10),
                'detail' => Str::random(10)
            ]);
        }
    }
}
