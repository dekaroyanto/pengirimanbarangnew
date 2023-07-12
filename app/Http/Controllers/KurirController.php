<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KurirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datak = Kurir::paginate('5');
        return view('datakurir', compact('datak'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambahkurir');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datak = Kurir::create($request->all());
        return Redirect()->route('datakurir')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function tampilkankurir($id)
    {
        $datak = Kurir::find($id);
        // dd($data);

        return view('tampilkurir', compact('datak'));
    }

    public function updatekurir(Request $request, $id)
    {
        $datak = Kurir::find($id);
        $datak->update($request->all());

        return redirect()->route('datakurir')->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kurir  $kurir
     * @return \Illuminate\Http\Response
     */
    public function show(Kurir $kurir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kurir  $kurir
     * @return \Illuminate\Http\Response
     */
    public function edit(Kurir $kurir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kurir  $kurir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kurir $kurir)
    {
        //
    }

    public function deletekurir($id)
    {
        $datak = Kurir::find($id);
        $datak->delete();

        return redirect()->route('datakurir')->with('success', 'Data Berhasil Di Hapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kurir  $kurir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kurir $kurir)
    {
        //
    }
}
