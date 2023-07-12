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

                        <h1>Data Kurir</h1>

                    </div>
                    <div class="card-content mt-2">
                        {{ Session::get('halaman_url') }}
                        <div class="row">
                            <div class="col-md-4 mb-1">
                                <form action="/kurir" method="GET">
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
                            <div class="col-md-auto">
                                <div class="input-group mb-3">
                                    <a href="/tambahkurir" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal2">Tambah Data</a>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="input-group mb-3">
                                    <a href="/tambahkurir" class="btn icon icon-left btn-outline-secondary"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                            data-feather="file"></i> Download</a>
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
                                                        <th>Nama Kurir</th>
                                                        <th>NIK</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $no = 1;
                                                    @endphp

                                                    @foreach ($datak as $index => $row)

                                                    <tr class="text-center">
                                                        <th scope="row">{{ $index + $datak->firstItem() }}</th>

                                                        <td>{{ $row->nama }}</td>
                                                        <td>{{ $row->nik }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-info"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalDetail{{ $row->id }}">
                                                                <i class="bi bi-eye-fill"></i>
                                                            </button>

                                                            <button type="button" class="btn btn-warning"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalUbah{{ $row->id }}">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </button>

                                                            <a href="{{ route('deletekurir', $row->id) }}"
                                                                class="btn btn-danger delete" id="delete"
                                                                data-id="{{ $row->id }}"
                                                                data-nama="{{ $row->nama }}"><i
                                                                    class="bi bi-trash3"></i></a>
                                                        </td>
                                                    </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{ $datak->links() }}
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
                <h1 class="modal-title" id="exampleModalLabel">Data Kurir</h1>
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
                                        <form class="form form-vertical" action="/insertdatakurir" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Nama Lengkap</label>
                                        <div class="position-relative">
                                            <input type="text" name="nama" class="form-control"
                                                placeholder="Input with icon left" id="first-name-icon" />
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">NIK</label>
                                        <div class="position-relative">
                                            <input type="number" name="nik" class="form-control"
                                                placeholder="Input with icon left" id="first-name-icon" />
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        Submit
                                    </button>
                                    <a href="/datakurir" class="btn btn-light-secondary me-1 mb-1"
                                        role="button">Batal</a>
                                </div>
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
@foreach ($datak as $index => $row)
<div class="modal fade" id="exampleModalDetail{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Kurir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/updatepesanan/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Nama Kurir</label>
                                <input type="text" name="nama" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ $row->nama }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">NIK</label>
                                <input type="text" name="nik" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ $row->nik }}" readonly>
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
@foreach ($datak as $index => $row)
<div class="modal fade" id="exampleModalUbah{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kurir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/updatekurir/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Nama Kurir</label>
                                <input type="text" name="nama" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ $row->nama }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">NIK</label>
                                <input type="text" name="nik" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ $row->nik }}">
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
