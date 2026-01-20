<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;

Route::get('/', [TranslationController::class, 'translatePage']);
Route::get('/change-language/{lang}', [TranslationController::class, 'changeLanguage'])->name('change.language');
Route::post('/add-translation', [TranslationController::class, 'addTranslation'])->name('add.translation');
Route::get('/translations', [TranslationController::class, 'showTranslations'])->name('translations.index');