<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataken = Kendaraan::latest()->get();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        return view('datakendaraan', compact('dataken', 'infopesanan', 'infopelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambahkendaraan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'platno' => 'required|unique:kendaraans',
            'jenis' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'warna' => 'required',
        ], [
            'platno.required' => 'Masukan plat nomor kendaraan',
            'platno.unique' => 'plat nomor tidak boleh sama',
            'jenis.required' => 'Masukan jenis kendaraan',
            'merk.required' => 'Masukan merk kendaraan',
            'model.required' => 'Masukan model kendaraan',
            'warna.required' => 'Masukan warna kendaraan',
        ]);
        $dataken = Kendaraan::create($request->all());
        return Redirect()->route('datakendaraan')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function tampilkankendaraan($id)
    {
        $dataken = Kendaraan::find($id);
        // dd($data);

        return view('tampilkendaraan', compact('dataken'));
    }

    public function updatekendaraan(Request $request, $id)
    {
        $validated = $request->validate([
            'platno' => 'required',
            'jenis' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'warna' => 'required',
        ], [
            'platno.required' => 'Masukan plat nomor kendaraan',
            'jenis.required' => 'Masukan jenis kendaraan',
            'merk.required' => 'Masukan merk kendaraan',
            'model.required' => 'Masukan model kendaraan',
            'warna.required' => 'Masukan warna kendaraan',
        ]);
        $dataken = Kendaraan::find($id);
        $dataken->update($request->all());

        return redirect()->route('datakendaraan')->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function show(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        //
    }

    public function deletekendaraan($id)
    {
        $dataken = Kendaraan::find($id);
        $dataken->delete();

        return redirect()->route('datakendaraan')->with('success', 'Data Berhasil Di Hapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kendaraan $kendaraan)
    {
        //
    }
}
