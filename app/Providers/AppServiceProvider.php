<?php

namespace App\Providers;

use App\Models\Permission;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Owner passes every check
        Gate::before(fn ($user) => $user->isOwner() ? true : null);

        $connection = config('database.default');
        $databasePath = config("database.connections.{$connection}.database");

        if ($connection === 'sqlite' && is_string($databasePath)) {
            $isMemoryDatabase = $databasePath === ':memory:'
                || str_contains($databasePath, '?mode=memory')
                || str_contains($databasePath, '&mode=memory')
                || str_starts_with($databasePath, 'file:');

            if (
                ! $isMemoryDatabase
                && ! file_exists($databasePath)
                && ! file_exists(base_path($databasePath))
            ) {
                return;
            }
        }

        if (! app()->runningInConsole() || Schema::hasTable('permissions')) {
            Permission::pluck('slug')->each(
                fn (string $slug) => Gate::define($slug, fn ($user) => $user->hasPermission($slug))
            );
        }
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
