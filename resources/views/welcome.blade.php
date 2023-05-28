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
                                        0
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
                                        Ini juga gatau
                                    </h6>
                                    <h6 class="font-extrabold mb-0">
                                        80.000
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
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">
                                        Ini Gatau Apa
                                    </h6>
                                    <h6 class="font-extrabold mb-0">
                                        69
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
                                        <th>Nama Penerima</th>
                                        <th width="300px">Alamat</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
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
                                        <td>{{ $row->penerima }}</td>
                                        <td>{{ $row->alamat }}</td>
                                        <td>{{ $row->namabarang }}</td>
                                        <td>{{ $row->kategori }}</td>
                                        <td>
                                            @if ($row->status == 'Proses')
                                            <span class="badge bg-warning">{{ $row->status }}</span>
                                            @else
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