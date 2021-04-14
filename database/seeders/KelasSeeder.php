<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas = [
            ['Nama_Kelas' => 'TI 2A'],
            ['Nama_Kelas' => 'TI 2B'],
            ['Nama_Kelas' => 'TI 2C'],
            ['Nama_Kelas' => 'TI 2D'],
            ['Nama_Kelas' => 'TI 2E'],
            ['Nama_Kelas' => 'TI 2F'],
            ['Nama_Kelas' => 'TI 2G'],
            ['Nama_Kelas' => 'TI 2H'],
            ['Nama_Kelas' => 'TI 2I'],
        ];

        DB::table('kelas')->insert($kelas);
    }
}
