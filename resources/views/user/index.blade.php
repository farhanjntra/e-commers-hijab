@extends('user.layout.index')
@section('content')

<!-- BANNER -->
<section class="banner" style="position: relative; background-image: url('{{ asset('images/hijaab.JPG') }}'); background-size: cover; background-position: center; height: 100vh; display: flex; align-items: center;">
    <!-- Overlay untuk membuat teks lebih jelas -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>

    <div class="container" style="position: relative; max-width: 1200px; margin: auto; text-align: left; z-index: 2; color: white;">
        <div class="banner-text col-sm-12 col-md-6">
            <p style="font-size: 20px; margin-bottom: 15px; color: #e0e0e0;">Hijabef Shop</p>
            <h2 style="font-size: 48px; font-weight: 700; margin-bottom: 25px; line-height: 1.2; color: #ffffff;">Keanggunan dalam setiap cerita kita</h2>
            <p style="font-size: 18px; margin-bottom: 35px; color: #d0d0d0;">Hijabeef menjadi pilihan setiap muslimah, untuk tampil anggun dan percaya diri</p>
            <a href="{{ url('allproduk') }}"
            class="btn-rounded"
            style="display: inline-flex; justify-content: center; align-items: center; padding: 12px 30px; background-color: rgb(108, 191, 219); color: white; text-decoration: none; border-radius: 25px; font-size: 16px; line-height: 1; text-align: center; white-space: nowrap; height: 50px;">
            SHOP NOW
        </a>


        </div>
    </div>
</section>



<!-- NEW ARRIVALS -->
<section class="new-arrivals">
    <div class="container">
        <div class="text-arrivals row align-items-center mb-4">
            <div class="title col-7 col-sm-6 col-md-9 text-left">
                <h3 class="text-main"><span>NEW</span> ARRIVALS</h3>
            </div>
        </div>

        <div class="products row justify-content-center">
            @foreach ($datas as $item)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card shadow border-0" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-body text-center p-4">
                            <div class="product-image mb-3">
                                @if($item->url_gambar)
                                    <img src="{{ Storage::url($item->url_gambar) }}" alt="{{ $item->nama_produk }}" class="img-fluid rounded" style="max-height: 180px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/hijab.png') }}" alt="Default Image" class="img-fluid rounded" style="max-height: 180px; object-fit: cover;">
                                @endif
                            </div>
                            <h5 class="text-second mb-2">{{ $item->nama_produk }}</h5>
                            <p class="text-main font-weight-bold mb-3">Rp {{ number_format($item->harga, 2, ',', '.') }}</p>
                            <a href="/detail/{{ $item->id }}" class="btn btn-info">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- PRODUCTS -->
<section class="products-section">
    <div class="container">
        <div class="text-arrivals row align-items-center mb-4">
            <div class="title col-7 col-sm-6 col-md-9 text-left">
                <h3 class="text-main"><span>ALL</span> PRODUCT</h3>
            </div>
            <div class="text-show-all text-right text-main col-5 col-sm-6 col-md-3 pr-md-0">
                <a href={{ url('allproduk') }}>
                    <p>SHOW ALL <img src="{{ asset('user/assets/icons/arrow-2.png') }}" alt="icon-arrow"></p>
                </a>
            </div>
        </div>

        <div class="products row justify-content-center">
            @foreach ($datas as $item)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card shadow border-0" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-body text-center p-4">
                            <div class="product-image mb-3">
                                @if($item->url_gambar)
                                    <img src="{{ Storage::url($item->url_gambar) }}" alt="{{ $item->nama_produk }}" class="img-fluid rounded" style="max-height: 180px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/hijab.png') }}" alt="Default Image" class="img-fluid rounded" style="max-height: 180px; object-fit: cover;">
                                @endif
                            </div>
                            <h5 class="text-second mb-2">{{ $item->nama_produk }}</h5>
                            <p class="text-main font-weight-bold mb-3">Rp {{ number_format($item->harga, 2, ',', '.') }}</p>
                            <a href="/detail/{{ $item->id }}" class="btn btn-info">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
