<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Qrcode;
use Illuminate\Http\Request;
use Inertia\Inertia;
class BookEditController extends Controller
{
    public function index()
    {
        $books= Book::all();
        $qrcodes = Qrcode::all();
        $authors=Author::all();
        $geners=Genre::all();
        return Inertia::render('Book/Editor', compact('books', 'qrcodes', 'authors'));
    }

    public function destroy($id)
    {
        $book= Book::find($id);
        if ($book) {
            $book->delete();
        }
        
        $books= Book::all();
        $qrcodes = Qrcode::all();
        $authors=Author::all();
        return Inertia::render('Book/Editor', compact('books', 'qrcodes', 'authors'));
    }
    
    public function edit($id){
        $book= Book::find($id);
        
      
        $qrcodes = Qrcode::all();
        $authors=Author::all();
        $geners=Genre::all();

        return Inertia::render('Book/Bookupdate', compact('book', 'qrcodes', 'authors'));
    }
    public function update(Request $request){
        $book= Book::find($request->id);
     
    
        $book->fill($request->only(['author_id', 'title', 'age', 'annotation', 'quantity']))->save();
            return Inertia::location('/editor');
    }
}
