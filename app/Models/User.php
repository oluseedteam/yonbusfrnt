<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'role',
        'company_name',
        'tax_identification_number',
        'address',
        'avatar',
        'is_active',
        'notification_email',
        'notification_database',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at'      => 'datetime',
            'password'               => 'hashed',
            'is_active'              => 'boolean',
            'notification_email'     => 'boolean',
            'notification_database'  => 'boolean',
        ];
    }

    // ── Accessors ──────────────────────────────────────────────────
    public function getNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function getRoleAttribute(): string
    {
        if ($this->relationLoaded('roles') && $this->roles->count() > 0) {
            return $this->roles->first()->name;
        }
        $spatieRole = $this->getRoleNames()->first();
        if ($spatieRole) {
            return $spatieRole;
        }
        return $this->attributes['role'] ?? 'client';
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar && \Storage::disk('public')->exists($this->avatar)) {
            return asset('storage/' . $this->avatar);
        }
        $name = urlencode($this->name ?: $this->email);
        return "https://ui-avatars.com/api/?name={$name}&background=005DFF&color=fff&bold=true";
    }

    // ── Role helpers ───────────────────────────────────────────────
    public function isSuperAdmin(): bool  { return $this->hasRole(['super-admin', 'superadmin']) || $this->role === 'superadmin' || $this->role === 'super-admin'; }
    public function isAdmin(): bool       { return $this->hasRole(['admin', 'super-admin', 'superadmin', 'subadmin']) || in_array($this->role, ['admin', 'superadmin', 'subadmin']); }
    public function isAccountant(): bool  { return $this->hasRole('accountant') || $this->role === 'accountant'; }
    public function isClient(): bool      { return $this->hasRole('client') || $this->role === 'client'; }


    // ── Relationships ───────────────────────────────────────────────
    public function clientProfile()
    {
        return $this->hasOne(Client::class);
    }

    public function accountantProfile()
    {
        return $this->hasOne(Accountant::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'client_id');
    }

    public function accountantAppointments()
    {
        return $this->hasMany(Appointment::class, 'accountant_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'client_id');
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'client_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'client_id');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function communicationLogs()
    {
        return $this->hasMany(CommunicationLog::class, 'sender_id');
    }
}
