<?php

namespace App\Observers;

use App\Models\AuditLog;
use App\Services\AuditLogger;
use Illuminate\Database\Eloquent\Model;

class AuditObserver
{
    private const IGNORED_ATTRIBUTES = [
        'created_at',
        'updated_at',
        'deleted_at',
        'last_login_at',
    ];

    private const REDACTED_ATTRIBUTES = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    public function created(Model $model): void
    {
        $this->record('created', $model, [
            'attributes' => $this->filterAttributes($model->getAttributes()),
        ]);
    }

    public function updated(Model $model): void
    {
        $newAttributes = $this->filterAttributes($model->getChanges());

        if ($newAttributes === []) {
            return;
        }

        $oldAttributes = $this->filterAttributes(
            array_intersect_key($model->getOriginal(), $newAttributes),
        );

        $this->record('updated', $model, [
            'old' => $oldAttributes,
            'new' => $newAttributes,
        ]);
    }

    public function deleted(Model $model): void
    {
        $this->record('deleted', $model, [
            'attributes' => $this->filterAttributes($model->getAttributes()),
        ]);
    }

    /**
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed>
     */
    private function filterAttributes(array $attributes): array
    {
        $attributes = array_diff_key($attributes, array_flip(self::IGNORED_ATTRIBUTES));

        foreach (self::REDACTED_ATTRIBUTES as $attribute) {
            if (array_key_exists($attribute, $attributes)) {
                $attributes[$attribute] = '[redacted]';
            }
        }

        return $attributes;
    }

    /**
     * @param  array<string, mixed>  $metadata
     */
    private function record(string $action, Model $model, array $metadata): AuditLog
    {
        $nameAttribute = match (class_basename($model)) {
            'BlogPost', 'Programme' => 'title',
            'Testimonial' => 'author_name',
            'Role', 'User' => 'name',
            default => null,
        };
        $name = $nameAttribute === null ? null : $model->getAttribute($nameAttribute);
        $name = is_string($name) && $name !== '' ? $name : (string) $model->getKey();

        return AuditLogger::record(
            $action,
            ucfirst($action).' '.class_basename($model).': '.$name,
            $model,
            $metadata,
        );
    }
}
