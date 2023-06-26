<?php

namespace App\Models;

use App\Models\Kurir;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at'];


    public function kurirs()
    {
        return $this->belongsTo(Kurir::class, 'id_kurirs', 'id');
    }
}
