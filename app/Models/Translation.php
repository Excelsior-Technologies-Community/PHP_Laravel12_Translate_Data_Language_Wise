<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
        'key',
        'text',
        'translations'
    ];

    protected $casts = [
        'translations' => 'array'
    ];

    public function getTranslation($locale)
    {
        $translations = $this->translations ?? [];
        return $translations[$locale] ?? null;
    }

    public function setTranslation($locale, $text)
    {
        $translations = $this->translations ?? [];
        $translations[$locale] = $text;
        $this->translations = $translations;
        $this->save();
    }
}