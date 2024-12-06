@extends('admin.layout.index')
@section('menuKategori', 'active')

@section('content')
    <div class="container">
        <h1 class="mb-4">Daftar Kategori</h1>

        <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoris as $index=>$product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->nama_kategori }}</td>
                        <td>
                             <!-- Tombol Edit -->
                             <a href="admin/kategori/{{ $product->id}}/edit" class="btn btn-warning btn-sm">Edit</a>

                             <!-- Tombol Delete -->
                             <form action="admin/kategori/{{ $product->id }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                             </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
