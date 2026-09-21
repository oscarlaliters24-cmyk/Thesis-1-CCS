# OSCA Senior Citizen Information Management System

Laravel/PHP + MySQL starter implementation for the thesis:
**Digital Transformation in LGU Elderly Care: An Integrated Web Analytics Framework**

## Included modules
- Authentication
- **Role-based access control**: Administrator and OSCA Staff
- Senior citizen registration and CRUD
- Benefits monitoring
- **Camera-based QR verification** using the device camera
- QR code generation for each senior citizen record
- Verification logs
- Reports
- **JavaScript analytics charts** using Chart.js
- MySQL migrations and seeders
- Responsive HTML/CSS/JavaScript UI

## Role permissions
| Feature | Administrator | OSCA Staff |
|---|---|---|
| Dashboard / analytics | Yes | Yes |
| View senior records | Yes | Yes |
| Register/edit/delete senior | Yes | No |
| View benefits | Yes | Yes |
| Add benefit | Yes | No |
| QR verification | Yes | Yes |
| Reports | Yes | Yes |

## Requirements
- PHP 8.2+
- Composer
- Laravel 11/12 compatible environment
- MySQL 8+
- Node.js + npm (optional for asset compilation)
- XAMPP or another PHP/MySQL environment

## Installation

```bash
composer create-project laravel/laravel osca-senior-system
cd osca-senior-system
```

Copy these project files into the Laravel project, then configure `.env`:

```env
APP_NAME="OSCA Senior Citizen System"
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=osca
DB_USERNAME=root
DB_PASSWORD=
```

Create the `osca` database, then run:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

Open `http://127.0.0.1:8000`.

## Demo accounts
Password for both accounts: `password`

- `admin@osca.test` — Administrator
- `staff@osca.test` — OSCA Staff

## Camera QR notes
The QR scanner uses the browser camera. Camera access normally requires **HTTPS or localhost**. On an iPhone, allow camera permission when prompted. If the camera cannot start, the manual token field remains available.

Each senior's profile also displays a generated QR code containing that record's verification token.

## GitHub

```bash
git init
git add .
git commit -m "Add OSCA analytics, QR scanner, and role permissions"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/osca-senior-system.git
git push -u origin main
```

Do not commit `.env`, production credentials, or real senior-citizen personal data.

## Privacy / thesis deployment note
This is a thesis/demo starter. Replace seeded/example data with authorized OSCA data only. Before real deployment, apply appropriate access controls, backups, encryption, audit logging, secure hosting, and applicable Philippine Data Privacy Act requirements.
