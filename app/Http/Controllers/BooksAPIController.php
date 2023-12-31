<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Book::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = new Book;
        $book->isbn = $request->isbn;
        $book->title = $request->title;
        $book->subtitle = $request->subtitle;
        $book->author = $request->author;
        $book->published = $request->published;
        $book->publisher = $request->publisher;
        $book->pages = $request->pages;
        $book->description = $request->description;
        $book->website = $request->website;

        $result=$book->save();

        if ($result) {
            return ['Result' => 'Data saved!'];
        }else{
            return ['Result' => 'Failed to saved!'];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Book::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $book = Book::findOrFail($request->id);
        $book->isbn = $request->isbn;
        $book->title = $request->title;
        $book->subtitle = $request->subtitle;
        $book->author = $request->author;
        $book->published = $request->published;
        $book->publisher = $request->publisher;
        $book->pages = $request->pages;
        $book->description = $request->description;
        $book->website = $request->website;
        $result = $book->save();

        if ($result) {
            return ['result' => 'Data Updated!'];
        } else{
            return ['result' => 'Data Failed Updated!'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $result = $book->delete();
        if ($result) {
            return ['result' => 'Delete Success'];
        } else{
            return ['result' => 'Delete Failed'];
        }
    }
}
