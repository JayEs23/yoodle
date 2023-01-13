<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'author', 'library_id', 'ISBN'
    ];
    
    /**
     * library
     *
     * @return void
     */
    public function library()
    {
        return $this->belongsTo(Library::class);
    }
}

