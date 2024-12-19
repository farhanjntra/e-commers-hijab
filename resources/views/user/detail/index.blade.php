@extends('user.layout.index')

@section('content')
    <style>
        /* Styling untuk Notifikasi Popup */
        #cart-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            background-color: #28a745;
            color: #fff;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            display: none;
            font-size: 14px;
            animation: fadeInOut 3s forwards;
        }

        /* Animasi Fade In dan Out */
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-20px); }
            10%, 90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }

        /* Wrapper Utama */
        .mainWrapper {
            padding: 20px;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
        }

        /* Kartu Produk */
        .productCard_block {
            display: flex;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            max-width: 1200px;
            width: 100%;
            gap: 20px;
            flex-wrap: wrap;
        }

        .productCard_leftSide img {
            max-width: 50%;  /* Ubah ukuran gambar menjadi 50% */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            object-fit: cover; /* Pastikan gambar tetap proporsional */
        }

        .productCard_rightSide {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 15px;
        }

        /* Nama Produk */
        .block_name {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        /* Tabel Informasi */
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

        /* Deskripsi Produk */
        .product-description {
            max-height: 200px;  /* Membatasi tinggi deskripsi */
            overflow-y: auto;   /* Menambahkan scrollbar jika konten lebih panjang */
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 14px;
            line-height: 1.5;
        }

        /* Tombol Container */
        .button-container {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: space-between;
        }

        /* Tombol Add to Cart dan Buy */
        .button_addToCard, .button_buyNow {
            padding: 12px 24px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button_addToCard {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        .button_addToCard:hover {
            background-color: #218838;
        }

        .button_buyNow {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .button_buyNow:hover {
            background-color: #0056b3;
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
                    <h2 class="block_name">{{ $data->nama_produk }}</h2>
                    <table class="product-table">
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
                            <td>{{ $stok }} pcs</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>Rp. {{ number_format($data->harga, 2, ',', '.') }}</td>
                        </tr>
                    </table>
                    <div class="button-container">
                        @auth
                            <!-- Tombol Add to Cart -->
                            <button class="button_addToCard" onclick="addToCart({{ $data->id }})">Add to Cart</button>
                            <!-- Tombol Buy Now -->
                            <a href="{{ route('checkout.form') }}" class="button_buyNow">Buy Now</a>
                        @else
                            <!-- Jika pengguna belum login -->
                            <button class="button_addToCard" onclick="showLoginNotification()">Add to Cart</button>
                            <a href="{{ route('login') }}" class="button_buyNow">Buy Now</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifikasi Popup -->
        <div id="cart-notification"></div>
    </main>

    <!-- JavaScript -->
    <script>
        // Menampilkan notifikasi untuk pengguna yang belum login
        function showLoginNotification() {
            showCartNotification("Warning! You need to log in to add items to the cart.", 'red');
        }

        // Fungsi untuk menampilkan notifikasi
        function showCartNotification(message, bgColor = '#28a745') {
            var notification = document.getElementById('cart-notification');
            notification.innerText = message;
            notification.style.backgroundColor = bgColor;
            notification.style.display = 'block';

            // Sembunyikan notifikasi setelah 3 detik
            setTimeout(function() {
                notification.style.display = 'none';
            }, 3000);
        }

        // Fungsi untuk menambahkan produk ke keranjang
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
                    showCartNotification(data.error, 'red');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showCartNotification('Something went wrong. Please try again.', 'red');
            });
        }
    </script>
@endsection
