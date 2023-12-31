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
        // return Book::all();
        try {
            $books = Book::all();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Books retrieved successfully.',
                'data' => $books,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve books.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
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
    
            $result = $book->save();
    
            if ($result) {
                return response()->json(['result' => 'Data saved!'], 200);
            } else {
                return response()->json(['result' => 'Failed to save!'], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'Failed to save!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $book = Book::findOrFail($id);
            return response()->json(['result' => 'success', 'data' => $book], 200);
        } catch (\Exception $e) {
            return response()->json(['result' => 'error', 'message' => 'Book not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['result' => 'error', 'message' => 'Failed to retrieve book.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
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
                return response()->json(['result' => 'Data Updated!'], 200);
            } else {
                return response()->json(['result' => 'Failed to update data.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['result' => 'error', 'message' => 'Book not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['result' => 'error', 'message' => 'Failed to update book.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
            $result = $book->delete();
    
            if ($result) {
                return response()->json(['result' => 'Delete Success'], 200);
            } else {
                return response()->json(['result' => 'Failed to delete.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['result' => 'error', 'message' => 'Book not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['result' => 'error', 'message' => 'Failed to delete book.', 'error' => $e->getMessage()], 500);
        }
    }
}
