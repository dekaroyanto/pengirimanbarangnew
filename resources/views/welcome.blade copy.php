@extends('layout.admin')

@section('navbar')
<i class="bx bx-menu"></i>
<a href="#" class="nav-link">Utama</a>
<form action="#">
    <div class="form-input">
        <input type="search" placeholder="Search..." />
        <button type="submit" class="search-btn">
            <i class="bx bx-search"></i>
        </button>
    </div>
</form>
<input type="checkbox" id="switch-mode" hidden />
<label for="switch-mode" class="switch-mode"></label>
<a href="#" class="notification">
    <i class="bx bxs-bell"></i>
    <span class="num">8</span>
</a>
<div class="btn-group">
    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <a href="#" class="profile">
            <img src="img/people.png" />
        </a>
    </button>

    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">My Profile</a></li>
        <li><a class="dropdown-item" href="#">Account Setting</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#">Logout</a></li>
    </ul>
</div>

@endsection

@section('dashead')
<div class="head-title">
    <div class="left">
        <h1>Dashboard</h1>
        <ul class="breadcrumb">
            <li>
                <a href="/">Home</a>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('dash')
<ul class="box-info">
    <li>
        <a href="/pesanan"><i class='bx bxs-shopping-bag'></i></a>

        <span class="text">
            <h3>{{ $jumlahpesanan }}</h3>
            <p>Total Pesanan</p>
        </span>
    </li>
    <li>
        <i class="bx bxs-group"></i>
        <span class="text">
            <h3>0</h3>
            <p>Kurir</p>
        </span>
    </li>
    <li>
        <i class='bx bxs-car'></i>
        <span class="text">
            <h3>0</h3>
            <p>Kendaraan</p>
        </span>
    </li>
</ul>
@endsection

@section('main')
<div class="table-data">
    <div class="order">
        <div class="head">
            <h3>Pesanan Terbaru</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pesanan</th>
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
                    <td>{{ $row->namabarang }}</td>
                    <td>{{ $row->kategori }}</td>
                    <td>
                        @if ($row->status == 'Proses')
                        <span class="status process">{{ $row->status }}</span>
                        @else
                        <span class="status completed">{{ $row->status }}</span>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $data->links() }} --}}
    </div>
</div>


@endsection