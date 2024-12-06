@extends('admin.layout.index')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Produk</h1>

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

        <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Kode Produk (tidak bisa diubah) -->
            <div class="form-group">
                <label for="kode_produk" class="form-label">Kode Produk</label>
                <input
                    type="text"
                    class="form-control black-border"
                    name="kode_produk"
                    id="kode_produk"
                    value="{{ old('kode_produk', $barang->kode_produk) }}"
                    placeholder="Masukkan kode produk unik"
                    disabled>
            </div>

            <!-- Nama Produk -->
            <div class="form-group">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input
                    type="text"
                    class="form-control black-border"
                    name="nama_produk"
                    id="nama_produk"
                    value="{{ old('nama_produk', $barang->nama_produk) }}"
                    placeholder="Masukkan nama produk"
                    required>
            </div>

            <!-- Kategori Produk -->
            <div class="form-group mb-4">
                <label for="id_kategori" class="form-label">Kategori Produk</label>
                <select class="form-control black-border" name="id_kategori" id="id_kategori" required>
                    @foreach ($kategoris as $item)
                        <option value="{{ $item->id }}"
                            {{ $barang->id_kategori == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_kategori }}
                        </option>
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
                            value="{{ old('harga', $barang->harga) }}"
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
                            value="{{ old('stok', $barang->stok) }}"
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
                    required>{{ old('deskripsi', $barang->deskripsi) }}</textarea>
            </div>

            <!-- Gambar Produk (kosongkan jika tidak ingin mengubah gambar) -->
            <div class="form-group">
                <label for="url_gambar" class="form-label">Gambar Produk</label>
                <input
                    type="file"
                    class="form-control black-border"
                    name="url_gambar"
                    id="url_gambar"
                    accept="image/*">
                <small class="form-text text-muted">Format gambar yang diperbolehkan: JPG, PNG, GIF (Maksimal ukuran: 2MB). Kosongkan jika tidak ingin mengubah gambar.</small>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Update Produk</button>
            </div>
        </form>
    </div>
@endsection
