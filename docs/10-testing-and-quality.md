# 10 - Testing and Quality

## What it does

Summarizes current testing and quality baseline.

## Current state

- Test files are default Laravel examples only:
  - `tests/Feature/ExampleTest.php`
  - `tests/Unit/ExampleTest.php`
- No domain-specific feature/unit coverage detected.

## How to run tests

```bash
php artisan test
# or
./vendor/bin/phpunit
```

## Factories/seeders

- `database/factories/UserFactory.php` exists.
- Domain setup relies heavily on manual seeders in `database/seeders/*`.

## Safely extending

- Add feature tests for critical flows first:
  - customer signup/login
  - measurement session flow
  - payment callback/webhook updates
- Prefer request tests around controller endpoints before refactoring logic.

## Gotchas

- Some controller methods use `echo/exit/die`; these patterns make automated testing harder.
- Vendor dependencies were not installed in this analysis environment, so runtime tests were not executed here.
