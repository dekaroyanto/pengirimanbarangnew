@extends('layout.mazer')

@section('css2')
    <style>
        .mainwrapper {
            background: #fefefe;
            display: flex;
            width: 100%;
            height: 100%;
            /* justify-content: center;
                                                                                                                                                        align-items: center; */
        }

        img.imgthumb {
            width: 150px;
            border-radius: 10px;
        }

        /* overlay by webprogramminunpas and modified by nelayankode.com*/
        .overlay {
            width: 0;
            height: 0;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0);
            z-index: 9999;
            transition: .8s;
            text-align: center;
            padding: 100px 0;
        }

        .overlay:target {
            width: auto;
            height: auto;
            bottom: 0;
            right: 0;
            background: rgba(0, 0, 0, .7);
        }

        .overlay img {
            max-height: 100%;
            box-shadow: 2px 2px 7px rgba(0, 0, 0, .5);
        }

        .overlay:target img {
            animation: zoomDanFade 1s;
        }

        .overlay .close {
            position: absolute;
            top: 2%;
            left: 2%;
            margin-left: -20px;
            color: white;
            text-decoration: none;
            line-height: 14px;
            padding: 5px;
            opacity: 0;
        }

        .overlay:target .close {
            animation: slideDownFade .5s .5s forwards;
        }

        /* animasi */
        @keyframes zoomDanFade {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes slideDownFade {
            0% {
                opacity: 0;
                margin-top: -20px;
            }

            100% {
                opacity: 1;
                margin-top: 0;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

    <link rel="shortcut icon" href="{{ asset('mazer/assets/compiled/svg/favicon.svg') }} " type="image/x-icon" />
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png" />

    <link rel="stylesheet" href="{{ asset('mazer/assets/extensions/simple-datatables/style.css') }} " />

    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/table-datatable.css') }}" />
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app-dark.css') }}" />
@endsection

@section('inijs')
    <script src="{{ asset('mazer/assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('mazer/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('mazer/assets/compiled/js/app.js') }}"></script>
    <script src="{{ asset('mazer/assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('mazer/assets/static/js/pages/date-picker.js') }}"></script>

    <script src="{{ asset('mazer/assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('mazer/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('mazer/assets/compiled/js/app.js') }}"></script>

    <script src="{{ asset('mazer/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('mazer/assets/static/js/pages/simple-datatables.js') }}"></script>

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
                            <h3 class="card-title">Detail Pesanan</h3>
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
                                            <input type="text" name="kdpsn" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                value="{{ $data->kdpsn }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Kurir</label>
                                            <input type="text" name="id_kurirs" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                value="{{ $data->kurirs->nama }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Nama Pelanggan</label>
                                            <input type="text" name="id_pelanggans" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                value="{{ $data->pelanggans->namapelanggan }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Kendaraan</label>
                                            <input type="text" name="id_kendaraans" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                value="{{ $data->kendaraans->platno }} - {{ $data->kendaraans->model }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">No Telepon</label>
                                            <input type="text" name="id_pelanggans" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                value="0{{ $data->pelanggans->notelp }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Tanggal
                                                Pesanan Masuk</label>
                                            <input type="date" name="tgl_msk" id="tanggal"
                                                class="form-control flatpickr-no-config" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" value="{{ $data->tgl_msk }}" readonly>
                                        </div>
                                    </div>

                                    @php
                                        $items = explode(',', $data->namabarang);
                                        $qty = explode(',', $data->jumlah);
                                    @endphp
                                    <div class="col-md-3 col-12 ">
                                        <div id="" class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Nama
                                                Barang</label>
                                            @foreach ($items as $item)
                                                <div class="form-floating">
                                                    <input type="text" id="namabarang" value="{{ $item }}"
                                                        class="form-control">
                                                    <label for="namabarang">Nama Barang</label>
                                                </div>
                                            @endforeach
                                            <div class="invalid-feedback">
                                                Masukan nama barang dengan benar.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div id="" class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Jumlah</label>
                                            @foreach ($qty as $qty)
                                                <div class="form-floating">
                                                    <input type="text" id="jumlah" class="form-control"
                                                        value="{{ $qty }}">
                                                    <label for="jumlah">Jumlah</label>
                                                </div>
                                            @endforeach
                                            <div class="invalid-feedback">
                                                Masukan nama barang dengan benar.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Tanggal
                                                Pengiriman</label>
                                            <input type="text" name="tgl_krm" id="tanggal"
                                                class="form-control flatpickr-no-config" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" value="{{ $data->tgl_krm }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Status</label>
                                            <input type="text" name="status" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                value="{{ $data->status }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Tanggal
                                                Diterima</label>
                                            <input type="text" name="tgl_trm" id="tanggal"
                                                class="form-control flatpickr-no-config" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" value="{{ $data->tgl_trm }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Alamat Lengkap</label>
                                            <textarea name="id_pelanggans" class="form-control" cols="3" rows="3" readonly>{{ $data->pelanggans->alamatpelanggan }}</textarea>
                                        </div>
                                    </div>

                                    {{-- <div class="col-12">
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
                                    </div> --}}

                                    <!-- Menampilkan thumbnail gambar -->
                                    <div class="col-md-6 col-12" style="max-height: 100px; overflow:hidden;">
                                        <label for="exampleInputEmail1" class="form-label">Bukti Foto</for=>
                                            <a href="#gambar-1">
                                                <img class="thumb mb-3 col-sm-5 d-block"
                                                    src="{{ asset('storage/' . $data->image) }}" alt="gambar bukti" />
                                            </a>
                                    </div>
                                    <!-- Menampilkan popup gambar -->
                                    <div class="overlay" id="gambar-1">
                                        <a href="#" class="close">
                                            <svg style="width:47px;height:47px" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2C6.47,2 2,6.47 2,12C2,17.53 6.47,22 12,22C17.53,22 22,17.53 22,12C22,6.47 17.53,2 12,2M14.59,8L12,10.59L9.41,8L8,9.41L10.59,12L8,14.59L9.41,16L12,13.41L14.59,16L16,14.59L13.41,12L16,9.41L14.59,8Z" />
                                            </svg>
                                        </a>
                                        <img src="{{ asset('storage/' . $data->image) }}" alt="Nelayan Kode">
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <a href="/pesanan" class="btn btn-light-secondary me-1 mb-1"
                                            role="button">Kembali</a>
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
