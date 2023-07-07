@extends('layout.mazer')



@section('content')
<div class="page-content">
    <div class="section">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <section class="section">
        <div class="row" id="table-head">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <h1>Data Pesanan</h1>

                    </div>
                    <div class="card-content mt-2">
                        {{ Session::get('halaman_url') }}
                        <div class="row">
                            <div class="col-md-4 mb-1">
                                <form action="/pesanan" method="GET">
                                    <div class="input-group mb-3 ms-3">

                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                                        <input type="search" name="search" class="form-control" placeholder="Cari data..." aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ request('search') }}" />
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                            Cari
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-auto">
                                <div class="input-group mb-3">
                                    <a href="/tambahpesanan" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal2">Tambah Data</a>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="input-group mb-3">
                                    <a href="/tambahpesanan" class="btn icon icon-left btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i data-feather="file"></i> Download</a>
                                </div>
                            </div>


                        </div>

                        <div class="row" id="table-striped">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content">

                                        <!-- table striped -->
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode Pesanan</th>
                                                        <th>Nama Penerima</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kategori</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $no = 1;
                                                    @endphp

                                                    @foreach ($data as $index => $row)

                                                    <tr class="text-center">
                                                        <th scope="row">{{ $index + $data->firstItem() }}</th>
                                                        <td>{{ $row->kdpsn }}</td>
                                                        <td>{{ $row->penerima }}</td>
                                                        <td>{{ $row->namabarang }}</td>
                                                        <td>{{ $row->kategori }}</td>
                                                        <td>
                                                            @if ($row->status == 'Proses')
                                                            <span class="badge bg-warning">{{ $row->status }}</span>
                                                            @else
                                                            <span class="badge bg-success">{{ $row->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModalDetail{{ $row->id }}">
                                                                <i class="bi bi-eye-fill"></i>
                                                            </button>

                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModalUbah{{ $row->id }}">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </button>

                                                            <a href="{{ route('deletepesanan', $row->id) }}" class="btn btn-danger delete" id="delete" data-id="{{ $row->id }}" data-nama="{{ $row->namabarang }}"><i class="bi bi-trash3"></i></a>
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{ $data->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">Data Pesanan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="/insertpesanan" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Kode
                                                            Pesanan</label>
                                                        <input type="text" name="kdpsn" class="form-control @error('kdpsn') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        <div class="invalid-feedback">
                                                            Masukan kode pesanan dengan benar.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Nama
                                                            Penerima</label>
                                                        <input type="text" name="penerima" class="form-control @error('penerima') is-invalid
                                                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('penerima') }}">
                                                        <div class="invalid-feedback">
                                                            @error('penerima')
                                                            {{ $message }}
                                                            @enderror

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">No
                                                            Telepon</label>
                                                        <input type="text" name="notelp" class="form-control @error('notelp') is-invalid
                                                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('notelp') }}">
                                                        <div class="invalid-feedback">
                                                            Masukan no telp dengan benar.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Nama
                                                            Barang</label>
                                                        <input type="text" name="namabarang" class="form-control @error('namabarang')
                                                            is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('namabarang') }}">
                                                        <div class="invalid-feedback">
                                                            Masukan nama barang dengan benar.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Kategori</label>
                                                        <select class="form-select" name="kategori" aria-label="Default select example">
                                                            {{-- <option selected>Pilih Kategori</option> --}}
                                                            <option value="Printing">Printing</option>
                                                            <option value="Advertising">Advertising</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Provinsi</label>
                                                        <input type="text" name="prov" class="form-control @error('prov') is-invalid
                                                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('prov') }}">
                                                        <div class="invalid-feedback">
                                                            Masukan nama provinsi dengan benar.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Kota/Kabupaten</label>
                                                        <input type="text" name="kota" class="form-control @error('kota') is-invalid
                                                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('kota') }}" @>
                                                        <div class="invalid-feedback">
                                                            Masukan nama kota/kabupaten dengan benar.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
                                                        <input type="text" name="kec" class="form-control @error('kec') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('kec') }}">
                                                        <div class="invalid-feedback">
                                                            Masukan nama kecamatan dengan benar.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Kode
                                                            Pos</label>
                                                        <input type="text" name="kdpos" class="form-control @error('kdpos') is-invalid
                                                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('kdpos') }}">
                                                        <div class="invalid-feedback">
                                                            Masukan kode pos dengan benar.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                                                        <textarea class="form-control @error('alamat') is-invalid
                                                            @enderror" name="alamat" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                        <div class="invalid-feedback">
                                                            Masukan alamat dengan benar.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label ">Tanggal
                                                            Pengiriman
                                                        </label>
                                                        <input type="date" name="tgl_krm" class="form-control mb-3 flatpickr-no-config @error('alamat') is-invalid
                                                            @enderror" placeholder="Pilih tanggal.." />
                                                        <div class="invalid-feedback">
                                                            Masukan tanggal dengan benar.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Tanggal
                                                            Diterima</label>
                                                        <input type="text" name="tgl_trm" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="Belum Terkirim" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Status</label>
                                                        <input type="text" name="status" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="proses" readonly>
                                                        {{-- <select class="form-select" name="status"
                                                            aria-label="Default select example">
                                                            <option value="Proses">Proses</option>
                                                            <option value="Selesai">Selesai</option>
                                                        </select> --}}
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button data-bs-toggle="modal" data-bs-target="#exampleModal2" type="submit" class="btn btn-primary me-1 mb-1">
                                                        Simpan
                                                    </button>
                                                    <a href="/tambahpesanan" data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-light-secondary me-1 mb-1" role="button">Batal</a>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
            </div>
        </div>
    </div>
</div>
<!-- End Modal Tambah -->

<!-- Modal Detail -->
@foreach ($data as $index => $row)
<div class="modal fade" id="exampleModalDetail{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/updatepesanan/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Kode
                                    Pesanan</label>
                                <input type="text" name="kdpsn" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->kdpsn }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Nama
                                    Penerima</label>
                                <input type="text" name="penerima" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->penerima }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">No
                                    Telepon</label>
                                <input type="text" name="notelp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->notelp }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Nama
                                    Barang</label>
                                <input type="text" name="namabarang" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->namabarang }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Kategori</label>
                                <input type="text" name="kategori" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->kategori }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Provinsi</label>
                                <input type="text" name="prov" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->prov }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Kota/Kabupaten</label>
                                <input type="text" name="kota" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->kota }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
                                <input type="text" name="kec" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->kec }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Kode
                                    Pos</label>
                                <input type="text" name="kdpos" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->kdpos }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3" readonly>{{ $row->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Tanggal
                                    Pengiriman</label>
                                <input type="text" name="tgl_krm" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->tgl_krm }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Tanggal
                                    Diterima</label>
                                <input type="text" name="tgl_trm" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->tgl_trm }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Status</label>
                                <input type="text" name="status" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->status }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <a class="btn btn-light-secondary me-1 mb-1" href="/pesanan" role="button">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- End Modal Detail -->

<!-- Modal Edit -->
@foreach ($data as $index => $row)
<div class="modal fade" id="exampleModalUbah{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/updatepesanan/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Kode
                                    Pesanan</label>
                                <input type="text" name="kdpsn" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->kdpsn }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Nama
                                    Penerima</label>
                                <input type="text" name="penerima" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->penerima }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">No
                                    Telepon</label>
                                <input type="text" name="notelp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->notelp }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Nama
                                    Barang</label>
                                <input type="text" name="namabarang" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->namabarang }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Kategori</label>
                                <select class="form-select" name="kategori" aria-label="Default select example">
                                    <!-- <option selected>Pilih Kategori</option> -->
                                    <option selected>{{ $row->kategori }}</option>

                                    @if ($row->kategori == 'Printing')
                                    <option value="Advertising">Advertising</option>
                                    @else
                                    <option value="Printing">Printing</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Provinsi</label>
                                <input type="text" name="prov" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->prov }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Kota/Kabupaten</label>
                                <input type="text" name="kota" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->kota }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
                                <input type="text" name="kec" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->kec }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Kode
                                    Pos</label>
                                <input type="text" name="kdpos" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->kdpos }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3">{{ $row->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Tanggal
                                    Pengiriman
                                </label>
                                <input type="text" name="tgl_krm" class="form-control mb-3 flatpickr-no-config" value="{{ $row->tgl_krm }}" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Tanggal
                                    Diterima</label>
                                <input type="text" name="tgl_trm" class="form-control mb-3 flatpickr-no-config" value="{{ $row->tgl_trm }}" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Status</label>
                                <select class="form-select" name="status" aria-label="Default select example">

                                    <!-- <option option>Pilih Status</option> -->
                                    <option selected>{{ $row->status }}</option>

                                    @if ($row->status == 'Proses')
                                    <option value="Selesai">Selesai</option>
                                    @else
                                    <option value="Proses">Proses</option>
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-2 mb-1">
                                Simpan
                            </button>
                            <a class="btn btn-light-secondary me-1 mb-1" href="/pesanan" role="button">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- End Modal Edit -->
@endsection
