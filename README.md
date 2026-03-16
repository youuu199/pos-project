# POS Project

A Laravel-based point-of-sale (POS) web application with authentication and role-based areas.

## What’s Inside

- Laravel 12 backend with Blade views
- Auth flows (login, register, password reset, email verification)
- Admin area route group
- Vite + Tailwind CSS frontend tooling

## Quick Start

1. Install PHP (8.2+), Composer, Node.js, and a MySQL server.
2. Follow the step-by-step guide in `INSTALLATION.md`.

## Common Commands

```bash
# One-shot setup (installs deps, sets env, generates key, migrates, builds assets)
composer run setup

# Local dev servers (Laravel + Vite + queue listener)
composer run dev
```

## Project Structure

- `app/` Laravel application code
- `routes/` HTTP route definitions
- `resources/views/` Blade templates
- `database/` migrations and seeders
- `public/` public assets

## Contributing

Please open an issue or pull request with a clear description of the change.

## License

This project follows the license defined in `composer.json`.
