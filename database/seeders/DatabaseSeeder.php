<?php

namespace Database\Seeders;

use App\Models\Kurir;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\User;
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
        Pesanan::create([
            'kdpsn' => 'KRM-10001',
            'namabarang' => 'Pesanan1',
            'jumlah' => '10',
            'id_pelanggans' => '1',
            'tgl_msk' => '2023-07-31',
            'status' => 'proses',
            'id_kurirs' => '1',
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'kurir',
            'email' => 'kurir@admin.com',
            'username' => 'kurir',
            'password' => Hash::make('kurir'),
            'role' => 'user',
        ]);

        Pelanggan::create([
            'namapelanggan' => 'pelanggan1',
            'notelp' => '0882006487100',
            'alamatpelanggan' => 'Cirebon',
        ]);

        Pelanggan::create([
            'namapelanggan' => 'pelanggan2',
            'notelp' => '085316260660',
            'alamatpelanggan' => 'Purbalingga',
        ]);

        Kurir::create([
            'nama' => 'kurir1',
            'nik' => '1234',
            'kelamin' => 'Perempuan',
        ]);
    }
}
