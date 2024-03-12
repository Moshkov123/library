<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['author', 'genre', 'title', 'age', 'annotation', 'quantity'];
    public function Book()
    {
        return $this->hasMany(Qrcode::class);
    }
    
}