<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\TranslationService;

class TranslationSeeder extends Seeder
{
    public function run(): void
    {
        $translationService = app(TranslationService::class);
        
        $initialTranslations = [
            ['group' => 'messages', 'key' => 'welcome_title', 'text' => 'Welcome to Translation System'],
            ['group' => 'messages', 'key' => 'current_language', 'text' => 'Current Language'],
            ['group' => 'messages', 'key' => 'greeting', 'text' => 'Greeting'],
            ['group' => 'messages', 'key' => 'hello_message', 'text' => 'Hello! Welcome to our multilingual application.'],
            ['group' => 'messages', 'key' => 'description', 'text' => 'Description'],
            ['group' => 'messages', 'key' => 'system_description', 'text' => 'This system automatically translates content between English, Hindi, and Gujarati.'],
            ['group' => 'messages', 'key' => 'features', 'text' => 'Features'],
            ['group' => 'messages', 'key' => 'features_list', 'text' => 'Automatic translation, Language switching, Dynamic content'],
            ['group' => 'messages', 'key' => 'add_translation', 'text' => 'Add New Translation'],
            ['group' => 'messages', 'key' => 'group', 'text' => 'Group'],
            ['group' => 'messages', 'key' => 'key', 'text' => 'Key'],
            ['group' => 'messages', 'key' => 'text', 'text' => 'Text'],
            ['group' => 'messages', 'key' => 'submit', 'text' => 'Submit'],
        ];

        foreach ($initialTranslations as $trans) {
            $translationService->translateAndSave(
                $trans['group'],
                $trans['key'],
                $trans['text']
            );
        }
    }
}