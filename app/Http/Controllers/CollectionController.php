<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Qrcode;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CollectionController extends BaseController
{
    public function index($id)
    {
        $book = Book::where('id', $id)->get();
        $qrcodes = Qrcode::where('book_id', $id)->get();
        return Inertia::render('Book/Editqrcode', compact('book', 'qrcodes'));
    }
    public function destroy(Request $request, $id)
    {
        $qrcode = Qrcode::find($id);
        if ($qrcode) {
            Storage::disk('public')->delete('photos/' . basename($qrcode->photo));
            $qrcode->delete();
        }
        $book = Book::find($id);
        $qrcodes = Qrcode::where('book_id', $id)->get();
        return Inertia::render('Book/Editqrcode', compact('book', 'qrcodes'));
    }
    public function edit($id)
    {
        $qrcode = Qrcode::find($id);
        $book = Book::find($qrcode->book_id);
        return Inertia::render('Book/Updateqrcode', compact('book', 'qrcode')); // Removed the extra space before 'qrcode'
    }
    public function update(Request $request)
    {
       
        $qrcode = Qrcode::find($request->id);
        if($request->hasFile('photo')){
            $this->service->deleteFile($qrcode->id);
        $photoPath = $this->service->downloadFile($request);
        if ($photoPath) {
            $qrcode['photo']  = $photoPath;
        }
        }
        $qrcode->fill($request->only(['publish', 'book_id', 'qr', 'year', 'ISBN', 'condition', 'booking', 'user_id']))->save();
        return Inertia::location('/collection/' . $qrcode->book_id);
    }

}
