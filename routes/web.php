<?php

use App\Http\Controllers\HomedashController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;
use App\Models\Pesanan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $jumlahpesanan = Pesanan::count();
    $data = Pesanan::latest()->paginate(3);
    return view('welcome', compact('jumlahpesanan', 'data'));
});

// Route::get('/', [HomedashController::class, 'index']);

Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');

Route::get('/tambahpesanan', [PesananController::class, 'tambahpesanan'])->name('tambahpesanan');
Route::post('/insertpesanan', [PesananController::class, 'insertpesanan'])->name('insertpesanan');

Route::get('/tampilkanpesanan/{id}', [PesananController::class, 'tampilkanpesanan'])->name('tampilkanpesanan');
Route::post('/updatepesanan/{id}', [PesananController::class, 'updatepesanan'])->name('updatepesanan');

Route::get('/deletepesanan/{id}', [PesananController::class, 'deletepesanan'])->name('deletepesanan');

// export PDF
Route::get('/exportpdf', [PesananController::class, 'exportpdf'])->name('exportpdf');

Route::get('/kurir', [PesananController::class, 'kurir'])->name('kurir');
