# 08 - Background Jobs and Events

## What it does

Explains async/background behavior.

## Jobs

### Payment webhook processing
- Class: `App\Handler\WebhookJobHandlerForPayment`
- Base: `Spatie\WebhookClient\Jobs\ProcessWebhookJob`
- Behavior:
  - Reads webhook payload.
  - Updates `payments` by `payment_request_id`.
  - Updates `orders.status` to `placed` on `credit`, otherwise `failed`.

## Events/listeners

- Default Laravel event provider mapping exists (`Registered` -> `SendEmailVerificationNotification`) but app-specific event classes are not defined.

## Scheduler

- `app/Console/Kernel.php` has no active scheduled commands.

## Safely extending

- If queueing jobs in production, set `QUEUE_CONNECTION=database` and run `php artisan queue:work`.
- Keep webhook job idempotent (lookup by `payment_request_id` and upsert/update carefully).

Related:
- [Integrations](09-integrations.md)
- [Deployment](11-deployment-and-ops.md)
