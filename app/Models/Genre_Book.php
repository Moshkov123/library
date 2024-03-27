<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre_Book extends Model
{
    use HasFactory;
    protected $fillable = ['genre_id', 'book_id'];
    public function Book()
    {
        return $this->hasMany(Book::class);
    }
    public function Genre()
    {
        return $this->hasMany(Genre::class);
    }
}
