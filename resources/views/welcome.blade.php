@extends('layout.mazer')

@section('judulhal')
    <h3>Halaman Utama</h3>
@endsection

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldBuy"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">
                                            Pesanan
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ $jumlahpesanan }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldUser"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">
                                            Kurir
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ $jumlahpelanggan }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon green mb-2">
                                            <img
                                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAgBJREFUSEvtV9FV20AQnLmT+MVUEFNBTAe4AkIHUEFIBTEVABXgDiAVhA4gFWAqiPlFOm3eypZ8kmWkE3lx3oP71e3O7uze7IrY0uGWcPEB/M+Yf5VqSZIJjDmCyCgoIvIBwC2tPd9ktxE4ByW/BwHWL4ucM44nTT4ageXlZQRj7nMD8hey7DYoAPIEwKfcxtp9krO6fTNwklyC/Lo03CM5DwEWkQGc+53biFwxjs+6AaepRqgR/2AUfQkBLe5KmipLRwBmjKL9VuAKzcApo2jaE1jpvs5ts+yAOzvacOVZo1reSHOZcQvdFeBlbbSphkoRyF7ZlmmJaNYLX9Ye+L1SAovIEFl2E/xmu9ZB37Yx4wJ8BZymq5p0dRZ+r+yZFfDfEIy2QDxBaQZW0RDRtzyAiCrPbpvP2vdnkBOIzEGeQeTz8k2XStYM7LW/OKeGF0HA5Ddae5nrh6+CrRl7Mif9al/WMm9a5x67ZQxMoZMlSQaw9jq407WDnTtFHM/hnA4abVyVzxaqg3gNuLw1YK/2VQFxTvU0tIO7pvwMa0fFiKxKZprqJLrxPD3lctfvqFQuZvLiHDOKyrleBU6SQ5A/Pa3duEG0xbK2wYiMGcd3hd1/Auw/9kVo/edxXXhqK9D6PNY661ZpzBzGTEPXnoLK5YhVX0OQuoVURuz7+5P4AwTsEC7RgepeAAAAAElFTkSuQmCC" />
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">
                                            Kendaraan
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ $jumlahkendaraan }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon red mb-2">
                                            <?xml version="1.0" encoding="UTF-8"?>
                                            <!DOCTYPE svg
                                                PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                id="mdi-account-convert-outline" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 0L11.34 .03L15.15 3.84L16.5 2.5C19.75 4.07 22.09 7.24 22.45 11H23.95C23.44 4.84 18.29 0 12 0M12 4C10.07 4 8.5 5.57 8.5 7.5C8.5 9.43 10.07 11 12 11C13.93 11 15.5 9.43 15.5 7.5C15.5 5.57 13.93 4 12 4M12 6C12.83 6 13.5 6.67 13.5 7.5C13.5 8.33 12.83 9 12 9C11.17 9 10.5 8.33 10.5 7.5C10.5 6.67 11.17 6 12 6M.05 13C.56 19.16 5.71 24 12 24L12.66 23.97L8.85 20.16L7.5 21.5C4.25 19.94 1.91 16.76 1.55 13H.05M12 13C8.13 13 5 14.57 5 16.5V18H19V16.5C19 14.57 15.87 13 12 13M12 15C14.11 15 15.61 15.53 16.39 16H7.61C8.39 15.53 9.89 15 12 15Z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">
                                            Akun
                                        </h6>
                                        <h6 class="font-extrabold mb-0">
                                            2
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>


        <!-- Striped rows start -->
        <section class="section">
            <div class="row" id="table-striped">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pesanan Terbaru</h3>
                        </div>
                        <div class="card-content">

                            <!-- table striped -->
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pesanan</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Kurir</th>
                                            <th>Status</th>
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
                                                <td>{{ $row->pelanggans->namapelanggan }}</td>
                                                @php
                                                    $items = explode(',', $row->namabarang);
                                                    $qty = explode(',', $row->jumlah);
                                                @endphp
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

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Striped rows end -->
    </div>
@endsection
