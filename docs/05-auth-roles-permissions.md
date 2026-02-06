# 05 - Auth, Roles, Permissions

## What it does

Documents authentication and authorization behavior.

## Auth method

- Session-based auth using default Laravel guard.
- Customer login: `CustomerLoginController`
- Admin/vendor login: `LoginController`

## Roles in use

Application logic actively uses:
- `admin`
- `vendor`
- `customer`

Helpers expose role list via `get_roles()` in `app/helpers.php`.

## Authorization locations

- Middleware:
  - `UserRole` blocks unauthenticated users from admin dashboard and redirects customers away from admin area.
  - `EnsureTokenIsValid` is attached to admin login route.
- Controller constructors often apply middleware (`auth`, `role`).

## Protected route patterns

- Back-office resources generally require `auth` + `role`.
- Customer account routes require `auth`.

## Safely extending

- Add new role constants in helpers and ensure users table enum supports it.
- Update middleware logic carefully if introducing finer-grained permissions.
- Prefer policy/gate introduction for per-resource authorization (currently minimal usage).

Related:
- [Routes](07-routes-and-api.md)
- [Domain rules](04-domain-and-business-rules.md)
