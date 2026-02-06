# 09 - Integrations

## What it does

Lists external services and how they are wired.

## Instamojo payment gateway

### Purpose
Create payment requests and redirect customer to hosted payment page.

### Where in code
- `OrderController::make_payment`
- `OrderController::payment_response`

### Config/env
- `PAYMENT_ENV`
- `PAYMENT_TEST_CLIENT_ID`, `PAYMENT_TEST_CLIENT_SECRET`
- `PAYMENT_LIVE_CLIENT_ID`, `PAYMENT_LIVE_CLIENT_SECRET`

### Failure modes
- Exception during API request returns raw error message.
- Missing callback ids returns plain "Invalid request" output.

## Payment webhook (Spatie)

### Purpose
Server-to-server status updates from payment provider.

### Where in code
- Route: `Route::webhooks('payment_wehook', 'payment_wehook')`
- Config: `config/webhook-client.php`
- Signature validator: `WebHookSignerHandlerForPayment`
- Processing job: `WebhookJobHandlerForPayment`

### Idempotency/retry notes
- Current logic updates rows by `payment_request_id` (good base idempotency key), but no explicit dedupe logics besides update semantics.

## Email

### Purpose
- Signup welcome email.
- Tailor appointment request notification.
- Appointment approved/rejected customer notifications.

### Where in code
- Mailables in `app/Mail/*`
- Sent from `CustomerSignupController`, `LocationController`, `AppointmentController`

## Safely extending

- Add integration credentials to `.env.example`.
- Keep all new external calls wrapped with clear error handling and logs.

## Gotchas

- Several mail sends catch exceptions and suppress details.
- Webhook signing reads `mac` from request/body; confirm provider format during production rollout.
