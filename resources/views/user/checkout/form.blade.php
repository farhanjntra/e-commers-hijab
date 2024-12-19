@extends('user.layout.index')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Checkout</h3>
        </div>

        <div class="card-body">
            @auth
                @if($keranjangItems->isEmpty())
                    <!-- Jika keranjang kosong -->
                    <div class="alert alert-warning text-center">
                        <p>Keranjang Anda kosong! Silakan tambahkan produk terlebih dahulu.</p>
                        <a href="{{ route('keranjang.index') }}" class="btn btn-warning">Kembali ke Keranjang</a>
                    </div>
                @else
                    <!-- Form checkout -->
                    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Informasi Pembeli -->
                        <div class="mb-4">
                            <h4 class="border-bottom pb-2 mb-3">Informasi Pembeli</h4>
                            <div class="form-group">
                                <label for="nama_pembeli">Nama Pembeli:</label>
                                <input type="text" class="form-control" name="nama_pembeli" id="nama_pembeli" value="{{ Auth::user()->name }}" readonly>
                            </div>

                            <div class="form-group mt-3">
                                <label for="alamat_pembeli">Alamat Pembeli:</label>
                                <textarea class="form-control" name="alamat_pembeli" id="alamat_pembeli" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                            </div>
                        </div>

                        <!-- Informasi Pembayaran -->
                        <div class="alert alert-info">
                            <h5>Informasi Pembayaran</h5>
                            <p class="mb-0">
                                Silakan transfer pembayaran ke nomor rekening berikut:<br>
                                <strong>Bank BCA: 1234567890</strong> <br>
                                <small>(Atas Nama: <strong>Hijabeef Store</strong>)</small>
                            </p>
                        </div>

                        <!-- Bukti Pembayaran -->
                        <div class="form-group mt-3">
                            <label for="bukti_pembayaran">Bukti Pembayaran (Upload Bukti Transfer):</label>
                            <input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran" required>
                        </div>

                        <!-- Detail Keranjang -->
                        <div class="mt-5">
                            <h4 class="border-bottom pb-2 mb-3">Detail Keranjang</h4>
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keranjangItems as $item)
                                        <tr>
                                            <!-- Menampilkan nama produk dari tabel barangs, kolom nama_produk -->
                                            <td>{{ $item->barang->nama_produk ?? 'Barang tidak tersedia' }}</td>
                                            <td>Rp {{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>Rp {{ number_format($item->barang->harga * $item->jumlah, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end">Total Harga:</th>
                                        <th>Rp {{ number_format($totalHarga, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Tombol Checkout -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success btn-lg">Proses Checkout</button>
                        </div>
                    </form>
                @endif
            @else
                <div class="alert alert-danger text-center">
                    <p>Anda harus login terlebih dahulu untuk melakukan checkout.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
