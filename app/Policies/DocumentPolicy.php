<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;

class DocumentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'super-admin', 'accountant', 'client']);
    }

    public function view(User $user, Document $document): bool
    {
        if ($user->hasAnyRole(['admin', 'super-admin', 'accountant'])) return true;
        if ($user->hasRole('client')) return $document->client_id === $user->id;
        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'super-admin', 'accountant', 'client']);
    }

    public function delete(User $user, Document $document): bool
    {
        if ($user->hasAnyRole(['admin', 'super-admin'])) return true;
        if ($user->hasRole('client')) {
            return $document->client_id === $user->id && $document->uploaded_by === $user->id;
        }
        return false;
    }

    public function download(User $user, Document $document): bool
    {
        return $this->view($user, $document);
    }
}
