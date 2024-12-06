@extends('admin.layout.index')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Produk</h1>

        <style>
            /* Custom class for black borders */
            .black-border {
                border: 2px solid black;
                box-shadow: none; /* Removes any shadow if present */
            }

            .black-border:focus {
                border-color: black; /* Ensures focus state also has a black border */
                box-shadow: none; /* Removes shadow on focus */
            }
        </style>

        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Produk -->
            <div class="form-group mb-4">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control black-border" name="nama_kategori" id="nama_produk"
                    value="{{ old('nama_produk', $kategori->nama_kategori) }}" placeholder="Masukkan nama kategori" required>
            </div>


            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </div>
        </form>
    </div>
@endsection
