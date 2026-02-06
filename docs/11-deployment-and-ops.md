# 11 - Deployment and Ops

## What it does

Production checklist for runtime services and operational practices.

## Required services

- PHP-FPM + web server
- MySQL
- Queue worker (recommended when using webhook job asynchronously)
- SMTP provider

## Laravel production basics

- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`
- `php artisan migrate --force`

## Queue and cron

- Queue worker command:
  - `php artisan queue:work --tries=3`
- Scheduler:
  - No scheduled tasks currently, but still wire cron for future readiness:
    - `* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1`

## Logging/monitoring

- Uses Laravel logging channels (`LOG_CHANNEL`, `LOG_LEVEL`).
- Add alerts around payment exceptions and webhook failures.

## Safely extending

- Keep secrets in environment, never in code.
- Validate webhook endpoint reachability and signature verification in staging.

Related:
- [Setup](03-setup-and-environments.md)
- [Integrations](09-integrations.md)
