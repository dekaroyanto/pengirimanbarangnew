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
            $table->string('namabarang');
            $table->string('jumlah');
            $table->date('tgl_msk');
            $table->date('tgl_krm')->nullable();
            $table->date('tgl_trm')->nullable();
            $table->enum('status', ['Selesai', 'Proses', 'Dikirim'])->nullable();
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
