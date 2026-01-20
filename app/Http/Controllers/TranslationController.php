<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TranslationService;
use App\Models\Translation;

class TranslationController extends Controller
{
    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function changeLanguage($lang)
    {
        if (in_array($lang, ['en', 'hi', 'gu'])) {
            session(['locale' => $lang]);
            app()->setLocale($lang);
        }
        
        return redirect()->back();
    }

    public function addTranslation(Request $request)
    {
        $request->validate([
            'group' => 'required|string',
            'key' => 'required|string',
            'text' => 'required|string',
            'source_lang' => 'in:en,hi,gu'
        ]);

        $translation = auto_translate(
            $request->group,
            $request->key,
            $request->text,
            $request->source_lang ?? 'en'
        );

        return response()->json([
            'message' => 'Translation added successfully',
            'data' => $translation
        ]);
    }

    public function translatePage()
    {
        $translations = $this->translationService->getAllTranslations();
        
        return view('welcome', [
            'translations' => $translations,
            'currentLocale' => app()->getLocale()
        ]);
    }

    public function showTranslations()
    {
        $translations = Translation::all();
        return view('translations.index', compact('translations'));
    }
}