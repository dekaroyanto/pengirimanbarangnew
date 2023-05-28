<?php

use App\Http\Controllers\HomedashController;
use App\Http\Controllers\LoginController;
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
})->middleware('auth');

// Route::get('/', [HomedashController::class, 'index']);

Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan')->middleware('auth');

Route::get('/tambahpesanan', [PesananController::class, 'tambahpesanan'])->name('tambahpesanan')->middleware('auth');
Route::post('/insertpesanan', [PesananController::class, 'insertpesanan'])->name('insertpesanan')->middleware('auth');

Route::get('/tampilkanpesanan/{id}', [PesananController::class, 'tampilkanpesanan'])->name('tampilkanpesanan')->middleware('auth');
Route::post('/updatepesanan/{id}', [PesananController::class, 'updatepesanan'])->name('updatepesanan')->middleware('auth');

Route::get('/deletepesanan/{id}', [PesananController::class, 'deletepesanan'])->name('deletepesanan')->middleware('auth');

// export PDF
Route::get('/exportpdf', [PesananController::class, 'exportpdf'])->name('exportpdf')->middleware('auth');



//login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');

//register
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/registeruser', [LoginController::class, 'registeruser'])->name('registeruser');

//logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
