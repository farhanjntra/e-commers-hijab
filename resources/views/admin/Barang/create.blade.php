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

            .form-group {
                margin-bottom: 1.5rem;
            }

            .btn-block {
                display: block;
                width: 100%;
            }
        </style>

        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Kode Produk -->
            <div class="form-group">
                <label for="kode_produk" class="form-label">Kode Produk</label>
                <input
                    type="text"
                    class="form-control black-border"
                    name="kode_produk"
                    id="kode_produk"
                    placeholder="Masukkan kode produk unik"
                    required>
            </div>

            <!-- Nama Produk -->
            <div class="form-group">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input
                    type="text"
                    class="form-control black-border"
                    name="nama_produk"
                    id="nama_produk"
                    placeholder="Masukkan nama produk"
                    required>
            </div>

            <!-- Kategori Produk -->
            <div class="form-group mb-4">
                <label for="id_kategori" class="form-label">Kategori Produk</label>
                <select class="form-control black-border" name="id_kategori" id="id_kategori" required>
                    @foreach ($kategoris as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>



            <!-- Harga dan Stok (side by side) -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga" class="form-label">Harga (Rp)</label>
                        <input
                            type="number"
                            class="form-control black-border"
                            name="harga"
                            id="harga"
                            placeholder="Masukkan harga produk"
                            required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stok" class="form-label">Stok</label>
                        <input
                            type="number"
                            class="form-control black-border"
                            name="stok"
                            id="stok"
                            placeholder="Masukkan jumlah stok"
                            required>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Produk -->
            <div class="form-group">
                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                <textarea
                    class="form-control black-border"
                    name="deskripsi"
                    id="deskripsi"
                    rows="4"
                    placeholder="Deskripsi produk secara rinci (misal: bahan, ukuran, dan fitur)"
                    required></textarea>
            </div>

            <!-- Gambar Produk -->
            <div class="form-group">
                <label for="url_gambar" class="form-label">Gambar Produk</label>
                <input
                    type="file"
                    class="form-control black-border"
                    name="url_gambar"
                    id="url_gambar"
                    accept="image/*"
                    required>
                <small class="form-text text-muted">Format gambar yang diperbolehkan: JPG, PNG, GIF (Maksimal ukuran: 2MB)</small>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">Simpan Produk</button>
            </div>
        </form>
    </div>
@endsection
