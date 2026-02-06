# 00 - Introduction

## What this project does

Online Tailor (BookMyTailor) is a marketplace/workflow app where:
1. customers browse products,
2. enter measurements,
3. pick a nearby tailor,
4. pay using Instamojo,
5. then track orders.

Admin/vendor users manage catalog, stitch definitions, tailors, appointments, and order statuses.

## Where in code

- Entry routes: `routes/web.php`
- Customer browsing: `App\Http\Controllers\CategoryController`
- Measurement + booking flow: `MeasurementController`, `LocationController`, `OrderController`
- Back office: `ProductController`, `TailorController`, `StitchingController`, `OrderController`, `AppointmentController`

Related pages:
- [Architecture overview](01-architecture-overview.md)
- [Domain rules](04-domain-and-business-rules.md)
- [Routes map](07-routes-and-api.md)

## Key user types

- **Customer**: signs up/logs in, books appointments/orders.
- **Vendor**: tailor-facing dashboard access to their scoped data.
- **Admin**: full management access.

See [Auth and roles](05-auth-roles-permissions.md).

## Safely extending

- Follow existing controller-centric pattern (no service layer currently).
- Keep session keys stable (`pincode`, `measurement`, `customer_details`, `order_data`) because checkout depends on them.
- Add DB columns through migrations first; then update controllers/views.
