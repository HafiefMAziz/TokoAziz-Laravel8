@extends('layouts.main')
@section('container')

<main class="form-registration">
    <div class="container mt-4">
        <div class="row justify-content-center text-center">
            <div class="col-lg-5">
                <form action="/register" method="POST">
                    @csrf
                    <i class="bi bi-person-plus-fill" style="font-size: 7rem;"></i>
                    <h1 class="h3 mb-3 fw-normal">Register Form</h1>
                    <div class="form-floating">
                        <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
                        <label for="name">Name</label>
                        <div class="invalid-feedback">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{ old('username') }}">
                        <label for="username">Username</label>
                        <div class="invalid-feedback">
                            @error('username')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com" value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        <div class="invalid-feedback">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}">
                        <label for="password">Password</label>
                        <div class="invalid-feedback">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
                    <small class="d-block mt-2">Already registered? <a href="/login">Login now!</a></small>
                </form>
            </div>
        </div>
    </div>
</main>
  
    
@endsection