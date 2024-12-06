@extends('user.layout.index')

@section('content')
    <section class="about-us">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6">
                    <h1>Tentang Hijabeef</h1>
                    <p class="lead">
                        Hijabeef hadir untuk memberikan pilihan busana yang stylish dan modern bagi wanita berhijab, dengan desain yang elegan dan nyaman. Kami berkomitmen untuk mendukung penampilan Anda, yang anggun dan percaya diri, dalam setiap kesempatan.
                    </p>
                    <p>
                        Sejak berdiri, Hijabeef selalu berusaha untuk menawarkan kualitas terbaik dan selalu mengikuti tren fashion terkini. Kami percaya bahwa setiap wanita berhak untuk tampil cantik dan percaya diri dengan pilihan busana yang tepat.
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/logo2.PNG') }}" alt="Logo">
                </div>
            </div>
        </div>
    </section>

    <section class="contact-info">
        <div class="container py-5">
            <h2>Kontak Kami</h2>
            <p>Untuk pertanyaan lebih lanjut atau informasi mengenai produk, Anda dapat menghubungi kami melalui:</p>

            <div class="row">
                <div class="col-md-4">
                    <h5>Alamat:</h5>
                    <p>Jl. Contoh No. 123, Jakarta, Indonesia</p>
                </div>
                <div class="col-md-4">
                    <h5>Email:</h5>
                    <p><a href="mailto:info@hijabeef.com">info@hijabeef.com</a></p>
                </div>
                <div class="col-md-4">
                    <h5>Telepon:</h5>
                    <p>+62 812-3456-7890</p>
                </div>
            </div>
        </div>
    </section>
@endsection
