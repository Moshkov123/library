<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Qrcode;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $books=Book::all();
        $qrcodes = Qrcode::where('user_id', $userId)->get();
        return Inertia::render('Profile/Book',compact('qrcodes', 'books'));
    }

    public function cancellation($id)
    {
        $qrcode = Qrcode::where('id', $id)->first();
        $qrcode->update([
            'booking' => true,
            'user_id' => 1,
        ]);
        
        return redirect()->back();
    }
}
