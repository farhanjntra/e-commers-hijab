@extends('user.layout.index')

@section('content')
<section class="products-section" style="background-color: #E7F3F5; padding: 40px 0;">
    <div class="container">
        {{-- <h2 class="text-center mb-5 text-main">Lihat Semua</h2> --}}
        <div class="text-products row align-items-center mb-4">
            <div class="title-product col-12 col-sm-6 col-md-9">
                <h2 class="text-main font-weight-bold">NEW ARRIVAL</h2>
            </div>
        </div>
        <div class="products row justify-content-center">
            @foreach ($data as $item)
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
                            <a href="/detail/{{ $item->id }}" class="btn btn-info   ">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
