<?php

namespace App\Models;

use App\Models\Kurir;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at', 'tgl_krm', 'tgl_trm'];

    public function kurirs()
    {
        return $this->belongsTo(Kurir::class, 'id_kurirs', 'id');
    }

    public function pelanggans()
    {
        // return $this->belongsTo(Pelanggan::class, 'id_pelanggans', 'id');
        return $this->belongsTo(Pelanggan::class, 'id_pelanggans', 'id');
    }

    public function kendaraans()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraans', 'id');
    }
}
