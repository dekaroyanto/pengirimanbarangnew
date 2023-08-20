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
                                                            <th>NIK</th>
                                                            <th>Nama Kurir</th>
                                                            <th>No Telepon</th>
                                                            <th>Email</th>
                                                            <th>Alamat</th>
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

                                                                <td>{{ $row->nik }}</td>
                                                                <td>{{ $row->nama }}</td>
                                                                <td>0{{ $row->notelpkurir }}</td>
                                                                <td>{{ $row->emailkurir }}</td>
                                                                <td>{{ $row->alamatkurir }}</td>
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
        <div class="modal-dialog modal-lg">
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
                                                            <label class="form-label">NIK</label>
                                                            <div class="position-relative">
                                                                <input type="text" name="nik" type="number"
                                                                    class="form-control" placeholder="Masukan NIK"
                                                                    id="first-name-icon" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Nama Lengkap</label>
                                                            <div class="position-relative">
                                                                <input type="text" name="nama" class="form-control"
                                                                    placeholder="Masukan Nama" id="first-name-icon" />
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label">No Telepon</label>
                                                            <div class="position-relative">
                                                                <input type="text" name="notelpkurir" type="number"
                                                                    class="form-control" placeholder="Masukan No Telepon"
                                                                    id="first-name-icon" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Alamat Email</label>
                                                            <div class="position-relative">
                                                                <input type="text" name="emailkurir"
                                                                    class="form-control" placeholder="Masukan Nama"
                                                                    id="first-name-icon" />
                                                            </div>
                                                        </div>

                                                        <div class="col-12 mb-3">

                                                            <label class="form-label">Jenis Kelamin</label>
                                                            <div class="position-relative">
                                                                <select name="kelamin" class="form-select">
                                                                    <option value="Laki-Laki">Laki-laki</option>
                                                                    <option value="Perempuan">Perempuan</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlTextarea1"
                                                                    class="form-label">Alamat Lengkap</label>
                                                                <textarea placeholder="Masukan Alamat Lengkap"
                                                                    class="form-control @error('alamatkurir') is-invalid
                                                            @enderror"
                                                                    name="alamatkurir" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                <div class="invalid-feedback">
                                                                    Masukan alamat dengan benar.
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
        <div class="modal fade" id="exampleModalDetail{{ $row->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Kurir</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/updatekurir/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">NIK</label>
                                        <input type="text" name="nik" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->nik }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Nama Kurir</label>
                                        <input type="text" name="nama" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->nama }}" readonly>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">No Telepon</label>
                                        <input type="text" name="notelp" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="0{{ $row->notelpkurir }}" readonly>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                                        <input type="text" name="nama" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->emailkurir }}" readonly>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Alamat Kurir</label>
                                        {{-- <input type="text" name="alamatpelanggan" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->alamatpelanggan }}" readonly> --}}
                                        <textarea name="email" class="form-control" cols="3" rows="3" readonly> {{ $row->alamatkurir }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <a class="btn btn-light-secondary me-1 mb-1" href="/pesanan"
                                        role="button">Kembali</a>
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
        <div class="modal fade" id="exampleModalUbah{{ $row->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Kurir</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/updatekurir/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">NIK</label>
                                        <input type="text" name="nik" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->nik }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Nama Kurir</label>
                                        <input type="text" name="nama" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->nama }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Nama Kurir</label>
                                        <input type="text" name="notelpkurir" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->notelpkurir }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="text" name="emailkurir" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->nama }}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" name="kelamin" aria-label="Default select example">

                                            <!-- <option option>Pilih Status</option> -->
                                            <option selected>{{ $row->kelamin }}</option>

                                            @if ($row->kelamin == 'Laki-Laki')
                                                <option value="Perempuan">Perempuan</option>
                                            @else
                                                <option value="Laki-Laki">Laki-Laki</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                                        <textarea class="form-control" name="alamatkurir" id="exampleFormControlTextarea1" rows="3">{{ $row->alamatkurir }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-2 mb-1">
                                        Simpan
                                    </button>
                                    <a class="btn btn-light-secondary me-1 mb-1" href="/datakurir"
                                        role="button">Batal</a>
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
