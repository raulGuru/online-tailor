# 07 - Routes and API

## What it does

Provides route-level navigation for web and API endpoints.

## Web routes (`routes/web.php`)

### Customer-facing
- `resource /` and `resource home` -> `HomeController`
- `resource category` -> browse/search products
- `resource login` -> customer login
- `resource signup` -> customer signup
- `GET account/orders` -> `CustomerAccountController@orders`
- `GET account/address` -> `CustomerAccountController@address`
- `resource account` -> customer profile
- `resource measurement` + custom posts:
  - `measurement/get_fields`
  - `measurement/save_measurement`
  - `measurement/book_tailor`
- `resource order` + custom payment/order actions:
  - `process_payment`
  - `payment_response`

### Admin/vendor
- `resource admin/login` (+ middleware `EnsureTokenIsValid`)
- `POST admin/logout`
- `resource dashboard`, `user`, `tailors`, `product`, `stitching`, `appointment`, `location`, `product_category`, `product_subcategory`
- Custom maintenance/status/search routes (examples):
  - `product/remove_image/{id}`
  - `product/get_subcategory`
  - `tailors/remove_image/{id}` (route declared, method not implemented)
  - `appointment/list`
  - `location/list`
  - `location/send_notification`
  - `order/list`, `order/update_status`, `payment/list`
  - `product_category/update_status`, `product_subcategory/update_status`

### Webhook endpoint
- `Route::webhooks('payment_wehook', 'payment_wehook')`

## API routes (`routes/api.php`)

- Default Sanctum protected `/api/user` endpoint only.

## Safely extending

- Keep resource route conventions where possible.
- If adding JSON endpoints, return consistent `{code,status,...}` payload shape used in existing AJAX methods.

## Gotchas

- No generated route names table included because artisan route:list requires installed vendor deps.
- A few route/controller mismatches exist (declared route but missing controller method).

Related:
- [Auth](05-auth-roles-permissions.md)
- [Integrations](09-integrations.md)
