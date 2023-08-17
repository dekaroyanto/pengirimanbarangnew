@extends('layout.mazer')

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
        function captureData() {
            var orderItems = document.getElementsByClassName("barang");
            var table = document.getElementsByClassName("jumlah");

            var itemData = "";
            var quantityData = "";


            for (var i = 0; i < orderItems.length; i++) {
                // var itemInput = orderItems[i].getElementsByTagName("input")[0].value;
                // var quantityInput = orderItems[i].getElementsByTagName("input")[1].value;
                var quantityInput = table[i].value;
                var itemInput = orderItems[i].value;

                itemData += itemInput + ",";
                quantityData += quantityInput + ",";

            }

            document.getElementById("hasilbarang").value = itemData.slice(0, -1);
            document.getElementById("hasiljumlah").value = quantityData.slice(0, -1);

        }

        function removeItem() {
            var kolomPesanan = document.getElementById("kolompesanan");
            var kolomJumlah = document.getElementById("kolomjumlah");

            var lastPesananRow = kolomPesanan.querySelector('.ulangin:last-of-type');
            var lastJumlahRow = kolomJumlah.querySelector('.ulangin:last-of-type');

            kolomPesanan.removeChild(lastPesananRow);
            kolomJumlah.removeChild(lastJumlahRow);
            input1Values.pop();
            input2Values.pop();
        }


        function addItem() {
            var kolomPesanan = document.getElementById("kolompesanan");
            var kolomJumlah = document.getElementById("kolomjumlah");

            var orderItem = document.createElement("div");
            orderItem.setAttribute("class", "row mb-2 ulangin");
            var orderItem2 = document.createElement("div");
            orderItem2.setAttribute("class", "row mb-2 ulangin");

            var html1 =
                `<div class="col"><input type="text" name="jumlahku[]" id="pesanan" class="form-control jumlah"></div>`;
            var html2 =
                `<div class="col"><input type="text" name="pesananku[]" id="pesanan" class="form-control barang"></div>`;

            orderItem.innerHTML = html1;
            orderItem2.innerHTML = html2;

            kolomJumlah.appendChild(orderItem);
            kolomPesanan.appendChild(orderItem2);
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
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Kendaraan</label>
                                            <select class="form-select" name="id_kendaraans"
                                                aria-label="Default select example">

                                                {{-- <option selected>{{ $row->id_kurirs }}</option> --}}
                                                @foreach ($datakendaraan as $dataken)
                                                    <option value="{{ $dataken->id }}"
                                                        {{ $dataken->id == $data->id_kurirs ? 'selected' : '' }}>
                                                        {{ $dataken->platno }} - {{ $dataken->model }}
                                                    </option>
                                                @endforeach



                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Tanggal
                                                Pesanan Masuk
                                            </label>
                                            <input type="date" name="tgl_msk" id="tanggal"
                                                class="form-control mb-3 flatpickr-no-config"
                                                value="{{ $data->tgl_msk }}" />
                                            <div class="invalid-feedback">
                                                Masukan tanggal dengan benar.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Tanggal
                                                Pengiriman
                                            </label>
                                            <input type="date" name="tgl_krm" id="tanggal"
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
                                            <input type="date" name="tgl_trm" id="tanggal"
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

                                    <div class="col-12">
                                        <label for="image" class="form-label">Foto Bukti</label>
                                        @if ($data->image)
                                            <img src="{{ asset('storage/' . $data->image) }}"
                                                class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                        @else
                                            <img class="img-preview img-fluid mb-3 col-sm-5">
                                        @endif
                                        <input class="form-control @error('image') is-invalid @enderror" type="file"
                                            id="image" name="image" onchange="previewImage()" />
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    @php
                                        $pesananku = explode(',', $data->namabarang);
                                        $jumlahku = explode(',', $data->jumlah);
                                    @endphp

                                    <div id="kolompesanan" class="col-6">
                                        <label for="pesanan">Pesanan</label>
                                        @foreach ($pesananku as $item)
                                            <div class="row mb-2 ulangin">
                                                <div class="col">
                                                    <input type="text" name="pesananku[]" id="pesanan"
                                                        class="form-control barang" value="{{ $item }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="kolomjumlah" class="col-6">
                                        <label for="jumlah">Jumlah</label>
                                        @foreach ($jumlahku as $item)
                                            <div class="row mb-2 ulangin">
                                                <div class="col">
                                                    <input type="text" name="jumlahku[]" id="pesanan"
                                                        class="form-control jumlah" value="{{ $item }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col d-flex justify-content-center">
                                        <button class="btn btn-primary" onclick="addItem()" type="button"><i
                                                class="bi bi-plus-lg"></i></button>
                                        <button class="btn btn-danger ms-2" type="button" onclick="removeItem()">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                    </div>



                                    <input id="hasilbarang" name="hasilbarang" class="form-control" type="hidden">
                                    <input id="hasiljumlah" name="hasiljumlah" class="form-control" type="hidden">

                                </div>
                        </div>
                    </div>


                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1" onclick="captureData()">
                            Simpan
                        </button>
                        <a href="/pesanan" class="btn btn-light-secondary me-1 mb-1" role="button">Batal</a>
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
