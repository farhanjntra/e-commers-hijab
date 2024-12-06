@extends('user.layout.index')

@section('content')
<div class="container">
    <h2>Checkout</h2>

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
                        <td>{{ number_format($item->barang->harga) }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ number_format($item->barang->harga * $item->jumlah) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Proses Checkout</button>
    </form>
</div>
@endsection
