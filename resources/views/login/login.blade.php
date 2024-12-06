@extends('login.layout.main')

@section('content')
    <div class="row d-flex justify-content-center align-items-center mt-5">
        <div class="col-md-4">

            <!-- Success Notification -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body text-center">
                    <main class="form-signin w-100 m-auto">
                        <form action="/login" method="POST">
                            @csrf
                            <h1 class="h3 mt-3 mb-4 fw-normal">Silakan masuk</h1>

                            <div class="form-floating mb-4">
                                <input type="email"
                                    class="form-control {{-- @error('email') is-invalid @enderror" --}}
                                    id="floatingInput" name="email" placeholder="name@example.com" {{-- value="{{ old('email') }}" --}}>
                                <label for="floatingInput">Alamat Email</label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="floatingPassword" name="password"
                                    placeholder="Kata Sandi">
                                <label for="floatingPassword">Kata Sandi</label>
                            </div>

                            <!-- Flexbox to align Remember me and Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check text-start">
                                    <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ingat saya
                                    </label>
                                </div>
                                <div>
                                    <a href="/forgot-password" class="text-end">Lupa kata sandi?</a>
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 py-2" type="submit">Masuk</button>

                            <p class="my-3 text-body-secondary">Belum punya akun? <a href="/register">Daftar</a></p>
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
