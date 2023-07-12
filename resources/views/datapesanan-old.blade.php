<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>CV FIRMOS - Data Pesanan</title>
</head>

<body>
    <h1 class="text-center mb-4">Data Pesanan</h1>

    <div class="container">
        <a href="/tambahpesanan" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal2">Tambah Data</a>
        {{-- <div class="row mt-2">
            <div class="col-3">
                <input type="search" id="inputPassword6" name="search" class="form-control float-right"
                    placeholder="Cari" aria-describedby="passwordHelpInline" value="{{ request('search') }}">
    </div>

    <div class="col-5">
        <button type="submit" class="btn btn-secondary">
            <i class="bi bi-search"></i>
        </button>
    </div>

    <div class="col-sm-2">
        <a href="#" class="btn btn-outline-danger">Export PDF</a>
    </div>
    <div class="col">
        <a href="#" class="btn btn-outline-success me-5">Export Excel</a>
    </div>
    </div> --}}


    <div class="row align-items-center mt-2">

        <form action="/pesanan" method="GET" class="row">
            <div class="col-sm-3">
                <input type="search" id="inputPassword6" name="search" class="form-control float-right" placeholder="Cari" aria-describedby="passwordHelpInline" value="{{ request('search') }}">


            </div>
            <div class="col-1">
                <button type="submit" class="btn btn-secondary">
                    <i class="bi bi-search"></i>
                </button>

            </div>
            <div class="col">
                <a href="/exportpdf" class="btn btn-outline-danger ms-5">Export PDF</a>
                <a href="#" class="btn btn-outline-success">Export Excel</a>
            </div>

        </form>
    </div>


    <div class="row">
        {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
    </div>
    @endif --}}
    <table class="table">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                {{-- <th scope="col">Foto</th> --}}
                <th scope="col">Kode Pesanan</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Kategori</th>
                {{-- <th scope="col">Alamat</th> --}}
                {{-- <th scope="col">Tanggal Pengiriman</th> --}}
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp

            @foreach ($data as $index => $row)
            <tr class="text-center">
                <th scope="row">{{ $index + $data->firstItem() }}</th>
                {{-- <td>
                            <img src="{{ asset('fotopesanan/'.$row->foto) }}" alt="" style="width:40px;">
                </td> --}}
                <td>{{ $row->kdpsn }}</td>
                <td>{{ $row->namabarang }}</td>
                <td>{{ $row->kategori }}</td>
                {{-- <td>{{ $row->alamat }}</td> --}}
                {{-- <td>{{ $row->created_at->format('d-M-Y H:i') }}</td> --}}
                <td>{{ $row->status }}</td>
                <td>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModalDetail{{ $row->id }}">
                        <i class="bi bi-eye-fill"></i>
                    </button>

                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModalUbah{{ $row->id }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}" data-nama="{{ $row->namabarang }}"><i class="bi bi-trash3"></i></a>
                </td>
                {{-- @include('modal.editpesanan') --}}
            </tr>
            @endforeach

            {{-- /tampilkanpesanan/{{ $row->id }} --}}
        </tbody>
    </table>
    {{ $data->links() }}
    </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/insertpesanan" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kode Pesanan</label>
                            <input type="text" name="kdpsn" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                            <input type="text" name="namabarang" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kategori</label>
                            <select class="form-select" name="kategori" aria-label="Default select example">
                                {{-- <option selected>Pilih Kategori</option> --}}
                                <option value="Printing">Printing</option>
                                <option value="Advertising">Advertising</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example">
                                <!-- <option option>Pilih Status</option> -->
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Masukan Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a class="btn btn-primary" href="/pesanan" role="button">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah -->

    <!-- Modal Detail -->
    @foreach ($data as $index => $row)
    <div class="modal fade" id="exampleModalDetail{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/updatepesanan/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kode Pesanan</label>
                            <input type="text" name="kdpsn" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->kdpsn }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                            <input type="text" name="namabarang" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->namabarang }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kategori</label>
                            <input type="text" name="kategori" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->kategori }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3" readonly>{{ $row->alamat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status</label>
                            <input type="text" name="status" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->status }}" readonly>

                            </select>
                        </div>
                        <a class="btn btn-primary" href="/pesanan" role="button">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- End Modal Detail -->

    <!-- Modal Edit -->
    @foreach ($data as $index => $row)
    <div class="modal fade" id="exampleModalUbah{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/updatepesanan/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kode Pesanan</label>
                            <input type="text" name="kdpsn" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->kdpsn }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                            <input type="text" name="namabarang" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $row->namabarang }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kategori</label>
                            <select class="form-select" name="kategori" aria-label="Default select example">
                                <!-- <option selected>Pilih Kategori</option> -->
                                <option selected>{{ $row->kategori }}</option>

                                @if ($row->kategori == 'Printing')
                                <option value="Advertising">Advertising</option>
                                @else
                                <option value="Printing">Printing</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3">{{ $row->alamat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example">

                                <!-- <option option>Pilih Status</option> -->
                                <option selected>{{ $row->status }}</option>

                                @if ($row->status == 'Proses')
                                <option value="Selesai">Selesai</option>
                                @else
                                <option value="Proses">Proses</option>
                                @endif

                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a class="btn btn-danger" href="/pesanan" role="button">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- End Modal Edit -->


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.3.slim.js"
        integrity="sha256-DKU1CmJ8kBuEwumaLuh9Tl/6ZB6jzGOBV/5YpNE2BWc=" crossorigin="anonymous"></script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>
<script>
    $('.delete').click(function() {
        var pesananid = $(this).attr('data-id');
        var namabarang = $(this).attr('data-nama');
        swal({
                title: "Yakin ?",
                text: "Kamu akan menghapus data pesanan dengan nama " + namabarang + " ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/deletepesanan/" + pesananid + "",
                        swal("Data Berhasil Dihapus !", {
                            icon: "success",
                        });
                } else {
                    swal("Batal Menghapus Data !");
                }
            });
    });
</script>

<script>
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
    @endif
</script>

</html>