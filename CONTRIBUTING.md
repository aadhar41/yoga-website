# Contributing

Thank you for helping improve this project. Contributions should fit its Laravel, Livewire, Blade, and Flux architecture.

## Before you start

- Check existing issues and pull requests for related work.
- For a substantial change, open an issue first to discuss the intended behavior.
- Do not include secrets, local environment files, or deployment-specific hostnames.

## Local setup

Follow the setup steps in [README.md](README.md). In brief, install Composer and npm dependencies, configure `.env`, generate the application key, migrate the database, and build frontend assets.

## Making a change

- Keep changes focused and follow neighboring Laravel and Livewire patterns.
- Add or update Pest feature tests for behavior changes.
- Keep account, dashboard, and settings routes behind their existing middleware.
- Add URLs to the sitemap only when their pages are public and intended for indexing.

## Checks

Run the relevant checks before opening a pull request:

```sh
php artisan test --compact
composer types:check
npm run build
```

The combined `composer ci:check` command also runs Pint formatting checks. The existing codebase may have unrelated formatting or test failures; report any such failures and do not make unrelated changes just to silence them.

## Pull requests

- Explain the problem and the user-visible result.
- Include tests or a clear reason tests are not applicable.
- Mention relevant configuration or migration changes.
- Confirm that no secrets or unrequested generated files are included.
