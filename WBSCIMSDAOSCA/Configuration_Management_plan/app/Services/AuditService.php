<?php
namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AuditService
{
    public static function log(string $action, string $description, ?Model $model = null, ?Request $request = null): void
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'auditable_type' => $model?->getMorphClass(),
            'auditable_id' => $model?->getKey(),
            'description' => $description,
            'ip_address' => $request?->ip() ?? request()->ip(),
        ]);
    }
}
