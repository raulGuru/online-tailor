# Online Tailor (BookMyTailor)

Online Tailor is a Laravel web application for:
- browsing fabric/material products,
- submitting body measurements,
- choosing a tailor,
- placing and paying for tailoring orders,
- and managing the back-office catalog/tailor/order workflow.

The system supports both customer-facing flows and an admin/vendor dashboard. See the full docs index at **[`docs/INDEX.md`](docs/INDEX.md)**.

## Tech stack

- **Framework:** Laravel 8 (`laravel/framework:^8.75`)
- **PHP:** `^7.3|^8.0`
- **Auth:** Session auth + Laravel Sanctum package installed (minimal API use)
- **Database:** MySQL (default `DB_CONNECTION=mysql`)
- **Queue:** Database queue supported (`jobs` + `failed_jobs` migrations), default env is sync
- **Webhook processing:** `spatie/laravel-webhook-client`
- **Payments:** Instamojo SDK (`instamojo/instamojo-php`)
- **Frontend:** Blade templates + Laravel Mix (Webpack), Axios/Lodash

## Local setup

> These steps are validated against `composer.json`, `package.json`, and repository structure.

1. **Clone and enter repo**
   ```bash
   git clone <repo-url>
   cd online-tailor
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Create environment file**
   ```bash
   cp .env.example .env
   ```

5. **Generate app key**
   ```bash
   php artisan key:generate
   ```

6. **Configure `.env`**
   - Set DB credentials.
   - Set payment/webhook variables (see [docs/03-setup-and-environments.md](docs/03-setup-and-environments.md)).
   - Set `MASTER_PASSWORD` for admin emergency login path.

7. **Run migrations**
   ```bash
   php artisan migrate
   ```

8. **Seed baseline data (recommended for local)**
   ```bash
   php artisan db:seed --class=MasterCategorySeeder
   php artisan db:seed --class=ProductColorSeeder
   php artisan db:seed --class=ProductCategorySeeder
   php artisan db:seed --class=ProductSubCategorySeeder
   php artisan db:seed --class=StitchingsSeeder
   php artisan db:seed --class=UserSeeder
   ```
   > `DatabaseSeeder` does not currently call these seeders.

9. **Create storage symlink**
   ```bash
   php artisan storage:link
   ```

10. **Build frontend assets**
    ```bash
    npm run dev
    ```

11. **Run app**
    ```bash
    php artisan serve
    ```

12. **Optional: run queue worker (required for webhook queue processing when `QUEUE_CONNECTION=database`)**
    ```bash
    php artisan queue:work
    ```

## Common commands

```bash
# Run tests
php artisan test

# Alternative test runner
./vendor/bin/phpunit

# Run queue worker
php artisan queue:work

# Retry failed jobs
php artisan queue:retry all

# Clear compiled/config/cache
php artisan optimize:clear

# Build production assets
npm run prod
```

## Troubleshooting

- **`php artisan` fails with missing `vendor/autoload.php`**
  - Run `composer install` first.
- **Image uploads do not show up**
  - Ensure `php artisan storage:link` was run and files are written under `storage/app/public`.
- **Payment flow fails before redirect**
  - Confirm Instamojo env variables are set correctly (`PAYMENT_ENV`, `PAYMENT_*_CLIENT_ID`, `PAYMENT_*_CLIENT_SECRET`).
- **Webhook signature failures**
  - Validate `WEBHOOK_CLIENT_SECRET` / `WEBHOOK_TEST_CLIENT_SECRET` and that provider posts `mac` header/field.
- **No baseline data after `php artisan db:seed`**
  - Seeders are not chained in `DatabaseSeeder`; run individual seeder commands listed above.

## Documentation map

Start at **[`docs/INDEX.md`](docs/INDEX.md)** for architecture, data model, routes, integrations, and change recipes.
