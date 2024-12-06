@extends('user.layout.index')

@section('content')
    <style>
        /* Styling untuk notifikasi */
        #cart-notification {
            color: green;
            display: none;
            font-size: 14px;
            margin-top: 10px;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            background-color: #28a745;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .mainWrapper {
            padding: 20px;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }

        .productCard_block {
            display: flex;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            max-width: 1200px;
            width: 100%;
            gap: 20px;
        }

        .productCard_leftSide {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .productCard_leftSide img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .productCard_rightSide {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .block_name {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .product-table {
            width: 100%;
            margin: 20px 0;
            font-size: 16px;
            border-spacing: 0;
            border-collapse: collapse;
        }

        .product-table th,
        .product-table td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }

        .product-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .product-table td {
            background-color: #fff;
        }

        .product-description {
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            margin-top: 10px;
            background-color: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 14px;
            line-height: 1.6;
        }

        .button-container {
            margin-top: 20px;
        }

        .button_addToCard {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 12px 24px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button_addToCard:hover {
            background-color: #218838;
        }
    </style>

    <main class="main">
        <div class="mainWrapper">
            <div class="productCard_block">
                <!-- Left Section: Image -->
                <div class="productCard_leftSide">
                    <img src="{{ Storage::url($data->url_gambar) }}" alt="Product Image">
                </div>
                <!-- Right Section: Information -->
                <div class="productCard_rightSide">
                    <h2 class="block_name">Product Information</h2>
                    <table class="product-table">
                        <tr>
                            <th>Product Name</th>
                            <td>{{ $data->nama_produk }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>
                                <div class="product-description">
                                    {{ $data->deskripsi }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Stock</th>
                            <td>{{ $stok }} units</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>Rp. {{ number_format($data->harga, 2, ',', '.') }}</td>
                        </tr>
                    </table>
                    <div class="button-container">
                        <button class="button_addToCard" onclick="addToCart({{ $data->id }})">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifikasi Cart -->
        <div id="cart-notification"></div>
    </main>

    <script>
        // Fungsi untuk menampilkan notifikasi
        function showCartNotification(message) {
            var notification = document.getElementById('cart-notification');
            notification.innerText = message;
            notification.style.display = 'block';

            setTimeout(function() {
                notification.style.display = 'none';
            }, 3000); // Notifikasi akan menghilang setelah 3 detik
        }

        // Fungsi untuk menambahkan produk ke keranjang dan menampilkan notifikasi
        function addToCart(productId) {
            fetch(`/tambah_keranjang/${productId}`, {
                method: 'GET',
                headers: { 'Content-Type': 'application/json' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showCartNotification(data.success);
                } else {
                    showCartNotification(data.error);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
