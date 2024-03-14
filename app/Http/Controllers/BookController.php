<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Qrcode;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
{
    $books = Book::all();
    $qrcodes = Qrcode::all();
    return Inertia::render('Dashboard', compact('books', 'qrcodes'));
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
        $bookData2 = $request->only(['ISBN', 'publish', 'photo', 'year']);
    
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $bookData2['photo'] = $photoPath;
        }
    
        $book = Book::query()->create($bookData);
        $book2Data = array_merge($bookData2, ['book_id' => $book->id,'user_id' => 1, 'condition' => true, 'booking'=>true]); // Добавление 'book_id' и 'qr' в данные для создания Qrcode
       Qrcode::query()->create($book2Data);
    
        return redirect()->route('books.show', $book);
    }
    
    

}
