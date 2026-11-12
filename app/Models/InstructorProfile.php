<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstructorProfile extends Model
{
    /** @use HasFactory<\Database\Factories\InstructorProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'tagline',
        'short_bio',
        'full_bio',
        'qualifications',
        'specializations',
        'headshot_path',
        'years_of_experience',
    ];

    protected function casts(): array
    {
        return [
            'qualifications' => 'array',
            'specializations' => 'array',
            'years_of_experience' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
