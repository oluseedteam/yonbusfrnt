<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'accountant_id', 'invoice_number',
        'amount', 'tax', 'status', 'due_date', 'issued_date',
        'description', 'notes'
    ];

    protected $casts = [
        'amount'      => 'decimal:2',
        'tax'         => 'decimal:2',
        'due_date'    => 'date',
        'issued_date' => 'date',
    ];

    const STATUSES = ['paid', 'pending', 'overdue'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function accountant()
    {
        return $this->belongsTo(User::class, 'accountant_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalAttribute(): float
    {
        return (float) $this->amount + (float) $this->tax;
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'paid'    => 'green',
            'pending' => 'yellow',
            'overdue' => 'red',
            default   => 'gray',
        };
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($invoice) {
            if (empty($invoice->invoice_number)) {
                $count = self::count() + 1;
                $invoice->invoice_number = 'INV-' . date('Y') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
