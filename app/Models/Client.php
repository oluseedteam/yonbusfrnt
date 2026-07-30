<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'client_number',
        'company_name',
        'tax_number',
        'address',
        'city',
        'province',
        'postal_code',
        'notes',
    ];

    // ── Relationships ──────────────────────────────────────────────
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'client_id', 'user_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'client_id', 'user_id');
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'client_id', 'user_id');
    }

    public function communicationLogs()
    {
        return $this->hasMany(CommunicationLog::class, 'sender_id', 'user_id');
    }
}
