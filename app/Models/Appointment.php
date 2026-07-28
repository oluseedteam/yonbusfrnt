<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'accountant_id', 'service_id',
        'date', 'time', 'status', 'notes', 'meeting_link'
    ];

    protected $casts = ['date' => 'date'];

    const STATUSES = ['pending', 'confirmed', 'cancelled', 'completed', 'rescheduled'];

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

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'confirmed' => 'green',
            'pending'   => 'yellow',
            'cancelled' => 'red',
            'completed' => 'blue',
            'rescheduled' => 'purple',
            default     => 'gray',
        };
    }
}
