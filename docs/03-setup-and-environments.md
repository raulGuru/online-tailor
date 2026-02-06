# 03 - Setup and Environments

## What it does

Explains local setup and required environment variables.

## Required local dependencies

- PHP compatible with `^7.3|^8.0`
- Composer
- MySQL
- Node + npm
- Optional but recommended: Mailhog or SMTP test inbox

## Environment variable groups

### Core app
- `APP_NAME`, `APP_ENV`, `APP_KEY`, `APP_DEBUG`, `APP_URL`

### Database
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

### Auth/session/security
- `MASTER_PASSWORD` (used by admin login bypass path)
- `SESSION_DRIVER`, `SESSION_LIFETIME`

### Queue/webhook
- `QUEUE_CONNECTION` (use `database` for webhook async processing)
- `WEBHOOK_CLIENT_SECRET`, `WEBHOOK_TEST_CLIENT_SECRET`

### Payment
- `PAYMENT_ENV` (`testing` or `live`)
- `PAYMENT_TEST_CLIENT_ID`, `PAYMENT_TEST_CLIENT_SECRET`
- `PAYMENT_LIVE_CLIENT_ID`, `PAYMENT_LIVE_CLIENT_SECRET`

### Mail
- `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_FROM_NAME`, `MAIL_FROM_ADDRESS`

## Safely extending

- Add new env vars in both `.env.example` and corresponding config usage.
- Avoid reading `env()` directly in controllers for new code; prefer config wrappers.

Related:
- [Integrations](09-integrations.md)
- [Deployment](11-deployment-and-ops.md)
