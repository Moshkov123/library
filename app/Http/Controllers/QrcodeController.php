<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Qrcode;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QrcodeController extends Controller
{
    public function index2()
    {
        $books=Book::all();
        $qrcodes = Qrcode::all();
        
        return Inertia::render('Qrcode',['qrcodes'=>$qrcodes,'books'=>  $books]);
    }
    public function index()
    {
        $books=Book::all();
        $qrcodes = Qrcode::all();
        return Inertia::render('generate',['qrcodes'=>$qrcodes,'books'=>  $books]);
    }
}
