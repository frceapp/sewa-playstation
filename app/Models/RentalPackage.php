<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'console_id',
        'name',
        'price',
        'features',
    ];

    public function console()
    {
        return $this->belongsTo(Console::class);
    }
}
