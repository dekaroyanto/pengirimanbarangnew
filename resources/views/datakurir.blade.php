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

                        <h1>Data Kurir</h1>

                    </div>
                    <div class="card-content mt-2">
                        {{ Session::get('halaman_url') }}
                        <div class="row">
                            <div class="col-md-4 mb-1">
                                <form action="/kurir" method="GET">
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
                            <div class="col-md-auto">
                                <div class="input-group mb-3">
                                    <a href="/tambahkurir" class="btn btn-outline-secondary">Tambah Data</a>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="input-group mb-3">
                                    <a href="/tambahkurir" class="btn icon icon-left btn-outline-secondary"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                            data-feather="file"></i> Download</a>
                                </div>
                            </div>


                        </div>

                        <div class="row" id="table-striped">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content">

                                        <!-- table striped -->
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Kurir</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $no = 1;
                                                    @endphp

                                                    @foreach ($datak as $index => $row)

                                                    <tr class="text-center">
                                                        <th scope="row">{{ $index + $datak->firstItem() }}</th>

                                                        <td>{{ $row->nama }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{ $datak->links() }}
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
@endsection