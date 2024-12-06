@extends('user.layout.index')

@section('content')
    <style>
        .cart-container {
            padding: 20px;
            max-width: 1000px;
            margin: 0 auto;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-container h2 {
            font-size: 28px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .product-table thead {
            background-color: rgb(70, 150, 176);
            color: #fff;
        }

        .product-table thead th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }

        .product-table tbody td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
            text-align: center;
        }

        .product-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .product-table img {
            max-width: 80px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-action {
            padding: 6px 12px;
            font-size: 14px;
            color: #fff;
            background-color: rgb(70, 150, 176);
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-action:hover {
            background-color: #45a049;
        }

        .cart-summary {
            text-align: right;
        }

        .button_checkout {
            background-color: rgb(70, 150, 176);
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button_checkout:hover {
            background-color: #45a049;
        }

        #stock-notification {
            color: red;
            display: none;
            font-size: 12px;
            margin-top: 10px;
        }

        /* Remove spinner from number input */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield; /* For Firefox */
        }
    </style>

    <div class="cart-container">
        <h2>Your Cart</h2>
        <table class="product-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($keranjang as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->barang->nama_produk }}</td>
                        <td>
                            <img src="{{ Storage::url($item->barang->url_gambar) }}" alt="{{ $item->barang->nama_produk }}"/>
                        </td>
                        <td id="jumlah-{{ $item->id }}">
                            <form action="{{ url('update_cart_quantity', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" name="action" value="decrease" class="btn-action" onclick="return validateStock({{ $item->barang->stok }}, '{{ $item->id }}', 'decrease')">-</button>

                                <input type="number" name="jumlah" id="jumlah-input-{{ $item->id }}" value="{{ $item->jumlah }}" min="1" max="{{ $item->barang->stok }}" required
                                       oninput="validateStock({{ $item->barang->stok }}, '{{ $item->id }}', 'input')">

                                <button type="submit" name="action" value="increase" class="btn-action" onclick="return validateStock({{ $item->barang->stok }}, '{{ $item->id }}', 'increase')">+</button>
                            </form>

                            <span id="stock-notification-{{ $item->id }}" style="color: red; display: none;">Out of stock</span>
                        </td>
                        <td>Rp. {{ number_format($item->barang->harga ?? 0, 2, ',', '.') }}</td>
                        <td>Rp. {{ number_format(($item->barang->harga ?? 0) * $item->jumlah, 2, ',', '.') }}</td>
                        <td>
                            <a href="{{ url('hapus_keranjang', $item->id) }}" class="btn btn-warning">Remove</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center;">Your cart is empty.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="cart-summary">
            <a href="{{ url('checkout') }}" class="button_checkout">Proceed to Checkout</a>
        </div>
    </div>

    <script>
        function validateStock(stok, id, action) {
            var jumlahInput = document.getElementById('jumlah-input-' + id);
            var notification = document.getElementById('stock-notification-' + id);
            var currentQuantity = parseInt(jumlahInput.value);

            // If "increase" button and quantity exceeds stock
            if (action === 'increase' && currentQuantity >= stok) {
                notification.style.display = 'inline';  // Show notification if stock is insufficient
                return false;  // Don't allow increase
            }

            // If "decrease" button and quantity is already at minimum
            if (action === 'decrease' && currentQuantity <= 1) {
                return false;  // Don't allow decrease if already at minimum 1
            }

            // If input directly (oninput) and quantity exceeds stock
            if (action === 'input' && currentQuantity > stok) {
                notification.style.display = 'inline';  // Show notification if quantity exceeds stock
                jumlahInput.value = stok;  // Reset input to maximum stock
                return false;
            } else {
                notification.style.display = 'none';  // Hide notification if valid
            }

            return true;  // Allow quantity change
        }
    </script>
@endsection
