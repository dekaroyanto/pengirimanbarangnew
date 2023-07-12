<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pesanans')->insert([
            'kdpsn' => 'KRM-10001',
            'namabarang' => 'Brosur',
            'kategori' => 'printing',
            'alamat' => 'Permata Harjamukti B6 No 19 Jl. Pisces',
            'status' => 'proses'
        ]);
    }
}
