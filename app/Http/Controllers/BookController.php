<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Genre_Book;
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
            if(!$foundAuthor){
                Author::query()->create($author);
            }
            $auth=$foundAuthor->id;
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
            
            $book = Book::where($bookData)->first();
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
