# Yoga Website

A Laravel application using Livewire and Blade. The current public homepage is the Laravel welcome screen; authenticated dashboard and account settings come from the Livewire starter kit.

## Stack and tools

- PHP 8.3+ and Laravel 13
- Livewire 4, Blade, and Flux UI
- Tailwind CSS 4 and Vite Plus for frontend assets
- MySQL configured by default in `.env.example`; tests use in-memory SQLite
- Pest for tests, Pint for formatting, and Larastan/PHPStan for static analysis

## Setup

1. Clone this repository from its GitHub URL and open the project directory.
2. Copy `.env.example` to `.env` and set the database connection details.
3. Install dependencies and initialize the application:

   ```sh
   composer install
   php artisan key:generate
   php artisan migrate
   npm ci
   npm run build
   ```

4. Start the local application:

   ```sh
   composer run dev
   ```

## Useful commands

| Command | Purpose |
| --- | --- |
| `composer run dev` | Run Laravel, the queue listener, and Vite for development |
| `npm run build` | Build production frontend assets |
| `composer ci:check` | Run Pint checks, PHPStan, and the Pest suite |
| `composer test` | Run the project's combined checks and tests |
| `php artisan route:list` | Inspect registered application routes |

## Structure and conventions

- `routes/web.php` contains the public homepage and dashboard routes.
- `routes/settings.php` contains authenticated account settings and the passkey discovery endpoint.
- `app/Livewire` and `resources/views/pages` contain Livewire features; reusable layouts and Blade components are in `resources/views`.
- `app/Models` contains Eloquent models. Follow the existing Laravel, Livewire, Blade, and Flux patterns.
- Keep credentials in the local `.env`; never commit environment secrets.

## SEO and production configuration

The homepage is currently the only indexable page. `/sitemap.xml` lists that route, and `/robots.txt` points to the sitemap while excluding dashboard, settings, and technical endpoints. Add public routes to the sitemap only when they are intended to be indexed.

Set `APP_URL` to the canonical production origin in the deployment environment. The homepage canonical URL, sitemap URLs, and robots sitemap reference use this value. Set `APP_NAME` to the public site name before launch. The repository has a GitHub Actions checks workflow but no deployment platform configuration or automated deployment workflow.

## Community and licensing

See [CONTRIBUTING.md](CONTRIBUTING.md) for contribution guidance, [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md) for community expectations, [SECURITY.md](SECURITY.md) for vulnerability reporting, and [LICENSE](LICENSE) for license terms.
