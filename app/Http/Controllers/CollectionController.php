<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Qrcode;
use Illuminate\Support\Facades\Storage; 
use Inertia\Inertia;

class CollectionController extends Controller
{
    public function index($id)
    {
        $book=Book::where('id', $id)->get();
        $qrcodes = Qrcode::where('book_id', $id)->get();

         return Inertia::render('Book/Editqrcode', compact('book', 'qrcodes'));
    }

    public function destroy(Request $request, $id)
{
    $qrcode = Qrcode::find($id);
    if ($qrcode) {
        \Storage::disk('public')->delete('photos/' . basename($qrcode->photo));
        $qrcode->delete();
    }
    $book = Book::find($id);
    $qrcodes = Qrcode::where('book_id', $id)->get();
    return Inertia::render('Book/Editqrcode', compact('book', 'qrcodes'));
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
