@extends('layouts.main')
@section('container')

<main class="form-signin">
    <div class="container mt-4">

        @if (session()->has('registersuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('registersuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (session()->has('logginFail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('logginFail') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <div class="row justify-content-center text-center">
            <div class="col-lg-5">
                <form action="/login" method="POST">
                    @csrf
                    <i class="bi bi-person-square" style="font-size: 7rem;"></i>
                    <h1 class="h3 mb-3 fw-normal">Login Form</h1>
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com">
                        <label for="email" required>Email address</label>
                        <div class="invalid-feedback">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        <label for="password" required>Password</label>
                        <div class="invalid-feedback">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                    <small class="d-block mt-2">Not registered? <a href="/register">Register now!</a></small>
                </form>
            </div>
        </div>
    </div>
</main>
  
    
@endsection