@extends('layouts')

@section('container')
<div class="d-flex justify-content-center">
    <div class="card col-sm-6 mt-5">
        <div class="card-body">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="/login" method="post">
                @csrf
                <h1 class="h3 mb-3 fw-normal text-center">Login</h1>
    
                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mt-2">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
    
                <div class="form-check text-start my-3">
                    <label class="form-check-label" for="flexCheckDefault">
                        Doesn't Have an Account? <a href="/register">Register Here</a>
                    </label>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>

@endsection