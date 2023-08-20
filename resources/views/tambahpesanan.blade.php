@extends('layout.mazer')

@section('inihead')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('css2')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('inijs')
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
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
                            <h3 class="card-title">Tambah Pesanan</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" action="/insertpesanan" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Kode
                                                Pesanan</label>
                                            <input value="{{ old('kdpsn') }}" type="text" name="kdpsn"
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
                                            <select class="choices form-select" name="id_kurirs"
                                                aria-label="Default select example">


                                                @foreach ($datakurir as $datak)
                                                    <option value="{{ $datak->id }}">
                                                        {{ $datak->nama }}
                                                    </option>
                                                @endforeach



                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Nama
                                                Pelanggan</label>
                                            <option value="">Pilih</option>
                                            <select class="choices form-select" name="id_pelanggans"
                                                aria-label="Default select example" id="id_pelanggans">


                                                @foreach ($datapelanggan as $datap)
                                                    <option value="{{ $datap->id }}">
                                                        {{ $datap->namapelanggan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Kendaraan</label>
                                            <select class="choices form-select" name="id_kendaraans"
                                                aria-label="Default select example">


                                                @foreach ($datakendaraan as $dataken)
                                                    <option value="{{ $dataken->id }}">
                                                        {{ $dataken->platno }} - {{ $dataken->model }}
                                                    </option>
                                                @endforeach



                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <div id="orderContainer">
                                            <div class="order-item">
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control " name="item[]"
                                                                id="namabarang" placeholder="Pesanan" required>
                                                            <label for="namabarang">Pesanan</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" name="quantity[]"
                                                                id="jumlah" placeholder="Jumlah" required>
                                                            <label for="jumlah">Jumlah</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                        <button class="btn btn-primary" onclick="addItem()"
                                                            type="button"><i class="bi bi-plus-lg"></i></button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="hasilbarang" name="hasilbarang" class="form-control" type="hidden">
                                    <input id="hasiljumlah" name="hasiljumlah" class="form-control" type="hidden">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label ">Tanggal
                                                Pesanan Masuk
                                            </label>
                                            <input type="date" name="tgl_msk"
                                                class="form-control mb-3 flatpickr-no-config @error('tgl_msk') is-invalid @enderror "
                                                placeholder="Masukan Tanggal" readonly />
                                            @error('tgl_msk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label ">Tanggal
                                                Pengiriman
                                            </label>
                                            <input type="date" name="tgl_krm"
                                                class="form-control mb-3 flatpickr-no-config" placeholder="Belum Dikirim"
                                                readonly />
                                            <div class="invalid-feedback">
                                                Masukan tanggal dengan benar.
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Tanggal
                                                Diterima</label>
                                            <input type="date" name="tgl_trm" class="form-control flatpickr-no-config"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Belum Diterima" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="image" class="form-label">Foto Bukti</label>
                                        <img class="img-preview img-fluid mb-3 col-sm-5">
                                        <input class="form-control @error('image') is-invalid @enderror" type="file"
                                            id="image" name="image" onchange="previewImage()" />
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Status</label>
                                            <input type="text" name="status" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp" value="proses"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1" onclick="captureData()">
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

        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    </div>
@endsection
