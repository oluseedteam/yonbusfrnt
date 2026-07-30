<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                     => $this->id,
            'first_name'             => $this->first_name,
            'last_name'              => $this->last_name,
            'full_name'              => $this->name,
            'email'                  => $this->email,
            'phone'                  => $this->phone,
            'roles'                  => $this->getRoleNames(),
            'avatar_url'             => $this->avatar_url,
            'is_active'              => (bool) $this->is_active,
            'notification_email'     => (bool) $this->notification_email,
            'notification_database'  => (bool) $this->notification_database,
            'created_at'             => $this->created_at?->toIso8601String(),
        ];
    }
}
