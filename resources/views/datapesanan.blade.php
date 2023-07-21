@extends('layout.mazer')

@section('css2')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
@endsection

@section('inijs')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#start_date");
        flatpickr("#end_date");
    </script>
    <script>
        function addItem() {
            var orderContainer = document.getElementById("orderContainer");
            var orderItem = document.createElement("div");
            orderItem.className = "order-item";
            var html = `
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" name="item[]" id="namabarang" placeholder="Pesanan">
                    <label for="namabarang">Pesanan</label>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-floating">
                    <input type="number" class="form-control" name="quantity[]" id="jumlah" placeholder="Jumlah">
                        <label for="jumlah">Jumlah</label>
                </div>
            </div>
                <div class="col-md-1 d-flex align-items-center justify-content-center">
                    <button class="btn btn-primary btn-sm" onclick="removeItem(this)"><i class="bi bi-dash""></i></button>
                </div>
            </div>
        </div>
`;
            orderItem.innerHTML = html;
            orderContainer.appendChild(orderItem);
        }

        function removeItem(button) {
            var orderItem = button.closest(".order-item");
            var orderContainer = orderItem.parentNode;
            orderContainer.removeChild(orderItem);
        }

        function captureData() {
            var orderItems = document.getElementsByClassName("order-item");
            var table = document.getElementById("orderTable");

            var itemData = "";
            var quantityData = "";
            var track_order = "";

            for (var i = 0; i < orderItems.length; i++) {
                // var itemInput = orderItems[i].getElementsByTagName("input")[0].value;
                // var quantityInput = orderItems[i].getElementsByTagName("input")[1].value;
                var quantityInput = orderItems[i].querySelector("input[name='quantity[]']").value;
                var itemInput = orderItems[i].querySelector("input[name='item[]']").value;

                itemData += itemInput + ",";
                quantityData += quantityInput + ",";
                track_order += "masuk" + ",";
            }

            document.getElementById("hasilbarang").value = itemData.slice(0, -1);
            document.getElementById("hasiljumlah").value = quantityData.slice(0, -1);
            // console.log(document.getElementById("hasiljumlah"))
        }
    </script>
@endsection

@section('content')
    <div class="page-content">
        {{-- <div class="section">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div> --}}

        <section class="section">
            <div class="row" id="table-head">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            <h1>Data Pesanan</h1>


                        </div>
                        <div class="card-body mt-2">
                            <div class="row mt-2 ms-2">
                                <div class="col-md-auto">
                                    <div class="input-group mb-3">
                                        <a href="/tambahpesanan" class="btn btn-outline-secondary">Tambah Data</a>
                                    </div>
                                </div>
                                <div class="col-md-auto">
                                    <div class="input-group mb-3">
                                        <a href="/tambahpesanan" class="btn icon icon-left btn-outline-secondary"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                                data-feather="file"></i> Download</a>
                                    </div>
                                </div>
                            </div>
                            {{-- {{ Session::get('halaman_url') }} --}}
                            <div class="row">
                                <div class="col-sm-6 mt-4 pb-4">
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
                                <div class="col-sm">
                                    <form action="/filter" method="GET">
                                        <div class="row">
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Tanggal Awal</label>
                                                    <input type="date" name="start_date" id="start_date"
                                                        class="flatpickr flatpickr-input active form-control @error('start_date') is-invalid @enderror"
                                                        placeholder="Masukan Tanggal" aria-label="Recipient's username"
                                                        aria-describedby="button-addon2"
                                                        value="{{ request('start_date') }}" />
                                                    @error('start_date')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Tanggal Akhir</label>
                                                    <input type="date" name="end_date" id="end_date"
                                                        class="form-control @error('start_date') is-invalid @enderror"
                                                        placeholder="Masukan Tanggal" aria-label="Recipient's username"
                                                        aria-describedby="button-addon2"
                                                        value="{{ request('end_date') }}" />
                                                    @error('end_date')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-1 mt-4 pe-2">
                                                <button class="btn btn-primary" type="submit" id="button-addon2">
                                                    Filter
                                                </button>
                                            </div>

                                    </form>
                                </div>

                            </div>

                            <div class="row" id="table-striped">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-content">

                                            <!-- table striped -->
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Kode Pesanan</th>
                                                            <th>Nama Barang</th>
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
                                                                <td>
                                                                    @if ($row->status == 'Proses')
                                                                        <span
                                                                            class="badge bg-warning">{{ $row->status }}</span>
                                                                    @elseif ($row->status == 'Dikirim')
                                                                        <span
                                                                            class="badge bg-info">{{ $row->status }}</span>
                                                                    @elseif ($row->status == 'Selesai')
                                                                        <span
                                                                            class="badge bg-success">{{ $row->status }}</span>
                                                                    @endif
                                                                </td>
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

                                                                    <a href="{{ route('deletepesanan', $row->id) }}"
                                                                        class="btn btn-danger delete" id="delete"
                                                                        data-id="{{ $row->id }}"
                                                                        data-nama="{{ $row->namabarang }}"><i
                                                                            class="bi bi-trash3"></i></a>
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
    </div>
    </div>
    </section>
    </div>

    <!-- Modal Detail -->
    @foreach ($data as $index => $row)
        <div class="modal fade" id="exampleModalDetail{{ $row->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <input type="text" name="kdpsn" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->kdpsn }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Nama Pelanggan</label>
                                        <input type="text" name="id_pelanggans" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->pelanggans->namapelanggan }}" readonly>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Nama
                                            Barang</label>
                                        <input type="text" name="namabarang" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->namabarang }}" readonly>
                                    </div>
                                </div> --}}
                                <div class="col-md-4 col-12">
                                    <div id="" class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Nama
                                            Barang</label>
                                        <input type="text" name="namabarang"
                                            class="form-control @error('namabarang')
                                        is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->namabarang }}" readonly>
                                        <div class="invalid-feedback">
                                            Masukan nama barang dengan benar.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-12 text-center">
                                    <div id="" class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Jumlah</label>
                                        <input type="text" name="jumlah"
                                            class="form-control @error('jumlah')
                                        is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->jumlah }}" readonly>
                                        <div class="invalid-feedback">
                                            Masukan nama barang dengan benar.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 mt-1 col-12">
                                    <div id="" class="form-group ">
                                        {{-- <label for="exampleInputEmail1"
                                            class="form-label">Tambah</label> --}}
                                        <button type="text" name="namabarang" class="btn mt-3"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"><i
                                                class="bi bi-plus-square-fill fs-2 align-center"></i>
                                            <div class="invalid-feedback">
                                                Masukan nama barang dengan benar.
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Alamat Lengkap</label>
                                        <input type="text" name="id_pelanggans" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->pelanggans->alamatpelanggan }}" readonly>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                                        <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3" readonly>{{ $row->alamat }}</textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Tanggal
                                            Pengiriman</label>
                                        <input type="text" name="tgl_krm" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->tgl_krm }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Kurir</label>
                                        <input type="text" name="id_kurirs" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->kurirs->nama }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Tanggal
                                            Diterima</label>
                                        <input type="text" name="tgl_trm" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->tgl_trm }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Status</label>
                                        <input type="text" name="status" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->status }}" readonly>
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
    @foreach ($data as $index => $row)
        <div class="modal fade" id="exampleModalUbah{{ $row->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <input type="text" name="kdpsn" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->kdpsn }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Nama
                                            Barang</label>
                                        <input type="text" name="namabarang" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->namabarang }}">
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
                                                    {{ $datap->id == $row->id_pelanggans ? 'selected' : '' }}>
                                                    {{ $datap->namapelanggan }}
                                                </option>
                                            @endforeach



                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Alamat Lengkap</label>
                                        <select class="form-select" name="id_pelanggans"
                                            aria-label="Default select example">

                                            {{-- <option selected>{{ $row->id_kurirs }}</option> --}}
                                            @foreach ($datapelanggan as $datap)
                                                <option value="{{ $datap->id }}"
                                                    {{ $datap->id == $row->id_pelanggans ? 'selected' : '' }}>
                                                    {{ $datap->alamatpelanggan }}
                                                </option>
                                            @endforeach



                                        </select>
                                        {{-- <input type="text" name="alamatpelanggan" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->pelanggans->alamatpelanggan }}"> --}}
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                                        <textarea class="form-control" name="alamatpelanggan" id="exampleFormControlTextarea1" rows="3">{{ $row->alamatpelanggan }}</textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Tanggal
                                            Pengiriman
                                        </label>
                                        <input type="text" name="tgl_krm"
                                            class="form-control mb-3 flatpickr-no-config" value="{{ $row->tgl_krm }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Kurir</label>
                                        <select class="form-select" name="id_kurirs" aria-label="Default select example">

                                            {{-- <option selected>{{ $row->id_kurirs }}</option> --}}
                                            @foreach ($datakurir as $datak)
                                                <option value="{{ $datak->id }}"
                                                    {{ $datak->id == $row->id_kurirs ? 'selected' : '' }}>
                                                    {{ $datak->nama }}
                                                </option>
                                            @endforeach



                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Tanggal
                                            Diterima</label>
                                        <input type="date" name="tgl_trm"
                                            class="form-control mb-3 flatpickr-no-config" value="{{ $row->tgl_trm }}" />
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
                                                <option value="Dikirim">Dikirim</option>
                                            @elseif ($row->status == 'Dikirim')
                                                <option value="Proses">Proses</option>
                                                <option value="Selesai">Selesai</option>
                                            @elseif ($row->status == 'Selesai')
                                                <option value="Proses">Proses</option>
                                                <option value="Dikirim">Dikirim</option>
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
