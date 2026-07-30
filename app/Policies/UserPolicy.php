<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'super-admin']);
    }

    public function view(User $user, User $model): bool
    {
        if ($user->hasAnyRole(['admin', 'super-admin'])) return true;
        return $user->id === $model->id;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'super-admin']);
    }

    public function update(User $user, User $model): bool
    {
        if ($user->hasAnyRole(['admin', 'super-admin'])) return true;
        return $user->id === $model->id;
    }

    public function delete(User $user, User $model): bool
    {
        if (!$user->hasAnyRole(['admin', 'super-admin'])) return false;
        return $user->id !== $model->id; // Can't delete yourself
    }

    public function toggleStatus(User $user, User $model): bool
    {
        return $user->hasAnyRole(['admin', 'super-admin']) && $user->id !== $model->id;
    }
}
