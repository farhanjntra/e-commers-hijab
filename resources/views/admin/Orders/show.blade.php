@extends('admin.layout.index')

@section('content')
<h1>Detail Pesanan</h1>

<p><strong>Nama Pembeli:</strong> {{ $order->nama_pembeli }}</p>
<p><strong>Alamat Pembeli:</strong> {{ $order->alamat_pembeli }}</p>
<p><strong>Tanggal Pembelian:</strong> {{ $order->tanggal_pembelian }}</p>
<p><strong>Total Harga:</strong> Rp {{ number_format($order->total_harga, 2) }}</p>
<p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
<p><strong>Items:</strong></p>
<ul>
    @foreach ($order->items as $item)
    <li>{{ $item['product_name'] }} - {{ $item['quantity'] }} x Rp {{ number_format($item['price'], 2) }}</li>
    @endforeach
</ul>

<form action="{{ route('admin.orders.update', $order->id_order) }}" method="POST">
    @csrf
    <label for="status">Update Status:</label>
    <select name="status" id="status">
        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>
    <button type="submit">Update</button>
</form>
@endsection
