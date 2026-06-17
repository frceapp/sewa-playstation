<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'console_id',
        'title',
        'slug',
        'image',
        'genre',
    ];

    public function console()
    {
        return $this->belongsTo(Console::class);
    }
}
