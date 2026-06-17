<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function rentalPackages()
    {
        return $this->hasMany(RentalPackage::class);
    }
}
