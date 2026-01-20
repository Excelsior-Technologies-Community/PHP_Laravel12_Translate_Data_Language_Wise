<?php

use App\Helpers\TranslationHelper;

if (!function_exists('translate')) {
    function translate($group, $key, $replacements = [], $locale = null)
    {
        return TranslationHelper::translate($group, $key, $replacements, $locale);
    }
}

if (!function_exists('auto_translate')) {
    function auto_translate($group, $key, $text, $sourceLang = 'en')
    {
        return TranslationHelper::autoTranslate($group, $key, $text, $sourceLang);
    }
}