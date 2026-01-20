<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;
use App\Services\TranslationService;

class TranslationHelper
{
    public static function translate($group, $key, $replacements = [], $locale = null)
    {
        $translationService = app(TranslationService::class);
        $text = $translationService->getTranslation($group, $key, $locale);
        
        if (!$text) {
            return $key;
        }
        
        // Replace placeholders
        foreach ($replacements as $placeholder => $value) {
            $text = str_replace(':' . $placeholder, $value, $text);
        }
        
        return $text;
    }
    
    public static function autoTranslate($group, $key, $text, $sourceLang = 'en')
    {
        $translationService = app(TranslationService::class);
        return $translationService->translateAndSave($group, $key, $text, $sourceLang);
    }
}