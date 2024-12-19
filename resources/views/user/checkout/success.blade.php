@extends('user.layout.index')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white text-center">
            <h3 class="mb-0">Checkout Berhasil</h3>
        </div>
        <div class="card-body">
            <!-- Pesan Terima Kasih -->
            <div class="alert alert-success text-center">
                <h5>Terima kasih, <strong>{{ $order->nama_pembeli }}</strong>!</h5>
                <p>Pemesanan Anda telah berhasil diproses.</p>
            </div>

            <!-- Detail Pesanan -->
            <div class="mb-4">
                <h5 class="border-bottom pb-2">Detail Pesanan</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Nama Pembeli:</strong> {{ $order->nama_pembeli }}</li>
                    <li class="list-group-item"><strong>Alamat Pembeli:</strong> {{ $order->alamat_pembeli }}</li>
                    <li class="list-group-item"><strong>Total Pembayaran:</strong> Rp {{ number_format($order->total_harga, 0, ',', '.') }}</li>
                    <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($order->status) }}</li>
                </ul>
            </div>

            <!-- Bukti Pembayaran -->
            @if($order->bukti_pembayaran)
                <div class="mb-4 text-center">
                    <h5 class="border-bottom pb-2">Bukti Pembayaran</h5>
                    <img src="{{ asset('storage/uploads/bukti_pembayaran/' . $order->bukti_pembayaran) }}"
                         alt="Bukti Pembayaran"
                         class="img-thumbnail"
                         style="max-width: 300px;">
                </div>
            @endif

            <!-- Tombol Kembali -->
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-home me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
