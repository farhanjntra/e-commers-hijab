@extends('admin.layout.index')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Daftar Pesanan</h1>

    <!-- Menampilkan pesan error jika tidak ada pesanan -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Menampilkan pesan sukses jika status diperbarui -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
                        {{-- @if ($order->status == 'pending')
                            <span class="btn btn-danger">Pending</span>
                        @elseif ($order->status == 'processed')
                            <span class="btn btn-danger">Proses</span>
                        @else
                            <span class="btn btn-danger">Complate</span>
                        @endif --}}
                        <span
                            class="btn btn-sm d-flex justify-content-center
                                {{
                                    $order->status == 'pending'
                                        ? 'btn-danger la la-exclamation-triangle'
                                        : ($order->status == 'completed'
                                            ? 'btn-success la la-check'
                                            : 'btn-info la la-spinner')
                                }}">
                            {{-- {{ ucfirst($order->status) }} --}}
                        </span>

                    </td>
                    <td>
                        <form action="{{ route('admin.orders.update-status', $order->id_order) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="processed">
                            <button type="submit" class="btn btn-warning btn-sm" {{ $order->status !== 'pending' ? 'disabled' : '' }}>Proses</button>
                        </form>
                        <form action="{{ route('admin.orders.update-status', $order->id_order) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="btn btn-success btn-sm" {{ $order->status !== 'processed' ? 'disabled' : '' }}>Selesai</button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada pesanan yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush
