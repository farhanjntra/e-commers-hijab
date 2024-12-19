@extends('user.layout.index')


@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Status Pesanan Saya</h1>

    <!-- Filter Urutan Pesanan -->
    <div class="mb-4">  
        <form method="GET" action="{{ route('user.orders.index') }}">
            <label for="sortOrder" class="form-label">Urutkan Berdasarkan:</label>
            <select name="sort" id="sortOrder" class="form-select" onchange="this.form.submit()">
                <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Pesanan Terbaru</option>
                <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Pesanan Terlama</option>
            </select>
        </form>
    </div>

    @if($orders->isEmpty())
        <p class="alert alert-warning">Belum ada pesanan yang dilakukan.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama Pembeli</th>
                    <th>Tanggal Pembelian</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->nama_pembeli }}</td>
                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge
                            {{ $order->status === 'pending' ? 'bg-warning text-dark' : '' }}
                            {{ $order->status === 'processed' ? 'bg-primary' : '' }}
                            {{ $order->status === 'completed' ? 'bg-success' : '' }}
                        ">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
