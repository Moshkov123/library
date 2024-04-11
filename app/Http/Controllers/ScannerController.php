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
public function issued(Request $request, $id)
{
    $qrcode = Qrcode::where('id', $id)->first();

    if ($qrcode->condition == 0 ) {
        // If condition is 0 or false, set condition to true, booking to true, and user_id to 1
        $qrcode->update([
            'condition' => true,
            'booking' => true,
            'user_id' => 1,
        ]);
    } else {
        // If condition is not 0 or false, set condition to false and user_id to the input value
        $userId = $request->input('userId');
        $qrcode->update([
            'condition' => false,
            'booking' => false,
            'user_id' => $userId,
        ]);
    }

    return redirect()->back();
}

}
