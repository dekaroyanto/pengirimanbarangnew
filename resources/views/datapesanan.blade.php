@extends('layout.mazer')



@section('content')
<div class="page-content">

    <section class="section">
        <div class="row" id="table-head">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <h1>Data Pesanan</h1>

                    </div>
                    <div class="card-content">

                        <div class="row">
                            <div class="col-md-4 mb-1">
                                <form action="/pesanan" method="GET">
                                    <div class="input-group mb-3 ms-3">

                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="bi bi-search"></i></span>
                                        <input type="search" name="search" class="form-control"
                                            placeholder="Cari data..." aria-label="Recipient's username"
                                            aria-describedby="button-addon2" value="{{ request('search') }}" />
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                            Cari
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4 mb-1">
                                <div class="input-group mb-3">
                                    <a href="/tambahpesanan" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal2">Tambah Data</a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <div class="input-group mb-3">
                                    <a href="/tambahpesanan" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal2">Download</a>
                                </div>
                            </div>

                        </div>




                        <!-- table head dark -->
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Kode Pesanan</th>
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
                                        <td>{{ $row->namabarang }}</td>
                                        <td>{{ $row->kategori }}</td>
                                        <td>
                                            @if ($row->status == 'Proses')
                                            <span class="badge bg-light-warning">{{ $row->status }}</span>
                                            @else
                                            <span class="badge bg-light-success">{{ $row->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalDetail{{ $row->id }}">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>

                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalUbah{{ $row->id }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

                                            <a href="{{ route('deletepesanan', $row->id) }}"
                                                class="btn btn-danger delete" id="delete" data-id="{{ $row->id }}"
                                                data-nama="{{ $row->namabarang }}"><i class="bi bi-trash3"></i></a>
                                            {{-- <a href="{{ route('pesanan', $row->id) }}"
                                                class="btn btn-danger delete" id="delete" data-id="{{ $row->id }}"
                                                data-nama="{{ $row->namabarang }}"><i class="bi bi-trash3"></i></a> --}}
                                        </td>
                                    </tr>

                                </tbody>
                                @endforeach
                            </table>
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/insertpesanan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kode Pesanan</label>
                        <input type="text" name="kdpsn" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                        <input type="text" name="namabarang" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kategori</label>
                        <select class="form-select" name="kategori" aria-label="Default select example">
                            {{-- <option selected>Pilih Kategori</option> --}}
                            <option value="Printing">Printing</option>
                            <option value="Advertising">Advertising</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1"
                            rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Status</label>
                        <select class="form-select" name="status" aria-label="Default select example">
                            <!-- <option option>Pilih Status</option> -->
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Masukan Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-primary" href="/pesanan" role="button">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Tambah -->

<!-- Modal Detail -->
@foreach ($data as $index => $row)
<div class="modal fade" id="exampleModalDetail{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/updatepesanan/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kode Pesanan</label>
                        <input type="text" name="kdpsn" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $row->kdpsn }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                        <input type="text" name="namabarang" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $row->namabarang }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $row->kategori }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3"
                            readonly>{{ $row->alamat }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Status</label>
                        <input type="text" name="status" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $row->status }}" readonly>

                        </select>
                    </div>
                    <a class="btn btn-primary" href="/pesanan" role="button">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- End Modal Detail -->

<!-- Modal Edit -->
@foreach ($data as $index => $row)
<div class="modal fade" id="exampleModalUbah{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/updatepesanan/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kode Pesanan</label>
                        <input type="text" name="kdpsn" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $row->kdpsn }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                        <input type="text" name="namabarang" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $row->namabarang }}">
                    </div>
                    <div class="mb-3">
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
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1"
                            rows="3">{{ $row->alamat }}</textarea>
                    </div>
                    <div class="mb-3">
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
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a class="btn btn-danger" href="/pesanan" role="button">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- End Modal Edit -->
@endsection