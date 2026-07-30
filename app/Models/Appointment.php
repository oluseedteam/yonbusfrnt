<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'appointment_number',
        'client_id',
        'accountant_id',
        'service_id',
        'date',
        'time',
        'duration',
        'status',
        'notes',
        'meeting_link',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // ── Statuses ──────────────────────────────────────────────────
    const STATUSES = ['pending', 'confirmed', 'completed', 'cancelled', 'rescheduled'];

    // ── Scopes ────────────────────────────────────────────────────
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now()->toDateString())
                     ->whereNotIn('status', ['cancelled', 'completed']);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // ── Relationships ──────────────────────────────────────────────
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function accountant()
    {
        return $this->belongsTo(User::class, 'accountant_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
