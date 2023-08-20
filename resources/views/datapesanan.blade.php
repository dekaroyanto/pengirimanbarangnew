@extends('layout.mazer')

@section('css2')
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
    <script>
        function addItems() {
            var kolomPesanan = document.getElementById("kolompesanan");
            var kolomJumlah = document.getElementById("kolomjumlah");

            var orderItem = document.createElement("div");
            orderItem.setAttribute("class", "row mb-2");
            var orderItem2 = document.createElement("div");
            orderItem2.setAttribute("class", "row mb-2");

            var html1 = `<div class="col">
                <input type="text" name="jumlahku[]" id="pesanan" class="form-control"></div>`;
            var html2 = `<div class="col"><input type="text" name="pesananku[]" id="pesanan" class="form-control"></div>`;

            orderItem.innerHTML = html1;
            orderItem2.innerHTML = html2;

            kolomJumlah.appendChild(orderItem);
            kolomPesanan.appendChild(orderItem2);

        }

        function combineValues() {
            const input1Elements = document.querySelectorAll('input[name="pesananku[]"]');
            const input2Elements = document.querySelectorAll('input[name="jumlahku[]"]');

            var input1Values = [];
            var input2Values = [];
            var data1 = ""

            for (var i = 0; i < input1Elements.length; i++) {
                var itemPesanan = input1Elements[i].value;
                var quantityInput = input2Elements[i].value;

                data1 += quantityInput + ",";
                input1Values.push(itemPesanan);
                input2Values.push(quantityInput);
            }

            var hiddenInputPesanan = document.getElementById('hiddenInputPesanan');
            var hiddenInputJumlah = document.getElementById('hiddenInputJumlah');
            hiddenInputPesanan.value = input1Values.join(',');
            hiddenInputJumlah.value = input2Values.join(',');

            hiddenInputPesanan.dispatchEvent(new Event('input'));
            hiddenInputJumlah.dispatchEvent(new Event('input'));
        }
    </script>
@endsection
@section('judulhal')
    <h1>Data Pesanan</h1>
@endsection

@section('content')
    <section class="section">
        <form action="/filter" method="get">
            @csrf
            <div class="col-md-8 mb-1">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>

                    <select name="filterkurir" class="form-select">
                        <option value="">Pilih Kurir</option>
                        @foreach ($datakurir as $datak)
                            <option value="{{ $datak->id }}"
                                {{ request('filterkurir') == $datak->id ? 'selected' : '' }}>
                                {{ $datak->nama }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                        Pilih
                    </button>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('cetak-pesanan') }}" target="_blank" class="btn btn-primary">Cetak Data <i
                        class="fas fa-print"></i></a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            {{-- <th>No</th> --}}
                            <th>Kode Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Kurir</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php
                            $no = 1;
                        @endphp --}}

                        @foreach ($data as $index => $row)
                            @php
                                $items = explode(',', $row->namabarang);
                                $qty = explode(',', $row->jumlah);
                            @endphp
                            <tr class="text-center">
                                {{-- <th scope="row">{{ $index + $data->firstItem() }}</th> --}}
                                <td>{{ $row->kdpsn }}</td>
                                <td>{{ $row->pelanggans->namapelanggan }}</td>
                                <td>
                                    @foreach ($items as $item)
                                        <p>{{ $item }}</p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($qty as $qty)
                                        <p>{{ $qty }}</p>
                                    @endforeach
                                </td>
                                <td>{{ $row->kurirs->nama }}</td>
                                <td>
                                    @if ($row->status == 'Proses')
                                        <span class="badge bg-warning">{{ $row->status }}</span>
                                    @elseif ($row->status == 'Dikirim')
                                        <span class="badge bg-info">{{ $row->status }}</span>
                                    @elseif ($row->status == 'Selesai')
                                        <span class="badge bg-success">{{ $row->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalDetail{{ $row->id }}">
                                        <i class="bi bi-eye-fill"></i>
                                    </button> --}}

                                    <a href="/detailpesanan/{{ $row->id }}" class="btn btn-info"><i
                                            class="bi bi-eye-fill"></i></a>

                                    <a href="/tampilkanpesanan/{{ $row->id }}" class="btn btn-warning"><i
                                            class="bi bi-pencil-square"></i></a>

                                    {{-- <button type="button" class="btn btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exampleModalUbah{{ $row->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button> --}}
                                    @if (auth()->user()->role == 'Admin')
                                        <a href="{{ route('deletepesanan', $row->id) }}" class="btn btn-danger delete"
                                            id="delete" data-id="{{ $row->id }}"
                                            data-nama="{{ $row->kdpsn }}"><i class="bi bi-trash3"></i></a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>


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
                                        <input type="text" name="kdpsn" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" value="{{ $row->kdpsn }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Kurir</label>
                                        <input type="text" name="id_kurirs" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" value="{{ $row->kurirs->nama }}" readonly>
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
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Kendaraan</label>
                                        <input type="text" name="id_kendaraans" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->kendaraans->platno }} - {{ $row->kendaraans->model }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">No Telepon</label>
                                        <input type="text" name="id_pelanggans" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $row->pelanggans->notelp }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Tanggal
                                            Pesanan Masuk</label>
                                        <input type="date" name="tgl_msk" id="tanggal"
                                            class="form-control flatpickr-no-config" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" value="{{ $row->tgl_msk }}" readonly>
                                    </div>
                                </div>

                                @php
                                    $items = explode(',', $row->namabarang);
                                    $qty = explode(',', $row->jumlah);
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
                                            aria-describedby="emailHelp" value="{{ $row->tgl_krm }}" readonly>
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
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Tanggal
                                            Diterima</label>
                                        <input type="text" name="tgl_trm" id="tanggal"
                                            class="form-control flatpickr-no-config" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" value="{{ $row->tgl_trm }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Alamat Lengkap</label>
                                        <textarea name="id_pelanggans" class="form-control" cols="3" rows="3">{{ $row->pelanggans->alamatpelanggan }}</textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6 col-12 mb-2">
                                    <label for="exampleInputEmail1" class="form-label">Bukti Foto</label>
                                    <img src="{{ asset('storage/' . $row->image) }}" class="img-fluid">
                                </div> --}}
                                <!-- Menampilkan thumbnail gambar -->
                                <div class="col-md-6 col-12 mb-2" style="max-height: 150px; overflow:hidden;">
                                    <label for="exampleInputEmail1" class="form-label">Bukti Foto</for=>
                                        <a href="#gambar-1">
                                            <img class="thumb mb-3 col-sm-5 d-block"
                                                src="{{ asset('storage/' . $row->image) }}" alt="gambar bukti" />
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
                                    <img src="{{ asset('storage/' . $row->image) }}" alt="Nelayan Kode">
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
                                        <label for="exampleInputEmail1" class="form-label">Tanggal
                                            Pengiriman
                                        </label>
                                        <input type="text" name="tgl_krm" class="form-control mb-3"
                                            value="{{ $row->tgl_krm }}" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Tanggal
                                            Diterima</label>
                                        <input type="date" name="tgl_trm" class="form-control mb-3"
                                            value="{{ $row->tgl_trm }}" />
                                    </div>
                                </div>
                                @php
                                    $pesananku = explode(',', $row->namabarang);
                                    $jumlahku = explode(',', $row->jumlah);
                                @endphp
                                <div class="col-lg-6">
                                    <div id="orderContainer">
                                        <div class="order-item">
                                            <label>Nama Barang</label>
                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6">
                                                    @foreach ($pesananku as $item)
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control "
                                                                name="pesananku[]" id="namabarang" placeholder="Pesanan"
                                                                value="{{ $item }}" required>
                                                            <label for="namabarang">Pesanan</label>
                                                        </div>
                                                    @endforeach

                                                </div>

                                                <div class="col-md-5">
                                                    @foreach ($jumlahku as $item)
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" name="jumlahku[]"
                                                                id="jumlah" placeholder="Jumlah"
                                                                value="{{ $item }}" required>
                                                            <label for="jumlah">Jumlah</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                    <button class="btn btn-primary" onclick="addItem()" type="button"><i
                                                            class="bi bi-plus-lg"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input id="hasilbarang" name="hasilbarang" class="form-control" type="hidden">
                                <input id="hasiljumlah" name="hasiljumlah" class="form-control" type="hidden">

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
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Alamat Lengkap</label>
                                        <textarea id="exampleFormControlTextarea1" rows="3" class="form-control" readonly>{{ $row->pelanggans->alamatpelanggan }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1" onclick="combineValues()">
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
