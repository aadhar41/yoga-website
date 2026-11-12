<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ContentStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgrammeCategory extends Model
{
    /** @use HasFactory<\Database\Factories\ProgrammeCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'sort_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => ContentStatus::class,
            'sort_order' => 'integer',
        ];
    }

    public function programmes(): HasMany
    {
        return $this->hasMany(Programme::class);
    }
}
