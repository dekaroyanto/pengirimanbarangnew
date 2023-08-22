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

                            <h1>Data Pelanggan</h1>

                        </div>
                        <div class="card-content mt-2">
                            {{-- {{ Session::get('halaman_url') }} --}}
                            <div class="row">
                                <div class="col-md-auto">
                                    <div class="input-group mb-3 ms-2">
                                        <a href="/tambahpelanggan" class="btn btn-outline-secondary" data-bs-toggle="modal"
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
                                                <table class="table table-striped mb-0" id="table1">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama pelanggan</th>
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

                                                        @foreach ($datap as $index => $row)
                                                            <tr>
                                                                <th scope="row">{{ $index + $datap->firstItem() }}</th>

                                                                <td>{{ $row->namapelanggan }}</td>
                                                                <td>0{{ $row->notelp }}</td>
                                                                <td>{{ $row->emailpelanggan }}</td>
                                                                <td>{{ $row->alamatpelanggan }}</td>
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

                                                                    <a href="{{ route('deletepelanggan', $row->id) }}"
                                                                        class="btn btn-danger delete" id="delete"
                                                                        data-id="{{ $row->id }}"
                                                                        data-nama="{{ $row->namapelanggan }}"><i
                                                                            class="bi bi-trash3"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                {{ $datap->links() }}
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
                    <h1 class="modal-title" id="exampleModalLabel">Tambah Data pelanggan</h1>
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
                                            <form class="form form-vertical" action="/insertdatapelanggan" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1" class="form-label">Nama
                                                                    Lengkap</label>

                                                                <input value="{{ old('namapelanggan') }}" type="text"
                                                                    name="namapelanggan"
                                                                    class="form-control @error('namapelanggan') is-invalid @enderror"
                                                                    placeholder="Masukan Nama Lengkap" />
                                                                @error('namapelanggan')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="form-label">No Telepon</label>
                                                                <div class="position-relative">
                                                                    <input value="{{ old('notelp') }}" type="number"
                                                                        name="notelp"
                                                                        class="form-control @error('notelp') is-invalid @enderror"
                                                                        placeholder="Masukan No Telp"
                                                                        id="first-name-icon" />
                                                                    @error('notelp')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1"
                                                                    class="form-label">Email</label>

                                                                <input value="{{ old('notelp') }}" type="text"
                                                                    name="emailpelanggan"
                                                                    class="form-control @error('emailpelanggan') is-invalid @enderror"
                                                                    placeholder="Masukan Alamat Email" />
                                                                @error('emailpelanggan')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlTextarea1"
                                                                    class="form-label">Alamat Lengkap</label>
                                                                <textarea placeholder="Masukan Alamat Lengkap" class="form-control @error('alamatpelanggan') is-invalid @enderror"
                                                                    name="alamatpelanggan" id="exampleFormControlTextarea1" rows="3">{{ old('alamatpelanggan') }}</textarea>
                                                                @error('alamatpelanggan')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary me-1 mb-1">
                                                                Submit
                                                            </button>
                                                            <a href="/datapelanggan"
                                                                class="btn btn-light-secondary me-1 mb-1"
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
    @foreach ($datap as $index => $row)
        <div class="modal fade" id="exampleModalDetail{{ $row->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/updatepesanan/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Nama pelanggan</label>
                                        <input type="text" name="namapelanggan" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->namapelanggan }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">No Telepon</label>
                                        <input type="text" name="notelp" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="0{{ $row->notelp }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->emailpelanggan }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                        {{-- <input type="text" name="alamatpelanggan" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->alamatpelanggan }}" readonly> --}}
                                        <textarea name="email" class="form-control" cols="3" rows="3" readonly> {{ $row->alamatpelanggan }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <a class="btn btn-light-secondary me-1 mb-1" href="/datapelanggan"
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
    @foreach ($datap as $index => $row)
        <div class="modal fade" id="exampleModalUbah{{ $row->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/updatepelanggan/{{ $row->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Nama Pelanggan</label>
                                        <input type="text" name="namapelanggan"
                                            class="form-control  @error('namapelanggan') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->namapelanggan }}">
                                        @error('namapelanggan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">No Telepon</label>
                                        <input type="text" name="notelp"
                                            class="form-control @error('notelp') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="0{{ $row->notelp }}">
                                        @error('notelp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="text" name="emailpelanggan"
                                            class="form-control @error('namapelanggan') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->emailpelanggan }}">
                                        @error('notelp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                                        <textarea class="form-control @error('namapelanggan') is-invalid @enderror" name="alamatpelanggan"
                                            id="exampleFormControlTextarea1" rows="3">{{ $row->alamatpelanggan }}</textarea>
                                        @error('notelp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-2 mb-1">
                                        Simpan
                                    </button>
                                    <a class="btn btn-light-secondary me-1 mb-1" href="/datapelanggan"
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
