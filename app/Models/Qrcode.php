<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    use HasFactory;
    protected $fillable = ['publish', 'book_id', 'qr', 'year', 'photo', 'ISBN', 'condition', 'booking', 'user_id'];
    public function Book()
    {
        return $this->belongsTo(Book::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
