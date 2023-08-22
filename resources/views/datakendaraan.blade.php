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

                            <h1>Data Kendaraan</h1>

                        </div>
                        <div class="card-content mt-2">
                            {{-- {{ Session::get('halaman_url') }} --}}
                            <div class="row">
                                <div class="col-md-auto">
                                    <div class="input-group mb-3 ms-2">
                                        <a href="/tambahkendaraan" class="btn btn-outline-secondary" data-bs-toggle="modal"
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
                                                            <th>Plat Nomor</th>
                                                            <th>Jenis</th>
                                                            <th>Merk</th>
                                                            <th>Model</th>
                                                            <th>Warna</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $no = 1;
                                                        @endphp

                                                        @foreach ($dataken as $index => $row)
                                                            <tr>
                                                                <th scope="row">{{ $index + $dataken->firstItem() }}</th>

                                                                <td>{{ $row->platno }}</td>
                                                                <td>{{ $row->jenis }}</td>
                                                                <td>{{ $row->merk }}</td>
                                                                <td>{{ $row->model }}</td>
                                                                <td>{{ $row->warna }}</td>
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

                                                                    <a href="{{ route('deletekendaraan', $row->id) }}"
                                                                        class="btn btn-danger delete" id="delete"
                                                                        data-id="{{ $row->id }}"
                                                                        data-nama="{{ $row->platno }}"><i
                                                                            class="bi bi-trash3"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                {{ $dataken->links() }}
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Tambah Data Kendaraan</h1>
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
                                            <form class="form form-vertical" action="/insertdatakendaraan" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Plat Nomor</label>
                                                                <div class="position-relative">
                                                                    <input value="{{ old('platno') }}" type="text"
                                                                        name="platno"
                                                                        class="form-control @error('platno') is-invalid @enderror"
                                                                        placeholder="Masukan Plat Nomor" />
                                                                    @error('platno')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-icon">Jenis Kendaraan</label>
                                                            <select name="jenis" class="form-select">
                                                                <option value="Motor">Motor</option>
                                                                <option value="Mobil">Mobil</option>
                                                            </select>
                                                            @error('jenis')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Merk</label>
                                                            <div class="position-relative">
                                                                <input value="{{ old('merk') }}" type="text"
                                                                    name="merk"
                                                                    class="form-control @error('merk') is-invalid @enderror "
                                                                    placeholder="Masukan Merk" id="first-name-icon" />
                                                                @error('merk')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Model</label>
                                                            <div class="position-relative">
                                                                <input value="{{ old('model') }}" type="text"
                                                                    name="model"
                                                                    class="form-control @error('model') is-invalid @enderror"
                                                                    placeholder="Masukan Model" id="first-name-icon" />
                                                                @error('model')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Warna</label>
                                                            <div class="position-relative">
                                                                <input value="{{ old('warna') }}" type="text"
                                                                    name="warna"
                                                                    class="form-control @error('warna') is-invalid @enderror"
                                                                    placeholder="Masukan Warna" id="first-name-icon" />
                                                                @error('warna')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                                            Submit
                                                        </button>
                                                        <a href="/datakendaraan" class="btn btn-light-secondary me-1 mb-1"
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
    @foreach ($dataken as $index => $row)
        <div class="modal fade" id="exampleModalDetail{{ $row->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail kendaraan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/updatekendaraan/{{ $row->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Plat Nomor</label>
                                        <input type="text" name="platno" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->platno }}" readonly>
                                    </div>
                                </div>
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Jenis</label>
                                        <input type="text" name="jenis" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->jenis }}" readonly>
                                    </div>
                                </div>
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Merk</label>
                                        <input type="text" name="merk" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->merk }}" readonly>
                                    </div>
                                </div>
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Model</label>
                                        <input type="text" name="jenis" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->model }}" readonly>
                                    </div>
                                </div>
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Warna</label>
                                        <input type="text" name="warna" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->warna }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <a class="btn btn-light-secondary me-1 mb-1" href="/datakendaraan"
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
    @foreach ($dataken as $index => $row)
        <div class="modal fade" id="exampleModalUbah{{ $row->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Kendaraan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/updatekendaraan/{{ $row->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Plat Nomor</label>
                                        <input type="text" name="platno"
                                            class="form-control @error('platno') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->platno }}">
                                        @error('platno')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Jenis</label>
                                        <select class="form-select" name="jenis" aria-label="Default select example">

                                            <!-- <option option>Pilih Status</option> -->
                                            <option selected>{{ $row->jenis }}</option>

                                            @if ($row->jenis == 'Mobil')
                                                <option value="Motor">Motor</option>
                                            @else
                                                <option value="Mobil">Mobil</option>
                                            @endif

                                            {{-- @if ($data->status == 'Proses')
                                                <option value="Selesai">Selesai</option>
                                                <option value="Dikirim">Dikirim</option>
                                            @elseif ($data->status == 'Dikirim')
                                                <option value="Proses">Proses</option>
                                                <option value="Selesai">Selesai</option>
                                            @elseif ($data->status == 'Selesai')
                                                <option value="Proses">Proses</option>
                                                <option value="Dikirim">Dikirim</option>
                                            @endif --}}
                                        </select>
                                    </div>
                                </div>
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Merk</label>
                                        <input type="text" name="merk"
                                            class="form-control @error('merk') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->merk }}">
                                        @error('merk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Model</label>
                                        <input type="text" name="model"
                                            class="form-control @error('model') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->model }}">
                                        @error('model')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Warna</label>
                                        <input type="text" name="warna"
                                            class="form-control @error('warna') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->warna }}">
                                        @error('warna')
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
                                    <a class="btn btn-light-secondary me-1 mb-1" href="/datakendaraan"
                                        role="button">Kembali</a>
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
