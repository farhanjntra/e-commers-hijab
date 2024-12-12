@extends('user.layout.index')

@section('content')
<div class="container">
    <h2>Checkout</h2>

    @auth
        @if($keranjangItems->isEmpty())
            <p>Keranjang Anda kosong! Silakan tambahkan produk terlebih dahulu.</p>
            <a href="{{ route('keranjang.index') }}" class="btn btn-warning">Kembali ke Keranjang</a>
        @else
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <!-- Nama Pembeli Diambil dari Tabel Users -->
                <div class="form-group">
                    <label for="nama_pembeli">Nama Pembeli:</label>
                    <input type="text" class="form-control" name="nama_pembeli" id="nama_pembeli" value="{{ Auth::user()->name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="alamat_pembeli">Alamat Pembeli:</label>
                    <textarea class="form-control" name="alamat_pembeli" id="alamat_pembeli" required></textarea>
                </div>

                <h3>Detail Keranjang</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keranjangItems as $item)
                            <tr>
                                <td>{{ $item->barang->nama }}</td>
                                <td>Rp {{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>Rp {{ number_format($item->barang->harga * $item->jumlah, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h4>Total Harga: Rp {{ number_format($totalHarga, 0, ',', '.') }}</h4>

                <button type="submit" class="btn btn-primary">Proses Checkout</button>
            </form>
        @endif
    @else
        <p>Anda harus login terlebih dahulu untuk melakukan checkout.</p>
    @endauth
</div>
@endsection
