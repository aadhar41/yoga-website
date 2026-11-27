<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditLogController extends Controller
{
    public function __invoke(Request $request): View
    {
        $action = $request->string('action')->toString();
        $userId = $request->integer('user_id') ?: null;
        $search = trim($request->string('q')->toString());

        $logs = AuditLog::with('user')
            ->when($action !== '', fn ($q) => $q->where('action', $action))
            ->when($userId !== null, fn ($q) => $q->where('user_id', $userId))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($inner) use ($search) {
                    $inner->where('summary', 'like', "%{$search}%")
                        ->orWhere('auditable_type', 'like', "%{$search}%");
                });
            })
            ->latest('id')
            ->paginate(20)
            ->withQueryString();

        $actions = AuditLog::select('action')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        $users = User::query()
            ->whereIn('id', AuditLog::query()->whereNotNull('user_id')->select('user_id'))
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.audit-logs.index', compact('logs', 'actions', 'action', 'userId', 'users', 'search'));
    }
}
