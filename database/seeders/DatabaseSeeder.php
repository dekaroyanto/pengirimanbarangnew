<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
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
        Pelanggan::factory(50)->create();

        Kurir::factory(6)->create();

        Pesanan::create([
            'kdpsn' => 'KRM-10001',
            'namabarang' => 'Stiker',
            'jumlah' => '10',
            'id_pelanggans' => '1',
            'tgl_msk' => '2023-07-31',
            'status' => 'proses',
            'image' => 'post-images/FajarhR2tWvs0Gb3mlDFOFPcHT0sGewSKDLKpLKh.png',
            'id_kurirs' => '1',
            'id_kendaraans' => '1',
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'kurir',
            'email' => 'kurir@gmail.com',
            'username' => 'kurir',
            'password' => Hash::make('kurir'),
            'role' => 'Kurir',
        ]);

        // Pelanggan::create([
        //     'namapelanggan' => 'pelanggan1',
        //     'notelp' => '0882006487100',
        //     'emailpelanggan' => 'pelanggan1@gmail.com',
        //     'alamatpelanggan' => 'Cirebon',
        // ]);

        // Pelanggan::create([
        //     'namapelanggan' => 'pelanggan2',
        //     'notelp' => '085316260660',
        //     'emailpelanggan' => 'pelanggan2@gmail.com',
        //     'alamatpelanggan' => 'Purbalingga',
        // ]);

        // Kurir::create([
        //     'nik' => '1234',
        //     'nama' => 'kurir1',
        //     'notelpkurir' => '081805032002',
        //     'kelamin' => 'Perempuan',
        //     'alamatkurir' => 'Blater',
        //     'emailkurir' => 'emailkurir@gmail.com',
        // ]);

        Kendaraan::create([
            'platno' => 'E1305DB',
            'jenis' => 'Mobil',
            'merk' => 'Toyota',
            'model' => 'Agya',
            'warna' => 'Merah'
        ]);
    }
}
