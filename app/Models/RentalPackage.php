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
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function console()
    {
        return $this->belongsTo(Console::class);
    }
}
