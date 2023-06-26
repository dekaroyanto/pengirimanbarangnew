<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            // $table->string('foto');
            $table->string('kdpsn');
            // $table->string('penerima');
            // $table->string('notelp');
            $table->string('namabarang');
            // $table->enum('kategori', ['Advertising', 'Printing']);
            // $table->string('prov');
            // $table->string('kota');
            // $table->string('kec');
            // $table->string('kdpos');
            $table->string('alamat');
            $table->string('tgl_krm')->nullable();
            $table->string('tgl_trm')->nullable();
            $table->enum('status', ['Selesai', 'Proses', 'Dikirim']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}
