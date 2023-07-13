<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use App\Models\Pelanggan;
use PDF;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
// use GuzzleHttp\Promise\Create;
// use App\Http\Controllers\Controller;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Pesanan::where('kdpsn', 'LIKE', '%' . $request->search . '%')
                ->orWhere('namabarang', 'LIKE', '%' . $request->search . '%')
                ->orWhere('alamat', 'LIKE', '%' . $request->search . '%')
                ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                ->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Pesanan::paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }
        $datakurir = Kurir::all();
        $datapelanggan = Pelanggan::all();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        return view('datapesanan', compact('data', 'infopesanan', 'infopelanggan', 'datapelanggan', 'datakurir'));
    }

    public function tambahpesanan()
    {
        $datakurir = Kurir::all();
        return view('tambahpesanan', compact('datakurir'));
    }

    public function insertpesanan(Request $request)
    {

        $validated = $request->validate([
            'kdpsn' => 'required|unique:pesanans',
            // 'penerima' => 'required|min:5',
            // 'notelp' => 'required',
            'namabarang' => 'required',
            // 'prov' => 'required',
            // 'kota' => 'required',
            // 'kec' => 'required',
            // 'kdpos' => 'required',
            // 'alamat' => 'required',
        ]);




        $data = Pesanan::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopesanan/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pesanan')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function tampilkanpesanan($id)
    {
        $data = Pesanan::find($id);
        // dd($data);
        $datakurir = Kurir::all();
        return view('tampilpesanan', compact('data', 'datakurir'));
    }


    public function updatepesanan(Request $request, $id)
    {
        $data = Pesanan::find($id);
        // $datap = Pelanggan::where('id_pelanggans', $id)->get();
        $data->update($request->all());
        if (session('halaman_url')) {
            return Redirect(session('halaman_url'))->with('success', 'Data Berhasil Di Ubah');
        }
        // $datakurir = Kurir::all();
        return view('pesanan', compact('data', 'datap'))->with('success', 'Data Berhasil Di Ubah');
        // return redirect()->route('pesanan', compact('datap'))->with('success', 'Data Berhasil Di Ubah');
    }

    public function deletepesanan($id)
    {
        $data = Pesanan::find($id);
        $data->delete();

        return redirect()->route('pesanan')->with('success', 'Data Berhasil Di Hapus');
    }

    public function exportpdf()
    {
        $data = Pesanan::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('datapesanan-pdf');
        return $pdf->download('pesanan.pdf');
    }
}
