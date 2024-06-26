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


class BookController extends BaseController
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


    public function show($id)
    {
        $qrcode = Qrcode::where('id', $id)->first();
        $book= Book::where('id', $qrcode->book_id)->first();
        
        $author = Author::where('id', $book->author_id)->first();
        $genre = Genre::all();
        $genreBook= Genre_Book::all();
        return Inertia::render('Show',compact('book', 'qrcode','author','genreBook','genre'));
    }
    public function reserve($id)
    {
        
        $userId = Auth::id();
        $qrcode = Qrcode::where('id', $id)->first();
        if ($qrcode) {
            if ($qrcode->booking === 0 && $userId == $qrcode->user_id) {
                $qrcode->update([
                    'booking' => true,
                    'user_id' => 1,
                ]);
            } else if ($qrcode->booking === 1) {
                $qrcode->update([
                    'booking' => false,
                    'user_id' => $userId,
                ]);
            }
        }
        return redirect()->back();
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
            $qrcode=Qrcode::query()->create($book2Data);
            
        } else {
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
                $bookData2['photo'] = $photoPath;
            }
            $book = Book::where('title', $request->title)->first();
           
            $book2Data = array_merge($bookData2, ['book_id' => $book->id, 'user_id' => 1, 'condition' => true, 'booking' => true]); // Добавление 'book_id' и 'qr' в данные для создания Qrcode
            $qrcode= Qrcode::query()->create($book2Data);
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
        return redirect()->route('books.show' , $qrcode);
    }
}
