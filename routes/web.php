<?php

use App\Models\User;
use App\Models\Kurir;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\HomedashController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PelangganController;

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



Route::group(['middleware' => ['auth', 'hakakses:admin']], function () {

    //PESANAN
    Route::get('/', function () {

        $jumlahpesanan = Pesanan::count();
        $jumlahuser = User::count();
        $data = Pesanan::latest()->paginate(3);
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        return view('welcome', compact('jumlahpesanan', 'jumlahuser', 'data', 'infopesanan', 'infopelanggan'));
    });
    Route::get('/tambahpesanan', [PesananController::class, 'tambahpesanan'])->name('tambahpesanan');
    Route::post('/insertpesanan', [PesananController::class, 'insertpesanan'])->name('insertpesanan');

    Route::get('/datapelanggan', [PelangganController::class, 'index'])->name('datapelanggan');
    Route::get('/deletepesanan/{id}', [PesananController::class, 'deletepesanan'])->name('deletepesanan');

    //USER
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/registeruser', [LoginController::class, 'registeruser'])->name('registeruser');
    Route::get('/register', [LoginController::class, 'index']);

    //PELANGGAN
    Route::get('/tambahpelanggan', [PelangganController::class, 'create'])->name('tambahpelanggan');
    Route::post('/insertdatapelanggan', [PelangganController::class, 'store'])->name('insertdatapelanggan');

    Route::get('/deletepelanggan/{id}', [PelangganController::class, 'deletepelanggan'])->name('deletepelanggan');

    Route::get('/tampilkanpelanggan/{id}', [PelangganController::class, 'tampilkanpelanggan'])->name('tampilkanpelanggan');
    Route::post('/updatepelanggan/{id}', [PelangganController::class, 'updatepelanggan'])->name('updatepelanggan');

    //kurir
    Route::get('/datakurir', [KurirController::class, 'index'])->name('datakurir');

    Route::get('/tambahkurir', [KurirController::class, 'create'])->name('tambahkurir');
    Route::post('/insertdatakurir', [KurirController::class, 'store'])->name('insertdatakurir');

    Route::get('/deletekurir/{id}', [KurirController::class, 'deletekurir'])->name('deletekurir');

    Route::get('/tampilkankurir/{id}', [KurirController::class, 'tampilkankurir'])->name('tampilkankurir');
    Route::post('/updatekurir/{id}', [KurirController::class, 'updatekurir'])->name('updatekurir');

    //kendaraan
    Route::get('/datakendaraan', [KendaraanController::class, 'index'])->name('datakendaraan');

    Route::get('/tambahkendaraan', [KendaraanController::class, 'create'])->name('tambahkendaraan');
    Route::post('/insertdatakendaraan', [KendaraanController::class, 'store'])->name('insertdatakendaraan');

    Route::get('/deletekendaraan/{id}', [KendaraanController::class, 'deletekendaraan'])->name('deletekendaraan');

    Route::get('/tampilkankendaraan/{id}', [KendaraanController::class, 'tampilkankendaraan'])->name('tampilkankendaraan');
    Route::post('/updatekendaraan/{id}', [KendaraanController::class, 'updatekendaraan'])->name('updatekendaraan');
});

// Route::get('/', [HomedashController::class, 'index']);
Route::get('/filter', [PesananController::class, 'filter']);
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan')->middleware('auth');





Route::get('/tampilkanpesanan/{id}', [PesananController::class, 'tampilkanpesanan'])->name('tampilkanpesanan')->middleware('auth');
Route::post('/updatepesanan/{id}', [PesananController::class, 'updatepesanan'])->name('updatepesanan')->middleware('auth');


// export PDF
Route::get('/exportpdf', [PesananController::class, 'exportpdf'])->name('exportpdf');



//login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');

//register


//logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//user
// Route::get('/register', 'LoginController@index');


// Route::get('/deletekurir/{id}', [KurirController::class, 'deletekurir'])->name('deletekurir');
// Route::post('/updatekurir/{id}', [KurirController::class, 'updatekurir'])->name('updatekurir');
