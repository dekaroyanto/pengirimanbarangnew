<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
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
        // $search = $request->search;
        // $data = Pesanan::where(function ($query) use ($search) {
        //     $query->where('kdpsn', 'LIKE', '%' . $search . '%')
        //         ->orWhere('namabarang', 'LIKE', '%' . $search . '%')
        //         ->orWhere('status', 'LIKE', '%' . $search . '%');
        // })->latest()->paginate(5);
        if ($request->has('search')) {
            $data = Pesanan::where('kdpsn', 'LIKE', '%' . $request->search . '%')
                ->orWhere('namabarang', 'LIKE', '%' . $request->search . '%')
                ->orWhere('$row->pelanggans->namapelanggan', 'LIKE', '%' . $request->search . '%')
                ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('status', 'LIKE', '%' . $request->search . '%')
                ->latest()->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Pesanan::latest()->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }
        $datakurir = Kurir::all();
        $datakendaraan = Kendaraan::all();
        $datapelanggan = Pelanggan::all();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        return view('datapesanan', compact('data', 'infopesanan', 'infopelanggan', 'datapelanggan', 'datakurir', 'datakendaraan'));
    }

    public function filter(Request $request)
    {
        $validated = $request->validate([

            'start_date' => 'required',
            'end_date' => 'required',
        ], [
            'start_date.required' => 'Masukan tanggal dengan benar',
            'end_date.required' => 'Masukan tanggal dengan benar'
        ]);

        $data = Pesanan::paginate(5);
        $datakendaraan = Kendaraan::all();
        $datakurir = Kurir::all();
        $datapelanggan = Pelanggan::all();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $data = Pesanan::whereDate('tgl_msk', '>=', $start_date)
            ->whereDate('tgl_msk', '<=', $end_date)
            ->paginate(5);
        return view('datapesanan', compact('data', 'infopesanan', 'infopelanggan', 'datapelanggan', 'datakurir', 'datakendaraan'));
    }

    public function tambahpesanan()
    {
        $datakendaraan = Kendaraan::all();
        $datakurir = Kurir::all();
        $datapelanggan = Pelanggan::all();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        return view('tambahpesanan', compact('infopesanan', 'infopelanggan', 'datapelanggan', 'datakurir', 'datakendaraan'));
    }


    public function insertpesanan(Request $request)
    {
        // $request->validate(
        //     [
        //         'kdpsn' => 'required',
        //         'kdpsn' => 'unique:pesanans',
        //     ],
        //     [
        //         'kdpsn.required' => 'Kode Pesanan tidak boleh kosong!',
        //         'kdpsn.unique' => 'Kode Pesanan tidak boleh sama!',
        //     ]
        // );

        $validated = $request->validate([
            'kdpsn' => 'required|unique:pesanans',
            'tgl_msk' => 'required',
            // 'penerima' => 'required|min:5',
            // 'notelp' => 'required',
            // 'namabarang' => 'required',
            // 'start_date' => 'required',
            // 'end_date' => 'required',
        ], [
            'kdpsn.required' => 'Kode Pesanan tidak boleh kosong!',
            'kdpsn.unique' => 'Kode Pesanan tidak boleh sama!',
            'tgl_msk.required' => 'Masukan tanggal!',
            // 'start_date.required' => 'Masukan Tanggal!',
            // 'end_date.required' => 'Masukan Tanggal'
        ]);


        $pelanggan = $request->id_pelanggans;
        // $pelanggans1 = new  Pelanggan(['id_pelanggans' => $pelanggan]);
        $kurir = $request->id_kurirs;
        $kendaraan = $request->id_kendaraans;

        $pelanggans1 = Pelanggan::find($pelanggan);
        $kurirs1 = Kurir::find($kurir);
        $kendaraans1 = Kendaraan::find($kendaraan);
        // dd($kurir, $request);



        $pesanan = new Pesanan;
        $pesanan->kdpsn = $request->kdpsn;
        $pesanan->namabarang = $request->hasilbarang;
        $pesanan->jumlah = $request->hasiljumlah;
        $pesanan->id_pelanggans = $request->id;
        $pesanan->id_kurirs = $request->id;
        $pesanan->id_kendaraans = $request->id;
        $pesanan->status = "proses";
        $pesanan->tgl_msk = $request->tgl_msk;
        $pesanan->tgl_krm = $request->tgl_krm;
        $pesanan->tgl_trm = $request->tgl_trm;
        // dd($pesanan);
        // dd($request);

        $pesanan->pelanggans()->associate($pelanggans1);
        $pesanan->kurirs()->associate($kurirs1);
        $pesanan->kendaraans()->associate($kendaraans1);
        $pesanan->save();


        // $data = Pesanan::create($request->all());
        // if ($request->hasFile('foto')) {
        //     $request->file('foto')->move('fotopesanan/', $request->file('foto')->getClientOriginalName());
        //     $data->foto = $request->file('foto')->getClientOriginalName();
        //     $data->save();
        // }
        return redirect()->route('pesanan')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function tampilkanpesanan($id)
    {
        $data = Pesanan::find($id);
        // dd($data);
        $datakurir = Kurir::all();
        $datakendaraan = Kendaraan::all();
        $datapelanggan = Pelanggan::all();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        return view('tampilpesanan', compact('data', 'datakurir', 'datapelanggan', 'infopesanan', 'infopelanggan', 'datakendaraan'));
    }


    public function updatepesanan(Request $request, $id)
    {
        $data = Pesanan::find($id);
        $data->update($request->all());

        if (session('halaman_url')) {
            return Redirect(session('halaman_url'))->with('success', 'Data Berhasil Di Ubah');
        }
        return view('pesanan', compact('data', 'datap'))->with('success', 'Data Berhasil Di Ubah');
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
