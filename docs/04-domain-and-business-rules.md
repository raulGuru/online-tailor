# 04 - Domain and Business Rules

## What it does

Captures important rules inferred from code.

## Core entities and rules

### Product catalog
- Products belong to master category + category + subcategory + color + tailor.
- Product stock-like field is `products.size`; it is decremented on payment request creation.
- Product media is stored as JSON filename arrays.

### Tailors
- Tailors define services, working days, and per-stitch costs.
- Tailor creation also creates/updates a linked vendor user account.

### Measurement and order flow
- Session keys are required in sequence:
  1. `pincode`
  2. `measurement`
  3. `customer_details`
  4. `order_data`
- Missing keys redirect to earlier steps.

### Orders/payments
- Order status transitions include `initiated`, `placed`, `failed`, etc.
- Payment callback and webhook both update payment/order statuses.

## Where in code

- Measurement flow: `MeasurementController`, helpers in `app/helpers.php`
- Tailor and stitching: `TailorController`, `StitchingController`, `stitching_costs` table
- Orders/payments: `OrderController`, `app/Handler/WebhookJobHandlerForPayment.php`

## Safely extending

- Keep measurement schema changes synchronized across helpers + Blade forms + order detail decoding.
- If adding order states, update migrations (enum), UI filters, and status update endpoints.

## Gotchas

- Women measurement and stitching matrices are mostly empty placeholders.
- Some validation allows data inconsistency (e.g., minimal cross-table constraints).
- `order_view` endpoint currently contains debug stop code.

See also [Data model](06-data-model.md) and [How-to changes](12-how-to-change-common-things.md).
