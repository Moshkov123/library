<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Genre_Book;
use App\Models\Qrcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $qrcodes = Qrcode::all();
        $authors = Author::all();
        $genre = Genre::all();
        $genreBook= Genre_Book::all();
        return Inertia::render('Dashboard', compact('books', 'qrcodes','authors','genreBook','genre'));
    }


    public function show(Book $book, Qrcode $qrcode,Genre_Book $genreBook,Genre  $genre,Author $author)
    {

        return Inertia::render('Show',['book' => $book, 'qrcode'=>$qrcode,'genreBook' => $genreBook, 'genre'=>$genre,'author'=>$author]);
    }
    public function reserve(Book $book)
    {
        $userId = Auth::id();
        
        // Retrieve the qrcode associated with the given book
        $qrcode = Qrcode::where('book_id', $book->id)->first();
    
        if ($qrcode) {
            // Update the retrieved qrcode entry for the booked book
            $qrcode->update([
                'booking' => false, // Set booking to false
                'user_id' => $userId, // Update user_id to the current user's ID
            ]);
    
            // Additional logic if needed
    
           
        } 
        return redirect()->back()->with('success', 'Book reserved successfully.');
    }
    
    public function create()
    {
        $authors = Author::all();
        return Inertia::render('Create', compact('authors'));
    }

    public function store(Request $request)
    {
       
        $genre = $request->only(['genre']);
        $author = $request->only(['patronymic', 'surname', 'name', 'author']);
        $bookData = $request->only(['author_id', 'title', 'age', 'annotation', 'quantity']);
        $bookData2 = $request->only(['ISBN', 'publish', 'photo', 'year']);
        if ($author['author'] == '') {
            $author['name'] = ucwords(strtolower($author['name']));
            $author['surname'] = ucwords(strtolower($author['surname']));
            $author['patronymic'] = ucwords(strtolower($author['patronymic']));
            $author['author'] = $author['surname'] . '.' . mb_substr($author['name'], 0, 1, 'UTF-8') . '.' . mb_substr($author['patronymic'], 0, 1, 'UTF-8');
            $foundAuthor = Author::where('author', $author['author'])->first();
            if($foundAuthor) {
                $auth = $foundAuthor->id;
            } else {
                $foundAuthor = Author::query()->create($author);
                $auth = $foundAuthor->id;  
            }
        }

        $foundBook = Book::where('title', $request->title)->where('author_id', $auth)->first();
        if (!$foundBook) {
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
                $bookData2['photo'] = $photoPath;
            }
            $bookData = array_merge($bookData, ['author_id' => $auth]);
    
            $book = Book::query()->create($bookData);

            $book2Data = array_merge($bookData2, ['book_id' => $book->id, 'user_id' => 1, 'condition' => true, 'booking' => true]); // Добавление 'book_id' и 'qr' в данные для создания Qrcode
            Qrcode::query()->create($book2Data);
            
        } else {
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
                $bookData2['photo'] = $photoPath;
            }
            $book = Book::where('title', $request->title)->first();
           
            $book2Data = array_merge($bookData2, ['book_id' => $book->id, 'user_id' => 1, 'condition' => true, 'booking' => true]); // Добавление 'book_id' и 'qr' в данные для создания Qrcode
            Qrcode::query()->create($book2Data);
        }
        // Поиск жанра
        $Genre = Genre::where('genre', $genre)->first();

        // Если жанр не найден, создать новый
        if (!$Genre) {
            $newGenre = Genre::create($genre);
            $genreId = $newGenre->id;
        } else {
            $genreId = $Genre->id;
        }

        // Добавление связи между книгой и жанром
        $genreBook = ['genre_id' => $genreId, 'book_id' => $book->id];
        Genre_Book::create($genreBook);
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $bookData2['photo'] = $photoPath;
        }
        return redirect()->route('books.show', $book);
    }
}
