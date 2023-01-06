@extends('layout.layout')

@section('title', 'LadyBug | Register')

@section('content')
    <div class="card d-flex align-items-stretch w-75 mx-auto my-auto bg-light bg-opacity-50">
        <div class="row g-0">
            <div class="col-md-7">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-5 my-auto">
                <div class="card-body">
                    <h2 class="card-title text-dark text-center fw-bold">Registration Form</h2>
                    <form action="/register" method="POST">
                        @csrf
                        <div class="col-md-10 form-floating mx-auto mt-2">
                            <input type="text" id="name" name="name" class="form-control form-control @error('name')
                                is-invalid
                            @enderror" placeholder="Full Name" value="{{ old('name') }}" required>
                            <label for="name">Full Name</label>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div class="col-md-10 form-floating mx-auto mt-3">
                            <input type="email" id="email" name="email" class="form-control form-control @error('email')
                                is-invalid
                            @enderror" placeholder="Email Address" value="{{ old('email') }}" required>
                            <label for="email">Email Address</label>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div class="col-md-10 form-floating mx-auto mt-3">
                            <input type="password" id="password" name="password" class="form-control form-control @error('password')
                                is-invalid
                            @enderror" placeholder="Password" required>
                            <label for="password">Password</label>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div class="col-md-10 form-floating mx-auto mt-3">
                            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control form-control @error('confirmPassword')
                                is-invalid
                            @enderror" placeholder="Confirm Password" required>
                            <label for="confirmPassword">Confirm Password</label>
                            @error('confirmPassword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div class="form-group mt-3">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold text-light" style="padding-left: 2.5rem; padding-right: 2.5rem">Register</button>
                            </div>
                        </div>
                    </form>
                    <p class="small text-center mt-2">Already have an account? <a href="{{ route('auth.login') }}" class="fw-bold">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
