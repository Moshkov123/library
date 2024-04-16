<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Qrcode;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QrcodeController extends Controller
{
    public function index()
    {
        $books=Book::all();
        $qrcodes = Qrcode::all();
        $authors = Author::all();
        return Inertia::render('Employee/Qrcode', compact('qrcodes','books','authors'));
    }
}
