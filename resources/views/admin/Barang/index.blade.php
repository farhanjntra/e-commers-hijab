@extends('admin.layout.index')

@section('content')
    <div class="container">
        <h1 class="mb-4">Daftar Produk</h1>
        <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                    <tr>
                        <td>
                            @if ($barang->url_gambar)
                            <a href="{{ Storage::url($barang->url_gambar) }}">
                                <img src="{{ Storage::url($barang->url_gambar) }}" alt="{{ $barang->nama_produk }}" width="100">
                            </a>
                            @else
                                <img src="{{ asset('images/default.jpg') }}" alt="Default Image" width="100">
                            @endif
                        </td>
                        <td>{{ $barang->nama_produk }}</td>
                        <td>{{ $barang->kode_produk }}</td>
                        <td>{{ $barang->id_kategori ?? '-' }}</td>
                        <td>{{ $barang->created_at->format('Y-m-d') }}</td>
                        <td>Rp {{ number_format($barang->harga, 2, ',', '.') }}</td>
                        <td>{{ $barang->deskripsi ?? '-' }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>
                            <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
