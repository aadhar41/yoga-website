<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(string|array $roles): bool
    {
        $roles = is_array($roles) ? $roles : [$roles];

        return $this->roles->whereIn('slug', $roles)->isNotEmpty();
    }

    public function isOwner(): bool
    {
        return $this->hasRole('owner');
    }

    public function hasPermission(string $permissionSlug): bool
    {
        // Owners implicitly have all permissions
        if ($this->isOwner()) {
            return true;
        }

        return $this->roles()
            ->whereHas('permissions', fn ($q) => $q->where('slug', $permissionSlug))
            ->exists();
    }

    public function assignRole(string|Role $role): void
    {
        if (is_string($role)) {
            $role = Role::where('slug', $role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching([$role->id]);
    }
}
