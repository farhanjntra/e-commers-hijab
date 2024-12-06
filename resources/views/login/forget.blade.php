@extends('login.layout.main')

@section('content')
    <div class="row d-flex justify-content-center align-items-center mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <main class="form-signin w-100 m-auto">
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <h1 class="h3 mt-3 mb-4 fw-normal">Forgot Password</h1>
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="floatingInput" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                                <label for="floatingInput">Email address</label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button class="btn btn-primary w-100 py-2" type="submit">Send Reset Link</button>

                            <p class="my-3 text-body-secondary">Remember your password? <a href="/login">Sign in</a></p>

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
