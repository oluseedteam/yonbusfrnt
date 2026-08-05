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

    // ── Relationships ──────────────────────────────────────────────
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
