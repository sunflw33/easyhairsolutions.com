# Easyhairsolutions

Easyhairsolutions is a clean Laravel 13 + Blade + Tailwind CSS 4 + Vite starter for hair appointments and beauty ecommerce.

## Requirements
- PHP 8.3+
- Composer 2.x
- Node.js 20+
- npm

## First run

From this directory:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Open http://127.0.0.1:8000.

SQLite is the default database and `database/database.sqlite` is included, so no MySQL setup is required for the first run.

## Demo accounts

- Owner: `owner@Easyhairsolutions.test` / `password`
- Professional: `mayabrooks@Easyhairsolutions.test` / `password`
- Customer: `customer@Easyhairsolutions.test` / `password`

## Roles

Spatie Laravel Permission provides `customer`, `professional`, and `owner` roles plus booking, ecommerce, and management permissions.
