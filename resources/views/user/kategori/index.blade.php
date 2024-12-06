@extends('user.layout.index')

@section('content')
<section class="products-section bg-light py-5">
    <div class="container">
        <div class="text-products row align-items-center mb-4">
            <div class="title-product col-7 col-sm-6 col-md-9 text-left">
                <h2 class="text-main">Category {{ $kategori }}</h2>
            </div>
            <div class="text-show-all text-right text-main col-5 col-sm-6 col-md-3 pr-md-0">

            </div>
        </div>

        <div class="row justify-content-center">
            @foreach ($data as $item)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card border-0 shadow-sm rounded" style="overflow: hidden;">
                        <div class="card-body text-center p-4">
                            <div class="product-image mb-3">
                                @if($item->url_gambar)
                                    <img src="{{ Storage::url($item->url_gambar) }}" alt="{{ $item->nama_produk }}" class="img-fluid rounded" style="max-height: 180px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/hijab.png') }}" alt="Default Image" class="img-fluid rounded" style="max-height: 180px; object-fit: cover;">
                                @endif
                            </div>
                            <h5 class="text-dark mb-2" style="font-weight: 600;">{{ $item->nama_produk }}</h5>
                            <p class="text-main font-weight-bold mb-3">Rp {{ number_format($item->harga, 2, ',', '.') }}</p>
                            <a href="/detail/{{ $item->id }}" class="btn btn-info text-white">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
