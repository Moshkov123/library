<?php

namespace App\Http\Controllers;

use App\Models\Author;
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
        $authors=Author::all();
        return Inertia::render('Create',compact('authors'));
    }

    public function store(Request $request)
    {
        dd($request);
        $author=$request->only(['patronymic', 'surname', 'name','author']);
        $bookData = $request->only(['title', 'age', 'annotation', 'quantity']);
        $bookData2 = $request->only(['ISBN', 'publish', 'photo', 'year']);
        if($author['author'] ==''){
            $author['name'] = ucwords(strtolower($author['name']));
$author['surname'] = ucwords(strtolower($author['surname']));
$author['patronymic'] = ucwords(strtolower($author['patronymic']));
$author['author']= $author['surname'] . ' ' . substr($author['name'], 0, 1) . '.';
$auth = Author::query()->create($author);
        }

        $foundBook = Book::where('title',$request-> title)->where('author', $request->author)->first();
    if(!$foundBook){
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $bookData2['photo'] = $photoPath;
        }
        $bookData = array_merge($bookData, ['author' => $auth->id]);
        $book = Book::query()->create($bookData);

        $book2Data = array_merge($bookData2, ['book_id' => $book->id,'user_id' => 1, 'condition' => true, 'booking'=>true]); // Добавление 'book_id' и 'qr' в данные для создания Qrcode
       Qrcode::query()->create($book2Data);
    }else{
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $bookData2['photo'] = $photoPath;
        }
        $book = Book::where($bookData)->first();
        $book2Data = array_merge($bookData2, ['book_id' => $book->id,'user_id' => 1, 'condition' => true, 'booking'=>true]); // Добавление 'book_id' и 'qr' в данные для создания Qrcode
       Qrcode::query()->create($book2Data);
    }
       
    
        return redirect()->route('books.show', $book);
    }
    
    

}
