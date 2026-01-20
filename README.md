# PHP_Laravel12_Translate_Data_Language_Wise

A complete Laravel 12 application with **automatic translation support** for **English, Hindi, and Gujarati** using Google Translate API. The system stores translations in the database for fast retrieval and allows dynamic language switching.

---

## Features

* Automatic translation between English, Hindi, and Gujarati
* Supports three languages: English (en), Hindi (hi), Gujarati (gu)
* Database-based translation storage
* Dynamic language switching
* Simple helper functions for translations
* Browser language auto-detection
* Add translations via UI or programmatically
* Graceful fallback if translation service fails

---

## Prerequisites

* PHP 8.1 or higher
* Composer
* Laravel 12.x
* MySQL / PostgreSQL / SQLite
* Internet connection (for Google Translate)

---

## Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/laravel-translation-system.git
cd laravel-translation-system
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Update database configuration in `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_translation
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
```

### Step 4: Run Migrations

```bash
php artisan migrate
```

### Step 5: Install Session Table

```bash
php artisan session:table
php artisan migrate
```

### Step 6: Seed Initial Translations

```bash
php artisan db:seed --class=TranslationSeeder
```

### Step 7: Serve the Application

```bash
php artisan serve
```


Visit: `http://localhost:8000`

---
---
## Screenshot
<img width="1655" height="808" alt="image" src="https://github.com/user-attachments/assets/faacdcd8-c0b2-4114-8cc6-124a68ed22eb" />
<img width="1121" height="459" alt="image" src="https://github.com/user-attachments/assets/b45de2b0-778f-403d-8a5d-4327a14fccae" />
<img width="1682" height="976" alt="image" src="https://github.com/user-attachments/assets/94d1f786-b15b-452a-b282-04b9a5ab7371" />


## Project Structure

```
app/
├── Http/
│   ├── Controllers/TranslationController.php
│   ├── Middleware/LanguageMiddleware.php
├── Models/Translation.php
├── Services/TranslationService.php
├── Helpers/TranslationHelper.php

database/
├── migrations/create_translations_table.php
└── seeders/TranslationSeeder.php

resources/views/
├── layouts/app.blade.php
├── welcome.blade.php
└── translations/index.blade.php
```

---

## Database Schema

### Translations Table

```sql
CREATE TABLE translations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `group` VARCHAR(255) NOT NULL,
    `key` VARCHAR(255) NOT NULL,
    text TEXT NOT NULL,
    translations JSON NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    UNIQUE KEY translations_group_key_unique (`group`, `key`)
);
```

---

## Usage

### Adding Translations

#### Via Web Interface

1. Open homepage
2. Enter:

   * Group (e.g. messages, labels)
   * Key (e.g. welcome_message)
   * Text (English)
3. Submit form

The system automatically translates to Hindi and Gujarati.

#### Programmatically

```php
use App\Services\TranslationService;

$service = new TranslationService();
$service->translateAndSave('messages', 'new_key', 'English text');

// Helper
auto_translate('messages', 'another_key', 'More English text');
```

---

## Retrieving Translations

### Blade Templates

```blade
{{ translate('messages', 'welcome_title') }}
{{ translate('messages', 'greeting', [], 'hi') }}
{{ translate('messages', 'welcome_message', ['name' => 'John'], 'gu') }}
```

### Controllers

```php
$text = app(TranslationService::class)
    ->getTranslation('messages', 'key_name');

$hindi = app(TranslationService::class)
    ->getTranslation('messages', 'key_name', 'hi');
```

---

## Changing Language

### Via UI

Select language from the navbar dropdown.

### Programmatically

```php
session(['locale' => 'hi']);
app()->setLocale('hi');
```

### Via URL

```
/change-language/hi
/?lang=gu
```

---

## API Endpoints

| Method | URL                     | Description       |
| ------ | ----------------------- | ----------------- |
| GET    | /                       | Homepage          |
| GET    | /change-language/{lang} | Change language   |
| POST   | /add-translation        | Add translation   |
| GET    | /translations           | List translations |

---

## JSON Response Example

```json
{
  "message": "Translation added successfully",
  "data": {
    "group": "messages",
    "key": "welcome",
    "translations": {
      "en": "Welcome",
      "hi": "स्वागत हे",
      "gu": "સ્વાગત છે"
    }
  }
}
```

---

## Configuration

### Adding New Languages

Update `TranslationService.php`:

```php
private $supportedLanguages = ['en', 'hi', 'gu', 'new_lang'];
```

Add language option in middleware and UI dropdown.

---

## Error Handling

* Returns original text if translation fails
* Logs errors to Laravel log
* Handles network issues gracefully

---

## Performance Tips

* Cache translations (Redis/File)
* Use queues for bulk translations
* Add DB indexes
* Use CDN for static assets

---

## Troubleshooting

```bash
php artisan config:clear
php artisan cache:clear
php artisan session:clear
```

Check logs:

```bash
tail -f storage/logs/laravel.log
```

---

## Testing

```bash
php artisan test
php artisan test --filter TranslationTest
```

---

## Production Notes

* Google Translate free tier has limits
* Use Google Cloud Translation API for production
* Implement rate limiting
* Backup translation data regularly

---

## Contributing

1. Fork repository
2. Create feature branch
3. Commit changes
4. Push branch
5. Open Pull Request

---

## License

This project is licensed under the MIT License.

