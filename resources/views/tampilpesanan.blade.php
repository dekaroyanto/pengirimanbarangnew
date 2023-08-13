@extends('layout.mazer')

@section('inijs')
@endsection

@section('content')
    <div class="page-content">
        <!-- Modal Tambah -->
        <section class="section">
            <div class="row" id="table-striped">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Pesanan</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" action="/updatepesanan/{{ $data->id }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Kode
                                                Pesanan</label>
                                            <input value="{{ old('kdpsn', $data->kdpsn) }}" type="text" name="kdpsn"
                                                class="form-control @error('kdpsn') is-invalid @enderror"
                                                id="exampleInputEmail1" aria-describedby="emailHelp">
                                            @error('kdpsn')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Kurir</label>
                                            <select class="form-select" name="id_kurirs"
                                                aria-label="Default select example">

                                                {{-- <option selected>{{ $row->id_kurirs }}</option> --}}
                                                @foreach ($datakurir as $datak)
                                                    <option value="{{ $datak->id }}"
                                                        {{ $datak->id == $data->id_kurirs ? 'selected' : '' }}>
                                                        {{ $datak->nama }}
                                                    </option>
                                                @endforeach



                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Nama Pelanggan</label>
                                            <select class="form-select" name="id_pelanggans"
                                                aria-label="Default select example">

                                                {{-- <option selected>{{ $row->id_kurirs }}</option> --}}
                                                @foreach ($datapelanggan as $datap)
                                                    <option value="{{ $datap->id }}"
                                                        {{ $datap->id == $data->id_pelanggans ? 'selected' : '' }}>
                                                        {{ $datap->namapelanggan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Tanggal
                                                Pengiriman
                                            </label>
                                            <input type="text" name="tgl_krm"
                                                class="form-control mb-3 flatpickr-no-config"
                                                value="{{ $data->tgl_krm }}" />
                                            <div class="invalid-feedback">
                                                Masukan tanggal dengan benar.
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Tanggal
                                                Diterima</label>
                                            <input type="date" name="tgl_trm"
                                                class="form-control mb-3 flatpickr-no-config"
                                                value="{{ $data->tgl_trm }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Status</label>
                                            <select class="form-select" name="status" aria-label="Default select example">

                                                <!-- <option option>Pilih Status</option> -->
                                                <option selected>{{ $data->status }}</option>

                                                @if ($data->status == 'Proses')
                                                    <option value="Selesai">Selesai</option>
                                                    <option value="Dikirim">Dikirim</option>
                                                @elseif ($data->status == 'Dikirim')
                                                    <option value="Proses">Proses</option>
                                                    <option value="Selesai">Selesai</option>
                                                @elseif ($data->status == 'Selesai')
                                                    <option value="Proses">Proses</option>
                                                    <option value="Dikirim">Dikirim</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Simpan
                                        </button>
                                        <a href="/pesanan" class="btn btn-light-secondary me-1 mb-1"
                                            role="button">Batal</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- <button onclick="captureData()" class="btn btn-primary"></button> --}}
    </div>
@endsection
