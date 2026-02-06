# 12 - How to Change Common Things

## Add a new web endpoint

1. Add route in `routes/web.php`.
2. Create controller method under relevant controller in `app/Http/Controllers`.
3. Add Blade view in `resources/views/...` if page response.
4. Add middleware (`auth`, `role`) consistently.
5. Add feature test (recommended).

**Gotcha:** Existing app uses many resource controllers; avoid conflicting URIs with existing `Route::resource` declarations.

## Add a new model/table

1. Create migration (`php artisan make:migration`).
2. Define schema and constraints.
3. Create model in `app/Models`.
4. Add relationships in both directions where needed.
5. Update controllers + views.

**Gotcha:** Existing code often uses manual Query Builder joins; update those too, not only Eloquent relations.

## Add/modify validation rules

1. Find controller action (e.g., `store`/`update`).
2. Update `$this->validate(...)` rules.
3. Verify corresponding form fields in Blade.
4. Add regression test for invalid and valid payloads.

**Gotcha:** This codebase mostly uses inline validation (not FormRequest classes), so consistency must be maintained manually.

## Add a new job

1. Create job class (or webhook-like handler pattern if external callback).
2. Dispatch from controller/service.
3. Ensure queue driver set (`database` recommended).
4. Run worker in local/prod.

## Add a role-based restriction

1. Update role enum migration (new migration only).
2. Update `get_roles()` helper.
3. Update middleware (`UserRole`) and controller checks.
4. Update UI navigation visibility as needed.

**Gotcha:** Current app has mixed authorization checks; verify both route middleware and in-method logic.

## Change payment integration behavior

1. Edit `OrderController` (redirect flow).
2. Edit webhook config/handlers (`config/webhook-client.php`, `app/Handler/*`).
3. Confirm env vars in `.env.example`.
4. Test callback + webhook status sync.
