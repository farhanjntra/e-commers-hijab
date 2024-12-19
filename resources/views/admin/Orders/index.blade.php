@extends('admin.layout.index')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Daftar Pesanan</h1>

    <!-- Notifikasi jumlah pesanan baru -->
    @if(session('new_order_count') && session('new_order_count') > 0)
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Notifikasi!</strong> Ada {{ session('new_order_count') }} pesanan baru yang belum diproses.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Filter Urutan Pesanan -->
    <div class="mb-3">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="form-inline">
            <label for="sort" class="mr-2">Urutkan Berdasarkan:</label>
            <select name="sort" id="sort" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
                <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Terbaru</option>
                <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>Terlama</option>
            </select>
        </form>
    </div>

    <!-- Tabel Pesanan -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID Order</th>
                    <th>Nama Pembeli</th>
                    <th>Alamat Pembeli</th>
                    <th>Tanggal Pembelian</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Bukti Transfer</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id_order }}</td>
                    <td>{{ $order->nama_pembeli }}</td>
                    <td>{{ $order->alamat_pembeli }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->tanggal_pembelian)->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($order->total_harga, 2, ',', '.') }}</td>
                    <td>
                        <span class="btn btn-sm d-flex justify-content-center {{
                                $order->status == 'pending' ? 'btn-danger la la-exclamation-triangle' :
                                ($order->status == 'completed' ? 'btn-success la la-check' : 'btn-info la la-spinner')
                            }}">
                        </span>
                    </td>
                    <td>
                        @if($order->bukti_pembayaran)
                            <a href="{{ asset('storage/uploads/bukti_pembayaran/' . $order->bukti_pembayaran) }}" target="_blank">
                                <img src="{{ asset('storage/uploads/bukti_pembayaran/' . $order->bukti_pembayaran) }}" alt="Bukti Transfer" style="width: 100px; height: auto;">
                            </a>
                        @else
                            <span class="text-muted">Belum ada bukti</span>
                        @endif
                    </td>
                    <td>
                        <!-- Tombol untuk memproses pesanan -->
                        <form action="{{ route('admin.orders.update-status', $order->id_order) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="processed">
                            <button type="submit" class="btn btn-warning btn-sm" {{ $order->status !== 'pending' ? 'disabled' : '' }}>Proses</button>
                        </form>
                        <!-- Tombol untuk menyelesaikan pesanan -->
                        <form action="{{ route('admin.orders.update-status', $order->id_order) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="btn btn-success btn-sm" {{ $order->status !== 'processed' ? 'disabled' : '' }}>Selesai</button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada pesanan yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
