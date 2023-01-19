@extends('layout.layout')

@section('title', 'LadyBug | Edit Profile')

@section('content')
    <div class="container my-auto">
        <div class="card bg-light p-4 mt-3 mb-3">
            <h2 class="fw-bold text-center mt-2">Edit Profile</h2>
            <form action="/editProfile" method="POST" enctype="multipart/form-data">
                @csrf
                @method('UPDATE')
                <div class="col-md-10 form-floating mx-auto mt-3">
                    <input type="text" id="id" name="id" class="form-control form-control" placeholder="User ID" value="{{ auth()->user()->id }}" disabled>
                    <label for="email">User ID</label>
                </div>
                <div class="col-md-10 form-floating mx-auto mt-3">
                    <input type="text" id="name" name="name" class="form-control form-control @error('name')
                        is-invalid
                    @enderror" placeholder="Name" @if (old('name') == null)
                        value="{{ auth()->user()->name }}"
                    @else
                        value="{{ old('name') }}"
                    @endif required>
                    <label for="name">Name</label>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-10 form-floating mx-auto mt-3">
                    <input type="email" id="email" name="email" class="form-control form-control @error('email')
                        is-invalid
                    @enderror" placeholder="Email Address" value="@if (old('email') == null)
                        {{ auth()->user()->email }}
                    @else
                        {{ old('email') }}
                    @endif" required>
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
                <div class="col-md-10 mx-auto mt-3">
                    <input type="file" id="image_new" name="image_new" class="form-control @error('image_new')
                        is-invalid
                    @enderror">
                    @error('image_new')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center mt-3">
                    @method('PUT')
                    <button type="submit" class="btn rounded-20 bg-warning fw-bold">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
