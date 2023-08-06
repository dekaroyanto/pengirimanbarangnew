@extends('layout.mazer')

@section('inijs')
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

                                            {{-- <select class="choices form-select" name="nama_pelanggan"
                                                            aria-label="Default select example">


                                                            @foreach ($datapelanggan as $datap)
                                                                <option value="{{ $datap->id }}">
                                                                    {{ $datap->namapelanggan }}
                                                                </option>
                                                            @endforeach



                                                        </select> --}}
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
                                    @php
                                        $items = explode(',', $data->namabarang);
                                        $qty = explode(',', $data->jumlah);
                                    @endphp
                                    <div class="col-lg-6">
                                        <div id="orderContainer">
                                            <div class="order-item">
                                                <label>Nama Barang</label>
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-6">
                                                        @foreach ($items as $item)
                                                            <div class="form-floating">
                                                                <input type="text" id="namabarang"
                                                                    value="{{ $item }}" class="form-control">
                                                                <label for="namabarang">Nama Barang</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="col-md-5">
                                                        @foreach ($qty as $qty)
                                                            <div class="form-floating">
                                                                <input type="text" id="jumlah" class="form-control"
                                                                    value="{{ $qty }}">
                                                                <label for="jumlah">Jumlah</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                        <button class="btn btn-primary" onclick="addItem()"
                                                            type="button"><i class="bi bi-plus-lg"></i></button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="hasilbarang" name="hasilbarang" class="form-control" type="">
                                    <input id="hasiljumlah" name="hasiljumlah" class="form-control" type="">
                                    <button class="submit" type="button" onclick="">test</button>


                                    {{-- AWAL PESANAN --}}
                                    {{-- <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Nama
                                                            Barang</label>
                                                        <input type="text" name="namabarang"
                                                            class="form-control @error('namabarang')
                                                        is-invalid @enderror"
                                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                                            value="{{ old('namabarang') }}">
                                                        <div class="invalid-feedback">
                                                            Masukan nama barang dengan benar.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-12 text-center">
                                                    <div id="" class="form-group">
                                                        <label for="exampleInputEmail1"
                                                            class="form-label">Jumlah</label>
                                                        <input type="text" name="jumlah"
                                                            class="form-control @error('jumlah')
                                                        is-invalid @enderror"
                                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                                            value="{{ old('jumlah') }}">
                                                        <div class="invalid-feedback">
                                                            Masukan nama barang dengan benar.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 mt-1 col-12">
                                                    <div id="" class="form-group ">
                                                        <label for="exampleInputEmail1"
                                                            class="form-label">Tambah</label>
                                                        <button type="text" name="namabarang" class="btn mt-3"
                                                            id="exampleInputEmail1" aria-describedby="emailHelp"><i
                                                                class="bi bi-plus-square-fill fs-2 align-center"></i>
                                                            <div class="invalid-feedback">
                                                                Masukan nama barang dengan benar.
                                                            </div>
                                                    </div>
                                                </div> --}}
                                    {{-- AKHIR PESANAN --}}

                                    {{-- <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label">Alamat Lengkap</label>
                                                        <textarea
                                                            class="form-control @error('alamat') is-invalid
                                                        @enderror"
                                                            name="alamat" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                        <div class="invalid-feedback">
                                                            Masukan alamat dengan benar.
                                                        </div>
                                                    </div>
                                                </div> --}}


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
                                            <input type="text" name="status" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp" value="proses"
                                                readonly>
                                            {{-- <select class="form-select" name="status"
                                                        aria-label="Default select example">
                                                        <option value="Proses">Proses</option>
                                                        <option value="Selesai">Selesai</option>
                                                    </select> --}}
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
