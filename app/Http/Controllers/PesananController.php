<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use PDF;
use Illuminate\Http\Request;
// use GuzzleHttp\Promise\Create;
// use App\Http\Controllers\Controller;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Pesanan::where('kdpsn', 'LIKE', '%' . $request->search . '%')
                ->orWhere('namabarang', 'LIKE', '%' . $request->search . '%')
                ->orWhere('kategori', 'LIKE', '%' . $request->search . '%')
                ->orWhere('alamat', 'LIKE', '%' . $request->search . '%')
                ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                ->paginate(5);
        } else {
            $data = Pesanan::paginate(5);
        }
        return view('datapesanan', compact('data'));
    }

    public function tambahpesanan()
    {
        return view('tambahpesanan');
    }

    public function insertpesanan(Request $request)
    {
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

        return view('tampilpesanan', compact('data'));
    }


    public function updatepesanan(Request $request, $id)
    {
        $data = Pesanan::find($id);
        $data->update($request->all());

        return redirect()->route('pesanan')->with('success', 'Data Berhasil Di Ubah');
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
