# Installation Guide

This guide sets up the POS Project locally.

## Requirements

- PHP 8.2+
- Composer
- Node.js 18+ and npm
- MySQL 8+ (or compatible)

## Setup Steps

1. Install PHP, Composer, Node.js, and MySQL.
2. From the project root, install dependencies.

```bash
composer install
npm install
```

3. Create your environment file and app key.

```bash
copy .env.example .env
php artisan key:generate
```

4. Configure the database in `.env`.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pos_project
DB_USERNAME=root
DB_PASSWORD=
```

5. Create the database in MySQL.

```sql
CREATE DATABASE pos_project;
```

6. Run migrations (and optional seed data).

```bash
php artisan migrate
# Optional: create a demo user
php artisan db:seed
```

7. Build assets.

```bash
npm run build
```

8. Start the app.

```bash
php artisan serve
```

Open the app at `http://localhost:8000` and log in or register a user.

## One-Command Setup

If you prefer a single command, the project includes a composer script:

```bash
composer run setup
```

This runs dependency installs, sets up `.env`, generates an app key, runs migrations, and builds assets.

## Development Mode

Run Laravel, Vite, and the queue listener together:

```bash
composer run dev
```

## Troubleshooting

- If you see database connection errors, re-check `.env` values and confirm the database exists.
- If assets are missing, re-run `npm install` and `npm run build`.
