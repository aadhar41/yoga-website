<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AuditLogger
{
    /**
     * @param  array<string, mixed>  $metadata
     */
    public static function record(
        string $action,
        string $summary,
        ?Model $subject = null,
        array $metadata = [],
        ?Request $request = null
    ): AuditLog {
        $req = $request ?? request();

        return AuditLog::create([
            'user_id' => $req->user()?->getAuthIdentifier() ?? auth()->id(),
            'action' => $action,
            'auditable_type' => $subject ? $subject->getMorphClass() : null,
            'auditable_id' => $subject?->getKey(),
            'summary' => $summary,
            'metadata' => $metadata !== [] ? $metadata : null,
            'ip_address' => $req->ip(),
            'user_agent' => mb_substr((string) $req->userAgent(), 0, 500),
        ]);
    }
}
