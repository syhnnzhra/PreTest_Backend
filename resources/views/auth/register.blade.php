@extends('layouts')

@section('container')
<div class="d-flex justify-content-center">
    <div class="card col-sm-6 mt-5">
        <div class="card-body">
            <form action="/register" method="POST">
                @csrf
                <h1 class="h3 mb-3 fw-normal text-center">Register</h1>
    
                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Email address</label>
                    @error('email')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mt-2">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="floatingInput" placeholder="enter your name" required>
                    <label for="floatingInput">Name</label>
                    @error('name')
                        <div class="invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mt-2">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
    
                <div class="form-check text-start my-3">
                    <label class="form-check-label" for="flexCheckDefault">
                        Doesn't Have an Account? <a href="/register">Register Here</a>
                    </label>
                </div>
                <button class="btn btn-primary w-100 py-2" required type="submit">Register</button>
            </form>
        </div>
    </div>
</div>

@endsection