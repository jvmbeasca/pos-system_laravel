# Laravel Point-of-Sale System

A web-based Point-of-Sale (POS) system for managing products, customers, staff accounts, inventory, and sales.

## Project Information

- **Course:** IT0049 – Web System Technologies
- **Framework:** Laravel
- **Language:** PHP
- **Database:** SQLite
- **Interface:** Blade templates and CSS

## Features

- Staff login and authenticated access to POS pages
- Product management with image uploads and stock quantities
- Customer management
- Staff account management with avatar uploads
- Password hashing through Laravel
- Sale recording with an optional customer
- Automatic stock reduction after a sale
- Insufficient-stock validation
- Sales history showing the product, customer, staff member, quantity, total, and date

## Database Tables

- **users:** Staff account details and avatar path
- **products:** Product name, price, stock quantity, and image path
- **customers:** Customer name, email, and phone number
- **sales:** Product, optional customer, staff member, quantity, and sale total

A product and a staff member can each be linked to many sales. A sale may optionally be linked to a customer.

## Requirements

Install the following before running the project:

- PHP
- Composer
- SQLite support for PHP

## Setup on Windows

Open Command Prompt in the project folder and run:

```bat
composer install
copy .env.example .env
if not exist database\database.sqlite type nul > database\database.sqlite
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
