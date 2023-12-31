<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{

    public function cek(){
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer 116|4CnfMDpn1NYdjceSuf3JYjEkzUB7ajyluGbcMLXd'
        ])->get('https://book-crud-service-6dmqxfovfq-et.a.run.app/api/books');
        
        if ($response->successful()) {
            $data = $response->json();
            $apiBooks = $data['data'] ?? [];
    
            $books = [];
    
            foreach ($apiBooks as $apiBook) {
                $book = new Book();
                $book->id = $apiBook['id'];
                $book->user_id = $apiBook['user_id'];
                $book->isbn = $apiBook['isbn'];
                $book->title = $apiBook['title'];
                $book->subtitle = $apiBook['subtitle'];
                $book->author = $apiBook['author'];
                $book->published = $apiBook['published'];
                $book->publisher = $apiBook['publisher'];
                $book->pages = $apiBook['pages'];
                $book->description = $apiBook['description'];
                $book->website = $apiBook['website'];
                $book->created_at = $apiBook['created_at'];
                $book->updated_at = $apiBook['updated_at'];
    
                $book->save();
    
                $books[] = $book;
            }
    
            return view('books.index', ['books' => $books]);
        } else {
            return response()->json(['error' => 'Failed to fetch books from the API'], $response->status());
        }
    }

    public function index(){
        $books = Book::all();
        return response()->json($books); 
    }

    public function create(){
        return view('books.create');        
    }

    public function edit(string $id){
        //
    }
    
    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        $book = Book::create([
            'user_id' => Auth::id(),
            'isbn' => $request->isbn,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'author' => $request->author,
            'published' => $request->published,
            'publisher' => $request->publisher,
            'pages' => $request->pages,
            'description' => $request->description,
            'website' => $request->website,
        ]);

        return response()->json([
            'message' => 'Book created',
            'book' => $book,
        ]);
    }

    public function update(Request $request, $book_id)
    {
        $request->validate($this->validationRules());

        $book = Book::findOrFail($book_id);

        $this->authorize('update', $book);

        $book->update([
            'isbn' => $request->isbn,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'author' => $request->author,
            'published' => $request->published,
            'publisher' => $request->publisher,
            'pages' => $request->pages,
            'description' => $request->description,
            'website' => $request->website,
        ]);

        return response()->json([
            'message' => 'Book updated',
            'book' => $book,
        ]);
    }

    public function show($book_id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    public function destroy($book_id)
    {
        $book = Book::findOrFail($book_id);

        $this->authorize('delete', $book);

        $book->delete();

        return response()->json([
            'message' => 'Book deleted',
            'book' => $book,
        ]);
    }

    protected function validationRules()
    {
        return [
            'isbn' => ['required', 'string', 'max:255', Rule::unique('books')],
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'published' => 'nullable|date',
            'publisher' => 'nullable|string|max:255',
            'pages' => 'nullable|integer',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
        ];
    }
}
