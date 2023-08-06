<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
    //     // \App\Models\User::factory(10)->create();
    // }
    public function run()
    {
        DB::table('pesanans')->insert([
            'kdpsn' => 'KRM-10001',
            'namabarang' => 'Pesanan1',
            'jumlah' => '10',
            'alamat' => 'cirebon',
            'id_pelanggans' => '1',
            'tgl_msk' => '2023-07-31',
            'status' => 'proses',
            'id_kurirs' => '1',
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
            'kelamin' => 'Perempuan',
        ]);
    }
}
