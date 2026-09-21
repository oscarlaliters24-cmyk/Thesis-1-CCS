# OSCA Senior Citizen Information Management System — Laravel Starter v2

A GitHub-ready starter for the OSCA Senior Citizen Information Management System.

## Included

- Admin/staff authentication
- Role-based access: Admin vs Staff
- Senior citizen registration, search, update and deactivation
- QR code generation
- Mobile-friendly QR camera scanner
- QR verification page
- Benefits monitoring and claim verification
- Dashboard statistics
- Analytics charts
- CSV reports
- Admin user management
- Audit logs for important record actions
- Responsive Bootstrap interface
- MySQL migrations and seed data

## Requirements

PHP 8.2+, Composer, MySQL, Node/npm optional, and XAMPP if using a local Windows development environment.

## Install

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Create database `osca_system`, configure `.env`, then:

```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Open http://127.0.0.1:8000.

Demo:
- Admin: admin@osca.test / password
- Staff: staff@osca.test / password

Change demo passwords before any real deployment.

## GitHub

```bash
git init
git add .
git commit -m "Build OSCA information management system"
git branch -M main
git remote add origin https://github.com/YOUR-USERNAME/osca-information-management-system.git
git push -u origin main
```

Never commit `.env`, production credentials, database dumps, or `vendor/`.

## QR scanner

The QR Scanner page uses the device camera through `html5-qrcode`. Camera access normally requires a secure context (HTTPS) when deployed; localhost is generally treated specially by browsers.

## Security

This starter is a thesis/development baseline, not a production-certified government system. Before deployment, add HTTPS, backups, stronger password policies, least-privilege database accounts, rate limiting, CSRF/session hardening, privacy controls, retention rules, and a formal security/privacy review appropriate to the actual OSCA deployment.
