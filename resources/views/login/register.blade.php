@extends('login.layout.main')

@section('content')
    <div class="row d-flex justify-content-center align-items-center mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <main class="form-signin w-100 m-auto">
                    <form action="/register" method="POST">
                        @csrf
                        <h1 class="h3 mt-3 mb-4 fw-normal">Silakan Daftar</h1>

                        <div class="form-floating mb-4">
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="floatingName" name="name" placeholder="Nama Anda" value="{{ old('name') }}">
                            <label for="floatingName">Nama</label>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="floatingInput" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                            <label for="floatingInput">Alamat Email</label>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" name="password"
                                placeholder="Kata Sandi" required>
                            <label for="floatingPassword">Kata Sandi</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" name="password_confirmation"
                                placeholder="Konfirmasi Kata Sandi" required>
                            <label for="floatingPassword">Konfirmasi Kata Sandi</label>
                        </div>

                        <div class="form-check text-start my-3">
                            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Ingat saya
                            </label>
                        </div>
                        <button class="btn btn-primary w-100 py-2" type="submit">Daftar</button>
                        <p class="my-3 text-body-secondary text-center">Sudah punya akun? <a href="/login">Masuk</a></p>
                    </form>
                    </main>
                </div>
            </div>
            <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
        </div>
    </div>
@endsection
