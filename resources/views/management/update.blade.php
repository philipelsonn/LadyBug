@extends('layout.layout')

@section('title', 'LadyBug | Update User')

@section('content')
    <h2 class="fw-bold text-center mt-4">Update User</h2>
    <div class="container mt-2">
        <form action="/updateUser/{{ $user->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('UPDATE')
            <div class="col-md-8 form-floating mx-auto mt-3">
                <input type="text" id="id" name="id" class="form-control form-control" placeholder="User ID" value="{{ $user->id }}" disabled>
                <label for="email">User ID</label>
            </div>
            <div class="col-md-8 form-floating mx-auto mt-3">
                <input type="text" id="name" name="name" class="form-control form-control @error('name')
                    is-invalid
                @enderror" placeholder="Name" value="{{ $user->name }}" required>
                <label for="name">Name</label>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-8 form-floating mx-auto mt-3">
                <input type="email" id="email" name="email" class="form-control form-control @error('email')
                    is-invalid
                @enderror" placeholder="Email Address" value="{{ $user->email }}" required>
                <label for="email">Email Address</label>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-8 form-floating mx-auto mt-3">
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
            <div class="col-md-8 form-floating mx-auto mt-3">
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
            <div class="d-flex justify-content-center mt-3">
                @method('PUT')
                <button type="submit" class="btn rounded-20 bg-warning fw-bold">Update</button>
            </div>
        </form>
    </div>
@endsection
