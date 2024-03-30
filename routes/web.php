<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrcodeController;
use App\Http\Middleware\Admin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ScannerController;
use App\Http\Middleware\Employee;
use Illuminate\Http\Request;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified', 'employee'])->group(function () {
    Route::resource('scanner', ScannerController::class)
        ->only(['index']);

    Route::resource('qrcode', QrcodeController::class)
        ->only(['index']);

    Route::redirect('/dashboard', '/books', 301)->name('dashboard');
    Route::resource('books', BookController::class)
        ->only(['create', 'store']);
});
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::resource('role', AdminController::class)->only(['index', 'destroy']);

    Route::get('/role/edit/{id}', [AdminController::class, 'edit']);
    Route::put('/role/update/{id}', [AdminController::class, 'update']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('/dashboard', '/books', 301)->name('dashboard');
    Route::resource('books', BookController::class)->only(['index', 'show']);
    Route::post('books/{book}/reserve', [BookController::class, 'reserve'])->name('books.reserve');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
