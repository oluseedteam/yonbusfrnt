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
        'reminder_sent_at',
    ];

    protected static function booted(): void
    {
        static::creating(function ($appointment) {
            if (empty($appointment->appointment_number)) {
                $count = static::withTrashed()->count() + 1;
                $appointment->appointment_number = 'APT-' . str_pad($count, 5, '0', STR_PAD_LEFT);
            }
        });
    }

    protected $casts = [
        'date'             => 'date',
        'reminder_sent_at' => 'datetime',
    ];

    // ── Statuses ──────────────────────────────────────────────────
    const STATUSES = ['pending', 'confirmed', 'completed', 'cancelled', 'rescheduled'];

    /**
     * Get the full scheduled Carbon date & time for this appointment in app timezone.
     */
    public function scheduledAt(): \Illuminate\Support\Carbon
    {
        $dateStr = $this->date instanceof \Carbon\CarbonInterface ? $this->date->format('Y-m-d') : (string) $this->date;
        $timeStr = $this->time ? trim($this->time) : '09:00:00';
        return \Illuminate\Support\Carbon::parse("{$dateStr} {$timeStr}", config('app.timezone'));
    }

    /**
     * Get the exact time the 1 hour 30 minute reminder is due (90 minutes before scheduled start).
     */
    public function reminderDueAt(): \Illuminate\Support\Carbon
    {
        return $this->scheduledAt()->copy()->subMinutes(90);
    }

    /**
     * Determine whether the 1 hour 30 minute reminder is currently due to be sent.
     */
    public function isReminderDue(): bool
    {
        $now = now(config('app.timezone'));
        $scheduledAt = $this->scheduledAt();

        return $scheduledAt->greaterThan($now->copy()->subMinutes(15))
            && $scheduledAt->lessThanOrEqualTo($now->copy()->addMinutes(90));
    }

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
