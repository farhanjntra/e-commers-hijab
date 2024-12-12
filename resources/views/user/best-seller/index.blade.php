@extends('user.layout.index')

@section('content')
<section class="products-section" style="background-color: #E7F3F5; padding: 40px 0;">
    <div class="container">
        <div class="text-products row align-items-center mb-4">
            <div class="title-product col-12 col-sm-6 col-md-9">
                <h2 class="text-main font-weight-bold">Best Sellers</h2>
            </div>
        </div>
        <div class="products row justify-content-center">
            @if(isset($bestSellerProducts) && $bestSellerProducts->isNotEmpty())  <!-- Mengecek jika ada data bestSellerProducts -->
                @foreach ($bestSellerProducts as $item)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card shadow border-0" style="border-radius: 15px; overflow: hidden;">
                            <div class="card-body text-center p-4">
                                <div class="product-image mb-3">
                                    @if($item['url_gambar'] && $item['url_gambar'] != 'default_image_url')
                                        <!-- Menampilkan gambar produk jika ada -->
                                        <img src="{{ Storage::url($item['url_gambar']) }}" alt="{{ $item['nama_produk'] }}" class="img-fluid rounded" style="max-height: 180px; object-fit: cover;">
                                    @else
                                        <!-- Menampilkan gambar default jika tidak ada gambar produk -->
                                        <img src="{{ asset('images/hijab.png') }}" alt="Default Image" class="img-fluid rounded" style="max-height: 180px; object-fit: cover;">
                                    @endif
                                </div>
                                <h5 class="text-second mb-2">{{ $item['nama_produk'] }}</h5>
                                <p class="text-main font-weight-bold mb-3">Rp {{ number_format($item['harga'], 2, ',', '.') }}</p>
                                <p class="text-muted">Terjual: {{ $item['jumlah_dibeli'] }} pcs</p> <!-- Menampilkan jumlah terjual -->
                                <a href="{{ route('product.detail', $item['id_barang']) }}" class="btn btn-info">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No best sellers found.</p> <!-- Tampilkan pesan jika tidak ada best sellers -->
            @endif
        </div>
    </div>
</section>
@endsection
