<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditService
{
    public static function log(string $action, string $description = '', ?string $modelType = null, ?int $recordId = null): void
    {
        try {
            ActivityLog::create([
                'user_id'     => Auth::id(),
                'action'      => $action,
                'description' => $description,
                'model_type'  => $modelType,
                'record_id'   => $recordId,
                'ip_address'  => Request::ip(),
                'user_agent'  => Request::userAgent(),
            ]);
        } catch (\Throwable $e) {
            // Never break the application because of audit log failure
            \Log::warning('AuditService: failed to write log — ' . $e->getMessage());
        }
    }
}
