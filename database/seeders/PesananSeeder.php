<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'namabarang' => 'Pesanan1',
            'id_pelanggans' => '1',
            'status' => 'proses',
            'id_kurirs' => '1',
            'tgl_krm' => 'Masih Proses',
            'tgl_trm' => 'Belum Diterima'
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        DB::table('pelanggans')->insert([
            'namapelanggan' => 'pelanggan1',
            'notelp' => '0882006487100',
            'alamatpelanggan' => 'Cirebon',
        ]);

        DB::table('kurirs')->insert([
            'nama' => 'kurir1',
            'nik' => '1234',
        ]);
    }
}
