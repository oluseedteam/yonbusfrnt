<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'action',
        'description',
        'model_type',
        'record_id',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($log) {
            $log->created_at = now();
        });
    }

    /**
     * Helper to quickly log an activity.
     */
    public static function log(string $action, ?string $description = null, ?Model $model = null, ?int $userId = null): self
    {
        return static::create([
            'user_id'     => $userId ?? auth()->id(),
            'action'      => $action,
            'description' => $description,
            'model_type'  => $model ? get_class($model) : null,
            'record_id'   => $model?->id ?? null,
            'ip_address'  => request()?->ip(),
            'user_agent'  => request()?->userAgent(),
            'created_at'  => now(),
        ]);
    }

    // ── Relationships ──────────────────────────────────────────────
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
