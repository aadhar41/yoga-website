<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ClassFormat;
use App\Enums\ContentStatus;
use Database\Factories\ProgrammeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProgrammeCategory::class, 'programme_category_id');
    }
}
