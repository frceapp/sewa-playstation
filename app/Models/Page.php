<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'show_in_navigation',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'show_in_navigation' => 'boolean',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getPlainContentAttribute(): string
    {
        return self::toPlainText($this->attributes['content'] ?? '');
    }

    public function setContentAttribute($value): void
    {
        $this->attributes['content'] = self::toPlainText($value);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    private static function toPlainText($content): string
    {
        $content = (string) $content;

        if (trim($content) === '') {
            return '';
        }

        $content = preg_replace('/<\s*br\s*\/?\s*>/i', "\n", $content) ?? $content;
        $content = preg_replace('/<\s*li[^>]*>/i', '- ', $content) ?? $content;
        $content = preg_replace('/<\s*\/(p|div|h[1-6]|li|ul|ol|blockquote|section|article)\s*>/i', "\n\n", $content) ?? $content;
        $content = strip_tags($content);
        $content = html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $content = preg_replace("/[ \t]+\n/", "\n", $content) ?? $content;
        $content = preg_replace("/\n{3,}/", "\n\n", $content) ?? $content;

        return trim($content);
    }
}
