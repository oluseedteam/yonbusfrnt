<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;

class AppointmentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'super-admin', 'accountant', 'client']);
    }

    public function view(User $user, Appointment $appointment): bool
    {
        if ($user->hasAnyRole(['admin', 'super-admin'])) return true;
        if ($user->hasRole('accountant')) return $appointment->accountant_id === $user->id;
        if ($user->hasRole('client'))     return $appointment->client_id === $user->id;
        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'super-admin', 'client']);
    }

    public function update(User $user, Appointment $appointment): bool
    {
        if ($user->hasAnyRole(['admin', 'super-admin'])) return true;
        if ($user->hasRole('client')) {
            return $appointment->client_id === $user->id
                && in_array($appointment->status, ['pending', 'confirmed']);
        }
        return false;
    }

    public function delete(User $user, Appointment $appointment): bool
    {
        return $user->hasAnyRole(['admin', 'super-admin']);
    }

    public function cancel(User $user, Appointment $appointment): bool
    {
        if ($user->hasAnyRole(['admin', 'super-admin'])) return true;
        if ($user->hasRole('client')) return $appointment->client_id === $user->id;
        return false;
    }

    public function updateStatus(User $user, Appointment $appointment): bool
    {
        return $user->hasAnyRole(['admin', 'super-admin', 'accountant']);
    }
}
