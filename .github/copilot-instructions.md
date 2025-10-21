## Quick context for AI coding agents

This is a Laravel 8 application (see `composer.json`) that runs on PHP ^7.3 | ^8.0 and uses Laravel resource controllers, Blade views, and Laravel Mix for frontend assets.

Key facts you should know before editing code:

- The app exposes admin functionality under the `/admin` prefix protected by `auth` middleware (`routes/web.php`).
- Controllers use standard resource methods (index/create/store/show/edit/update/destroy) and also include AJAX helpers named `showCreate`, `showEdit`, and `showDetail` which return HTML fragments used inside Bootstrap modals. Example: `resources/views/user/index.blade.php` calls `route('users.showCreate')` via AJAX.
- Global view data: `App\Providers\AppServiceProvider::boot()` registers a view composer that injects a singleton `StoreInfo::first()` into every view as `$storeInfo`.
- Blade helper: a custom directive `@toIDR($amount)` formats currency (defined in `AppServiceProvider`).
- Asset pipeline: uses Laravel Mix (`package.json`) with scripts `npm run dev|production`. JS uses `axios` for AJAX requests (check views for inline JS that calls named routes).

How to run / build locally (what I observed):

- PHP dependencies: `composer install` (composer.json). After installing, make sure `.env` exists (composer scripts copy `.env.example` on project creation). Then run `php artisan key:generate` and `php artisan migrate` to prepare DB.
- Frontend: `npm install` then `npm run dev` (or `npm run production`) to build assets (see `package.json`).
- Tests: PHPUnit is configured via `phpunit.xml` and available in dev dependencies; run `vendor/bin/phpunit`.
- Common dev runtime: this repo is commonly run under XAMPP (project root points to `public/`). `php artisan serve` also works for quick testing.

Project-specific conventions and patterns (important for code changes):

- Modal partial pattern: many index views (`resources/views/*/index.blade.php`) include small inline JS functions that POST to named routes like `*.showCreate` and expect the controller to return a view partial (create/edit blades under the same folder). When adding new resources, follow this pattern.
- Naming quirks: some controller and route names contain typos (e.g. `BuyingTranscationController` instead of `BuyingTransaction...`). When searching or adding routes/controllers, match the existing names to avoid breaking code.
- Singletons / single-row tables: `StoreInfo` is treated as a single-row config object and accessed via `StoreInfo::first()`. Don't assume multiple rows.
- Stocks and relationships: models use explicit pivot-ish models like `ItemStock`, `ItemSize`, `ItemColour` and controllers update stock counts when creating/deleting transactions (see `BuyingTranscationController`, `SellingTransactionController`). Be careful when changing transaction logic—there are stock-add/subtract flows and dedicated controller methods like `deleteSubstractStock` and `deleteAddStock`.

Integration and external dependencies to be aware of:

- `laravel/sanctum` (API/auth), `guzzlehttp/guzzle` (HTTP client) in `composer.json`.
- `axios` and `bootstrap` in `package.json`; AJAX calls are present inside blade templates.

Small contract & examples (use these when writing code or tests):

- showCreate/showEdit endpoints: accept POST requests (often with `id`), return an HTML fragment (blade partial). Example controller methods: `App\Http\Controllers\UserController::showCreate()` and blade partial `resources/views/user/create.blade.php`.
- Global view data: controllers and views rely on `$storeInfo` being present—if migrating code to a command-line context, ensure the view composer is loaded or inject `StoreInfo::first()` explicitly.

Where to look for examples in the repo:

- Route file: `routes/web.php` (auth + admin group) — canonical list of endpoints.
- View composer / Blade directive: `app/Providers/AppServiceProvider.php`.
- Modal pattern examples: `resources/views/user/index.blade.php`, `resources/views/item/index.blade.php`, `resources/views/supplier/index.blade.php`.
- Transaction/stock examples: `app/Http/Controllers/BuyingTranscationController.php`, `app/Http/Controllers/SellingTransactionController.php`.

Common pitfalls to avoid (based on current code):

- Renaming controllers or routes without updating all occurrences — there are many string-based `route('...')` usages inside blade templates.
- Assuming `StoreInfo` always exists — code usually calls `StoreInfo::first()` and templates expect properties; guard for null when writing migrations or seeders.
- Changing transaction logic without updating both buying & selling flows — they mirror each other and affect stock counts.

If you need to add tests or change behavior:

- Prefer adding small unit tests under `tests/Unit` and feature tests under `tests/Feature` and run them with `vendor/bin/phpunit`.
- For database tests, use an SQLite in-memory DB or ensure migrations are run in the test environment.

If anything in this file is unclear or missing, tell me which area (routes, modal pattern, transactions, build steps) and I will expand the examples or add missing file references.
