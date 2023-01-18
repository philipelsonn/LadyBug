@extends('layout.layout')

@section('title', 'LadyBug | Login')

@section('content')
    <div class="card d-flex align-items-stretch w-75 mx-auto my-auto bg-success bg-opacity-10">
        <div class="row g-0">
            <div class="col-md-7">
                <img src="/storage/images/loginImage.png" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-5 my-auto">
                <div class="card-body">
                    <h2 class="card-title text-dark text-center fw-bold">Sign In</h2>
                    <form action="/login" method="POST">
                        @csrf
                        <div class="col-md-10 form-floating mx-auto mt-3">
                            <input type="email" id="email" name="email" class="form-control form-control @error('email')
                                is-invalid
                            @enderror" placeholder="Email Address" value="{{ old('email') }}" required>
                            <label for="email">Email Address</label>
                        </div>
                        <div class="col-md-10 form-floating mx-auto mt-3">
                            <input type="password" id="password" name="password" class="form-control form-control @error('password')
                                is-invalid
                            @enderror" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="form-group mt-3">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold text-light" style="padding-left: 2.5rem; padding-right: 2.5rem">Login</button>
                            </div>
                        </div>
                    </form>
                    <p class="small text-center mt-2">Don't have an account? <a href="{{ route('auth.register') }}" class="fw-bold">Register Now</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
