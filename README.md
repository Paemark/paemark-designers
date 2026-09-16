
# Laravel 13 Boilerplate with Filament v5 & Spatie Permissions

A robust starter template combining **Laravel 13**, **Filament v5** for an elegant administration panel, and **Spatie Laravel Permission** for powerful role and permission management.

---

## 🚀 Key Features

*   **Laravel 13** framework core structure.
*   **Filament v5 Panel** with an automated administrator backend dashboard.
*   **Spatie Roles & Permissions** setup natively mapped to User models.
*   **Filament Spatie Plugin** integration to manage roles/permissions directly from the visual UI.
*   **Strict Security Policies** mapping Spatie permissions directly to model interaction layers.
*   **Pest Testing Suite** covering automated structural authentication and permission checks.

---

## 💻 Prerequisites

Ensure your system meets the following global requirements before getting started:
*   **PHP >= 8.3**
*   **Composer** (Latest Version)
*   **MySQL 8.0+** or equivalent relational database engine

---

## 🛠️ Quick Start & Installation

Follow these steps sequentially to configure your local development environment:

### 1. Clone & Install Dependencies
```bash
git clone <your-repository-url>
cd laravel-filament-spatie
composer install
```

### 2. Environment Configuration
Copy the default environment file and generate a unique secure application encryption key:
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup
Open your `.env` file and configure your primary database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Run Core Migrations & Seeders
Execute database migrations and populate the lookup tables with the default configuration data (this creates default roles and a super-admin profile):
```bash
php artisan migrate --seed
```

---

## 🔒 Authorization & Policies

This application implements fine-grained authorization using native Laravel Policies found in `app/Policies/`. Filament resources evaluate these classes dynamically.

*   **Role Management:** Governed by `RolePolicy.php` (requires `manage roles` permission).
*   **Permission Management:** Governed by `PermissionPolicy.php` (requires `manage permissions` permission).

To secure a new Filament Resource, generate its corresponding model policy and use the `$user->hasPermissionTo('...')` or `$user->hasRole('...')` wrappers.

---

## 🧪 Testing Coverage

The application uses **Pest** to validate routing security boundaries and RBAC integration logic.

To run the complete test matrix locally:
```bash
php artisan test
```

### What is covered:
*   Admin dashboard accessibility criteria.
*   Guest routing and malicious access blockades (`403 Forbidden` checks).
*   Resource policy assertions enforcing permission guards.

---

## 👤 Default Administrative Credentials

Once seeded, you can log in directly to the visual Filament UI dashboard using the default credentials:

*   **Panel URL:** `http://127.0.0`
*   **Default Username:** `admin@example.com`
*   **Default Password:** `password`
