@extends('layouts')

@section('container')
<h1 class="text-center mt-5">All Books</h1>

<a href="/book/create" class="btn btn-outline-primary mb-3">Add New Book</a>

<div class="row">
    @foreach($books as $book)
        <div class="col-sm-4 mt-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p><span>{{ $book->isbn }}</span></p>
                    <p class="card-text">{{ $book->author }}</p>
                    <p class="card-text">{{ $book->description }}</p>
                    <p class="card-text">{{ $book->published }}</p>
                    <a href="/books/edit/{{ $book->id }}" class="btn btn-outline-warning me-2">Edit</a>
                    <a href="#" class="btn btn-outline-danger">Delete</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection