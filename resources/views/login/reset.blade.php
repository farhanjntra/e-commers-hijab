@extends('login.layout.main')

@section('content')
    <div class="row d-flex justify-content-center align-items-center mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <main class="form-signin w-100 m-auto">
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <h1 class="h3 mt-3 mb-4 fw-normal">Reset Password</h1>
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-floating mb-4">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="floatingInput" name="email" placeholder="name@example.com" value="{{ old('email', $email) }}">
                                <label for="floatingInput">Email address</label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="floatingPassword" name="password" placeholder="New Password">
                                <label for="floatingPassword">New Password</label>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                       id="floatingPasswordConfirmation" name="password_confirmation" placeholder="Confirm Password">
                                <label for="floatingPasswordConfirmation">Confirm Password</label>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button class="btn btn-primary w-100 py-2" type="submit">Reset Password</button>

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
