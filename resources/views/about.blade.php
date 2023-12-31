@extends('layouts')

@section('container')
<div class="mt-5">
    <h1>About Me</h1>
    <h3> {{ $name }}</h3>
    <p> Email : {{ $email }}</p>
    <p> Personal Email : {{ $personal_email }}</p>
    <img src="img/{{ $image }}" alt="{{ $name }}" width="200" class="img-thumbnail rounded-circle">
</div>
@endsection