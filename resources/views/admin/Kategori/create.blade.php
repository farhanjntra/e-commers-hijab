@extends('admin.layout.index')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Produk Baru</h1>

        <!-- Custom CSS for black borders -->
        <style>
            .black-border {
                border: 2px solid rgb(26, 63, 84);
                box-shadow: none;
            }
            .black-border:focus { 

                border-color: black;
                box-shadow: none;
            }
        </style>

        <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Produk -->
            <div class="form-group mb-4">
                <label for="nama_produk" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control black-border" name="nama_kategori" id="nama_produk" placeholder="Masukkan nama kategori" required>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">Simpan</button>
            </div>
        </form>
    </div>
@endsection
