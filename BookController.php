<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('author')->orderBy('id', 'desc');

        $currentAuthor = null;
        if ($request->filled('author')) {
            $currentAuthor = \App\Models\Author::find($request->author);
            $query->where('author_id', $request->author);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhereHas('author', function ($subQuery) use ($request) {
                        $subQuery->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $books = $query->paginate(50)->withQueryString();

        return view('books.index', [
            'books' => $books,
            'currentAuthor' => $currentAuthor
        ]);
    }




    public function show(Book $book)
    {
        return view('books.show', ['book' => $book]);
    }
}
