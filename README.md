# POS Project (Laravel 11)

Simple POS-style Laravel application with role-based areas for Admin and User.

## Tech Stack

- PHP 8.2+
- Laravel 11
- Laravel Breeze (auth)
- MySQL/SQLite (configurable)
- Vite + Tailwind CSS + Alpine.js

## Main Modules

- Authentication and profile management
- Admin dashboard (`/admin/home`)
- User dashboard (`/user/home`)
- Product, Category, Cart, Order
- Payment and Payment History
- Contact, Comment, Rating, Action Log

## Project Structure

- Routes: `routes/web.php`, `routes/admin.php`, `routes/user.php`
- Controllers: `app/Http/Controllers`
- Models: `app/Models`
- Views: `resources/views`

## First-Time Setup

```powershell
composer install
npm install
if (!(Test-Path .env)) { Copy-Item .env.example .env }
php artisan key:generate
php artisan migrate
npm run build
```

## Daily Run (Development)

```powershell
composer run dev
```

This runs Laravel server, queue listener, logs, and Vite together.

If you only need frontend watcher:

```powershell
npm run dev
```

## Pull and Update

After `git pull`, run:

```powershell
composer install
npm install
php artisan migrate
npm run build
```

## Important Git Notes

This repository intentionally does not track these generated/sensitive files:

- `.env`
- `vendor/`
- `node_modules/`
- `public/build/`
- runtime cache/log files in `storage/` and `bootstrap/cache/`

Create `.env` locally from `.env.example`.

## Useful Commands

```powershell
php artisan test
php artisan optimize:clear
php artisan route:list
```

## License

MIT
