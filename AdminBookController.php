<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.books.index', [
            'books' => Book::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'author_name' => 'required|string|max:255'
        ]);

        $author = Author::firstOrCreate(['name' => $validated['author_name']]);

        $book = new Book([
            'title' => $validated['title'],
            'position' => $validated['position'],
            'author_id' => $author->id
        ]);
        $book->save();

        return redirect('/admin/books')->with('success', 'Book created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $book->load('author');
        return view('admin.books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'author_name' => 'required|string|max:255'
        ]);

        $author = Author::firstOrCreate(['name' => $validated['author_name']]);

        $book->update([
            'title' => $validated['title'],
            'position' => $validated['position'],
            'author_id' => $author->id
        ]);

        return redirect('/admin/books')->with('success', 'Book updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            $authorId = $book->author_id;
            $book->delete();

            $author = Author::find($authorId);
            if ($author && $author->books()->count() == 0) {
                $author->delete();
            }

            return redirect('/admin/books')->with('success', 'Book and author deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
