<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table.static {
            position: relative border: 1px solid #543535;
        }
    </style>
    <title>CETAK DATA PESANAN</title>
</head>

<body>
    <div class="form-group">
        <table class="form-group">
            <p align="center"><b>Laporan Data Pesanan</b></p>
            <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
                <tr>
                    <th>No</th>
                    <th>Kode Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Kurir</th>
                    <th>Tanggal Masuk</th>
                    <th>Status</th>
                </tr>
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->kdpsn }}</td>
                        <td>{{ $row->pelanggans->namapelanggan }}</td>
                        <td>
                            @php
                                $items = explode(',', $row->namabarang);
                                $qty = explode(',', $row->jumlah);
                            @endphp
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
                        <td>{{ $row->tgl_msk }}</td>
                        <td>{{ $row->status }}</td>
                    </tr>
                @endforeach

            </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
