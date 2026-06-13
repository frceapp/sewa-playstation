<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $timestamps = false; // We only have created_at in the migration

    protected $fillable = [
        'name',
        'phone_number',
        'content',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
