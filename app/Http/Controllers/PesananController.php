<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Kurir;
use App\Models\Pesanan;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// use GuzzleHttp\Promise\Create;
// use App\Http\Controllers\Controller;

class PesananController extends Controller
{

    public function index(Request $request)
    {
        $data = Pesanan::latest()->get();
        $datakurir = Kurir::all();
        $datakendaraan = Kendaraan::all();
        $datapelanggan = Pelanggan::all();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        return view('datapesanan', compact('data', 'infopesanan', 'infopelanggan', 'datapelanggan', 'datakurir', 'datakendaraan'));
    }

    public function filter(Request $request)
    {
        $filterkurir = $request->filterkurir;
        $data = Pesanan::all();
        $datakurir = Kurir::all();
        $datakendaraan = Kendaraan::all();
        $datapelanggan = Pelanggan::all();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $data = Pesanan::where('id_kurirs', 'LIKE', '%' . $request->filterkurir . '%')
            ->get();
        return view('datapesanan', compact('data', 'infopesanan', 'infopelanggan', 'datapelanggan', 'datakurir', 'datakendaraan'));
    }

    public function cetakForm()
    {
        $data = Pesanan::latest()->get();
        $datakurir = Kurir::all();
        $datakendaraan = Kendaraan::all();
        $datapelanggan = Pelanggan::all();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        return view('cetak-pesanan-form', compact('data', 'infopesanan', 'infopelanggan', 'datapelanggan', 'datakurir', 'datakendaraan'));
    }

    public function cetakPesananPertanggal($tglawal, $tglakhir)
    {
        $data = Pesanan::latest()->get();
        $datakurir = Kurir::all();
        $datakendaraan = Kendaraan::all();
        $datapelanggan = Pelanggan::all();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        $cetakPertanggal = Pesanan::all()->whereBetween('tgl_msk', [$tglawal, $tglakhir]);

        return view('cetak-pesanan-pertanggal', compact('data', 'infopesanan', 'infopelanggan', 'datapelanggan', 'datakurir', 'datakendaraan', 'cetakPertanggal'));
    }

    public function cetakPesanan()
    {
        $data = Pesanan::all();
        $datakurir = Kurir::all();
        $datakendaraan = Kendaraan::all();
        $datapelanggan = Pelanggan::all();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        return view('cetak-pesanan', compact('data', 'infopesanan', 'infopelanggan', 'datapelanggan', 'datakurir', 'datakendaraan'));
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
        $validated = $request->validate([
            'kdpsn' => 'required|unique:pesanans',
            'tgl_msk' => 'required',
            'image' => 'image|file|max:5000',
            'image' => 'required'
        ], [
            'kdpsn.required' => 'Kode Pesanan tidak boleh kosong',
            'kdpsn.unique' => 'Kode Pesanan tidak boleh sama',
            'tgl_msk.required' => 'Masukan tanggal masuk',
            'image.required' => 'Masukan foto',

        ]);

        $pelanggan = $request->id_pelanggans;
        $kurir = $request->id_kurirs;
        $kendaraan = $request->id_kendaraans;
        $pelanggans1 = Pelanggan::find($pelanggan);
        $kurirs1 = Kurir::find($kurir);
        $kendaraans1 = Kendaraan::find($kendaraan);

        $pesanan = new Pesanan;
        $pesanan->kdpsn = $request->kdpsn;
        $pesanan->namabarang = $request->hasilbarang;
        $pesanan->jumlah = $request->hasiljumlah;
        $pesanan->id_pelanggans = $request->id;
        $pesanan->id_kurirs = $request->id;
        $pesanan->id_kendaraans = $request->id;
        $pesanan->status = "proses";
        $pesanan->image = $request->file('image')->store('post-images');
        $pesanan->tgl_msk = $request->tgl_msk;
        $pesanan->tgl_krm = $request->tgl_krm;
        $pesanan->tgl_trm = $request->tgl_trm;

        $pesanan->pelanggans()->associate($pelanggans1);
        $pesanan->kurirs()->associate($kurirs1);
        $pesanan->kendaraans()->associate($kendaraans1);
        $pesanan->save();

        return redirect()->route('pesanan')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function detailpesanan($id)
    {
        $data = Pesanan::find($id);
        // dd($data);
        $datakurir = Kurir::all();
        $datakendaraan = Kendaraan::all();
        $datapelanggan = Pelanggan::all();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        return view('detailpesanan', compact('data', 'datakurir', 'datapelanggan', 'infopesanan', 'infopelanggan', 'datakendaraan'));
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
        $validated = $request->validate([
            'kdpsn' => 'required',
            'tgl_msk' => 'required',
            'image' => 'image|file|max:5000',
            'image' => 'required'
        ], [
            'kdpsn.required' => 'Kode Pesanan tidak boleh kosong',
            'tgl_msk.required' => 'Masukan tanggal masuk',
            'image.required' => 'Masukan foto',

        ]);
        $data = Pesanan::all();
        $datakurir = Kurir::all();
        $datakendaraan = Kendaraan::all();
        $datapelanggan = Pelanggan::all();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);

        $pelanggan = $request->id_pelanggans;
        $kurir = $request->id_kurirs;
        $kendaraan = $request->id_kendaraans;

        $pelanggans1 = Pelanggan::find($pelanggan);
        $kurirs1 = Kurir::find($kurir);
        $kendaraans1 = Kendaraan::find($kendaraan);

        $pesanan = Pesanan::find($id);
        $pesanan->kdpsn = $request->kdpsn;
        $pesanan->namabarang = $request->hasilbarang;
        $pesanan->jumlah = $request->hasiljumlah;
        $pesanan->id_pelanggans = $request->id;
        $pesanan->id_kurirs = $request->id;
        $pesanan->id_kendaraans = $request->id;
        $pesanan->status = $request->status;
        $pesanan->image = $request->file('image')->store('post-images');
        $pesanan->tgl_krm = $request->tgl_krm;
        $pesanan->tgl_trm = $request->tgl_trm;

        $pesanan->pelanggans()->associate($pelanggans1);
        $pesanan->kurirs()->associate($kurirs1);
        $pesanan->kendaraans()->associate($kendaraans1);
        $pesanan->save();

        return redirect()->route('pesanan')->with('success', 'Data Berhasil Di Ubah');
    }

    public function deletepesanan($id)
    {
        $data = Pesanan::find($id);
        $data->delete();

        return redirect()->route('pesanan')->with('success', 'Data Berhasil Di Hapus');
    }
}
