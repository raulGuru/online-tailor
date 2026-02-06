# 02 - Project Structure

## What it does

Documents where to find key code and conventions in this repository.

## Directory map

- `app/Http/Controllers` - All main business workflows.
- `app/Models` - Eloquent models and relationships.
- `app/Http/Middleware` - Access control and route guards.
- `app/Mail` - Email templates/classes.
- `app/Handler` - Payment webhook signature + async processing job.
- `app/helpers.php` - Domain helper functions (roles, measurement schemas, stitching panna data).
- `database/migrations` - Schema history.
- `database/seeders` - Seed data (not auto-wired from `DatabaseSeeder`).
- `resources/views` - Blade UI (customer + admin/vendor).
- `routes/web.php` - Primary app endpoints.
- `config/webhook-client.php` - Spatie webhook wiring.

## Safely extending

- Keep new UI views under matching existing folder structure.
- Add new route/controller/model in a consistent resource-style grouping.
- Prefer adding relationships in models before writing joins in controllers.

Cross-links:
- [Architecture](01-architecture-overview.md)
- [Data model](06-data-model.md)
