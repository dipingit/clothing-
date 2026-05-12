# Clothing E-Commerce (Laravel)

Full-stack clothing store with a customer storefront and an **SB Admin**–style admin dashboard. Built on **Laravel 5.7** with **Blade** views, **MySQL**, and **jQuery** / **Bootstrap 4** on the front end.

## Features

### Storefront

- Browse catalog by audience: **All**, **Men**, **Women**, **Child**
- Product detail pages with **per-size inventory** (XS–XXL), pricing, offers, and images
- **Session-based cart** (client-side cart synced to session) and **checkout** that records orders and updates stock
- **Live search** (AJAX) scoped to the current category view
- **Favorites** and **star ratings** (aggregated into product average rating)
- **Threaded comments** on products (create, edit, delete for logged-in users)
- **User registration** with strong password rules and optional **profile photo** upload
- **Profile** management (info, picture, password change)
- **Contact form** validated and sent via Laravel mail (configure SMTP and the recipient address in code or env as you prefer)

### Admin dashboard (`/admin`)

- Session-protected area for accounts with `accounttype` **Admin** (set at login)
- **Dashboard metrics**: product counts, inventory totals, user counts, and **sales / profit** summaries from sold-items aggregation
- **CRUD** for products (including dynamic category loading by gender, image upload, multi-size stock)
- **User management** table; add users via registration flow; update/delete users
- **Purchase history** table (all checkouts)
- **DataTables**-style tables (Bootstrap 4 integration in `public/custom_public`)

## Tech stack

| Layer | Technology |
|--------|------------|
| Backend | PHP 7.1+, Laravel 5.7, Eloquent ORM |
| Database | MySQL (see `database/migrations`) |
| Frontend | Blade, Bootstrap 4, jQuery, Laravel Mix (Vue 2 listed in `package.json`; primary UI is Blade + jQuery) |
| Admin UI | Start Bootstrap–based admin theme, DataTables |

## Requirements

- PHP **^7.1.3** with common extensions (`openssl`, `pdo_mysql`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`, `gd` or equivalent for images if needed)
- [Composer](https://getcomposer.org/)
- MySQL 5.7+ (or compatible)
- [Node.js](https://nodejs.org/) and npm (for asset compilation)

## Local setup

1. **Clone** the repository and enter the project directory.

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Environment**

   Copy `.env.example` to `.env` (for example `cp .env.example .env` on macOS/Linux, or `copy .env.example .env` in Windows CMD/PowerShell).

   Edit `.env` and set `APP_KEY`, `APP_URL`, and database credentials (`DB_*`). Generate the app key if empty:

   ```bash
   php artisan key:generate
   ```

4. **Database**

   ```bash
   php artisan migrate
   ```

   Seed data is optional; add admin/customer users via registration or directly in the database (`users.accounttype`: `Admin` or `User`).

5. **Install JS dependencies and build assets** (optional if you only use committed assets under `public/`)

   ```bash
   npm install
   npm run dev
   ```

6. **Mail (contact form)**

   Configure `MAIL_*` in `.env` for your SMTP provider. Update the recipient in `app/Http/Controllers/ContactController.php` (`Mail::to(...)`) or refactor to use `config('mail.from.address')` / an env variable.

7. **Run the app**

   ```bash
   php artisan serve
   ```

   Visit `http://127.0.0.1:8000`. Log in as an **Admin** user to open `/admin`.

## Project layout (high level)

| Path | Purpose |
|------|---------|
| `routes/web.php` | Public and admin HTTP routes |
| `app/Http/Controllers/custom_controllers/` | Feature controllers (user, admin, notifications) |
| `resources/views/custom_views/` | Blade templates (user + admin) |
| `public/custom_public/` | Theme CSS/JS, uploads, vendor assets |
| `database/migrations/` | Schema for users, products, categories, purchases, favorites, ratings, comments, etc. |

## Security note

This project uses **custom session login** (not the default Laravel UI scaffolding). For production, consider Laravel’s built-in authentication, CSRF everywhere, policy/authorization classes, HTTPS-only cookies, rate limiting on login, and moving secrets out of source control.

## License

MIT (same as default Laravel skeleton; confirm `composer.json` / your own terms if you redistribute).
