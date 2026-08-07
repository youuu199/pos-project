# Sate Kuu - POS System

A Point of Sale (POS) web application built with Laravel for managing products, orders, payments, and customer interactions.

## Tech Stack

- **Backend:** Laravel 11, PHP 8.2+
- **Frontend:** SB Admin 2 (Bootstrap 4), Chart.js, SweetAlert2
- **Authentication:** Laravel Breeze, Laravel Sanctum, Google/GitHub OAuth (Socialite)
- **Database:** MySQL

## Features

### Admin Dashboard
- **Dashboard** — Stats cards (products, orders, users, revenue), recent orders, low stock alerts, monthly orders chart
- **Category Management** — Create, edit, delete categories with search and pagination
- **Product Management** — Add, edit, delete, view products with image upload, search, low stock filter
- **Order Board** — View all orders, filter by status, update order status (preparing/completed/cancelled)
- **User Management** — List users, filter by role, change user roles, delete users
- **Sale Information** — View payment history, search by user, filter by status
- **Contact Management** — View and manage customer inquiries
- **Admin Profile** — Edit profile info, change password

### Authentication
- Custom login and registration pages
- Google and GitHub OAuth login
- Role-based access control (superadmin, admin, user)

## Installation

1. Clone the repository
   ```bash
   git clone https://github.com/youuu199/pos-project.git
   cd pos-project
   ```

2. Install dependencies
   ```bash
   composer install
   npm install
   ```

3. Set up environment
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure database in `.env` file

5. Run migrations and seed
   ```bash
   php artisan migrate:fresh --seed
   ```

6. Build assets
   ```bash
   npm run build
   ```

7. Start the server
   ```bash
   php artisan serve
   ```

## Default Account

| Role | Email | Password |
|---|---|---|
| Super Admin | superadmin@gmail.com | admin123 |

## Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Profile, User controllers
│   │   ├── AdminDashboardController.php
│   │   ├── CategoryController.php
│   │   ├── ContactController.php
│   │   ├── OrderController.php
│   │   ├── ProductController.php
│   │   └── SaleController.php
│   └── Models/             # 13 Eloquent models
├── database/migrations/    # 16 migration files
├── resources/views/
│   └── admin/
│       ├── dashboard/      # Admin view files
│       └── layouts/        # Master layout
├── routes/
│   ├── admin.php           # Admin routes
│   ├── user.php            # User routes
│   └── web.php             # Main routes
└── public/admin_template/  # SB Admin 2 template
```

## License

MIT License
