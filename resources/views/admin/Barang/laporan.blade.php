<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Laporan Barang</h1>
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kode Produk</th>
                <th>Kategori</th>
                <th>Tanggal Masuk</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
                <tr>
                    <td>
                        @if ($barang->url_gambar)
                            <img src="{{ Storage::url($barang->url_gambar) }}" alt="{{ $barang->nama_produk }}" width="50">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Default Image" width="50">
                        @endif
                    </td>
                    <td>{{ $barang->nama_produk }}</td>
                    <td>{{ $barang->kode_produk }}</td>
                    <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $barang->created_at->format('Y-m-d') }}</td>
                    <td>Rp {{ number_format($barang->harga, 2, ',', '.') }}</td>
                    <td>{{ $barang->deskripsi ?? '-' }}</td>
                    <td>{{ $barang->stok }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
