<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ClassFormat;
use App\Enums\ContentStatus;
use Database\Factories\ProgrammeFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property ContentStatus $status
 * @property-read bool $is_published
 */
class Programme extends Model
{
    /** @use HasFactory<ProgrammeFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'programme_category_id',
        'title',
        'slug',
        'short_description',
        'overview',
        'benefits',
        'level',
        'duration_text',
        'format',
        'featured_image',
        'is_featured',
        'sort_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'benefits' => 'array',
            'format' => ClassFormat::class,
            'status' => ContentStatus::class,
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /** @return Attribute<bool, never> */
    protected function isPublished(): Attribute
    {
        return Attribute::get(fn (): bool => $this->status === ContentStatus::Published);
    }

    /**
     * @param  Builder<Programme>  $query
     * @return Builder<Programme>
     */
    #[Scope]
    protected function published(Builder $query): Builder
    {
        return $query->where('status', ContentStatus::Published->value);
    }

    /** @return BelongsTo<ProgrammeCategory, $this> */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProgrammeCategory::class, 'programme_category_id');
    }
}
