<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', ['books' => Book::all()]);
    }

    public function show(Book $book)
    {
        return Inertia::render('Show', ['book' => $book]);
    }

    public function create()
    {
        return Inertia::render('Create');
    }

    public function store(Request $request)
    {
    
        $bookData = $request->only(['title', 'author', 'genre', 'age', 'annotation', 'quantity']);

        $book = Book::query()->create($bookData);

        return redirect()->route('books.show', $book);
    }
}
