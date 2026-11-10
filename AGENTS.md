# Project guidance

## Architecture

- Laravel 13 application on PHP 8.3+, using Livewire 4, Blade, Flux UI, Tailwind CSS 4, and Vite Plus.
- Public and dashboard routes are in `routes/web.php`; authenticated settings and the passkey discovery route are in `routes/settings.php`.
- Livewire pages are under `resources/views/pages`; shared layouts and components are under `resources/views/layouts` and `resources/views/components`.
- Follow existing Laravel, Livewire, Blade, and Flux patterns rather than introducing another frontend architecture.

## Setup and checks

- Follow the local environment and database setup in `README.md`; keep credentials in `.env`.
- `composer run dev` starts the Laravel server, queue listener, and Vite.
- `composer ci:check` runs Pint checks, PHPStan, and Pest.
- `npm run build` builds frontend assets.
- Run a focused feature test with `php artisan test --compact tests/Feature/<TestName>.php`.

## Conventions

- Keep private pages behind the existing authentication middleware and use named routes for links.
- Add only intentionally public, indexable pages to the sitemap; keep canonical and sitemap URLs based on `APP_URL`.
- Do not commit secrets, local environment files, or deployment-specific hostnames.
