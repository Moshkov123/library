<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Qrcode;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ScannerController extends Controller
{
    public function index()
    {
        $qrcodes=Qrcode::all();
        return Inertia::render('Employee/Acceptance',['qrcodes'=> $qrcodes]);
    }

    public function show($ISBN)
{
    $qrcode = Qrcode::where('ISBN', $ISBN)->first();
    $book = Book::where('id', $qrcode->book_id)->first();
    return Inertia::render('Employee/Lssue', ['book' => $book, 'qrcode' => $qrcode]);
}

}
