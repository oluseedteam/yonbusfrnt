<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'accountant_id', 'year', 'status', 'notes', 'amount',
        'submitted_at', 'reviewed_at', 'processed_at', 'approved_at', 'completed_at'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at'  => 'datetime',
        'processed_at' => 'datetime',
        'approved_at'  => 'datetime',
        'completed_at' => 'datetime',
        'amount'       => 'decimal:2',
    ];

    const STATUSES = ['submitted', 'reviewed', 'processing', 'approved', 'completed'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function accountant()
    {
        return $this->belongsTo(User::class, 'accountant_id');
    }

    public function getStatusIndexAttribute(): int
    {
        return array_search($this->status, self::STATUSES) ?: 0;
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'submitted'  => 'blue',
            'reviewed'   => 'purple',
            'processing' => 'yellow',
            'approved'   => 'green',
            'completed'  => 'teal',
            default      => 'gray',
        };
    }
}
