<?php

namespace App\Services;

use App\Models\Translation;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationService
{
    private $translator;
    private $supportedLanguages = ['en', 'hi', 'gu'];

    public function __construct()
    {
        $this->translator = new GoogleTranslate();
    }

    public function translateText($text, $source = 'en', $target = 'hi')
    {
        try {
            if ($source === $target) {
                return $text;
            }

            $this->translator->setSource($source);
            $this->translator->setTarget($target);
            
            return $this->translator->translate($text);
        } catch (\Exception $e) {
            \Log::error('Translation failed: ' . $e->getMessage());
            return $text; // Return original text if translation fails
        }
    }

    public function translateAndSave($group, $key, $text, $sourceLang = 'en')
    {
        // Check if translation exists
        $translation = Translation::firstOrCreate(
            ['group' => $group, 'key' => $key],
            ['text' => $text]
        );

        $translations = [];

        foreach ($this->supportedLanguages as $targetLang) {
            if ($targetLang === $sourceLang) {
                $translations[$targetLang] = $text;
                continue;
            }

            $translatedText = $this->translateText($text, $sourceLang, $targetLang);
            $translations[$targetLang] = $translatedText;
        }

        $translation->translations = $translations;
        $translation->save();

        return $translation;
    }

    public function getTranslation($group, $key, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        
        $translation = Translation::where('group', $group)
            ->where('key', $key)
            ->first();

        if (!$translation) {
            return null;
        }

        return $translation->getTranslation($locale) ?? $translation->text;
    }

    public function getAllTranslations($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $translations = Translation::all();
        
        $result = [];
        foreach ($translations as $translation) {
            $result[$translation->group][$translation->key] = 
                $translation->getTranslation($locale) ?? $translation->text;
        }
        
        return $result;
    }
}