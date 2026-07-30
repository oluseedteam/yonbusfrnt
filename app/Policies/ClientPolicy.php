<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;

class ClientPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'super-admin', 'accountant']);
    }

    public function view(User $user, Client $client): bool
    {
        if ($user->hasAnyRole(['admin', 'super-admin'])) return true;
        if ($user->hasRole('accountant')) return true; // accountants can view all clients
        if ($user->hasRole('client')) return $client->user_id === $user->id;
        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'super-admin']);
    }

    public function update(User $user, Client $client): bool
    {
        if ($user->hasAnyRole(['admin', 'super-admin'])) return true;
        if ($user->hasRole('client')) return $client->user_id === $user->id;
        return false;
    }

    public function delete(User $user, Client $client): bool
    {
        return $user->hasAnyRole(['admin', 'super-admin']);
    }
}
