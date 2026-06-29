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

    public function getFeatureItemsAttribute(): array
    {
        $features = trim((string) $this->features);

        if ($features === '') {
            return [];
        }

        $decodedFeatures = json_decode($features, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decodedFeatures)) {
            return collect($decodedFeatures)
                ->map(fn ($feature) => trim((string) $feature))
                ->filter()
                ->values()
                ->all();
        }

        $separator = str_contains($features, "\n") ? '/\r\n|\r|\n/' : '/,/';

        return collect(preg_split($separator, $features) ?: [])
            ->map(fn ($feature) => trim($feature))
            ->filter()
            ->values()
            ->all();
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
