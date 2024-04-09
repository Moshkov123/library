<?php

namespace App\Http\Controllers;

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
}
