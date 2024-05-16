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
public function сonditionUpdate(Request $request, $ISBN)
{
    $qrcode = Qrcode::where('ISBN', $ISBN)->first();
    $book = Book::where('id', $qrcode->book_id)->first();

    // Обновление состояния книги
    $qrcode->booking = !$qrcode->booking;
    $qrcode->condition = !$qrcode->condition;
    $qrcode->user_id = $request->input('id'); // Сохранение ID пользователя
    $qrcode->save();

    return Inertia::render('Employee/Lssue', ['book' => $book, 'qrcode' => $qrcode]);
}
public function bookingUpdate(Request $request, $ISBN)
{
    $qrcode = Qrcode::where('ISBN', $ISBN)->first();
    $book = Book::where('id', $qrcode->book_id)->first();

    // Обновление состояния книги
    $qrcode->booking = !$qrcode->booking;
    $qrcode->user_id = $request->input('id'); // Сохранение ID пользователя
    $qrcode->save();

    return Inertia::render('Employee/Lssue', ['book' => $book, 'qrcode' => $qrcode]);
}
}
