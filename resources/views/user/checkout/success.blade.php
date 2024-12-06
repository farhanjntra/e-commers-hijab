@extends('user.layout.index')

@section('content')
<div class="container">
    <h2>Pesanan Berhasil</h2>

    <div class="alert alert-success">
        Pesanan Anda telah berhasil diproses. Terima kasih atas pembelian Anda!
    </div>

    <h3>Detail Pesanan</h3>
    <p><strong>Nama Pembeli:</strong> {{ $order->nama_pembeli }}</p>
    <p><strong>Alamat Pembeli:</strong> {{ $order->alamat_pembeli }}</p>
    <p><strong>Total Harga:</strong> {{ number_format($order->total_harga) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

    <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
</div>
@endsection
