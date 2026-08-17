<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements RepositoryInterface
{
    public function all(array $filters = [])
    {
        $query = User::query()->with(['roles', 'assignedAdmin', 'clientProfile']);

        if (!empty($filters['role'])) {
            $query->roleSafe($filters['role']);
        }
        if (!empty($filters['assigned_admin_id'])) {
            $query->where('assigned_admin_id', $filters['assigned_admin_id']);
        }
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('first_name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('last_name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('email', 'like', '%' . $filters['search'] . '%');
            });
        }
        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }
        return $query->latest();
    }

    public function find(int $id)
    {
        return User::with(['roles', 'assignedAdmin', 'clientProfile', 'accountantProfile'])->findOrFail($id);
    }

    public function create(array $data)
    {
        $role = $data['role'] ?? 'client';
        $data['role'] = $role;
        $data['is_active'] = $data['is_active'] ?? true;
        $data['email_verified_at'] = $data['email_verified_at'] ?? now();
        
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        
        $user = User::create($data);
        $user->safeAssignRole($role);

        if ($role === 'client') {
            \App\Models\Client::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'assigned_admin_id' => $data['assigned_admin_id'] ?? null,
                    'client_number'     => 'CL-' . strtoupper(\Illuminate\Support\Str::random(6)),
                    'company_name'      => $data['company_name'] ?? null,
                    'tax_number'        => $data['tax_number'] ?? null,
                    'address'           => $data['address'] ?? null,
                    'city'              => $data['city'] ?? null,
                    'province'          => $data['province'] ?? null,
                    'postal_code'       => $data['postal_code'] ?? null,
                ]
            );
        }

        return $user;
    }

    public function update(int $id, array $data)
    {
        $user = User::findOrFail($id);
        
        if (!empty($data['role'])) {
            try {
                \Spatie\Permission\Models\Role::firstOrCreate(['name' => $data['role'], 'guard_name' => 'web']);
                $user->syncRoles([$data['role']]);
            } catch (\Throwable $e) {
                // Fall back to direct column update
            }
        }
        
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        
        $user->update($data);

        if ($user->isClient()) {
            \App\Models\Client::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'assigned_admin_id' => $data['assigned_admin_id'] ?? $user->assigned_admin_id,
                    'company_name'      => $data['company_name'] ?? $user->clientProfile?->company_name,
                    'tax_number'        => $data['tax_number'] ?? $user->clientProfile?->tax_number,
                    'address'           => $data['address'] ?? $user->clientProfile?->address,
                    'city'              => $data['city'] ?? $user->clientProfile?->city,
                    'province'          => $data['province'] ?? $user->clientProfile?->province,
                    'postal_code'       => $data['postal_code'] ?? $user->clientProfile?->postal_code,
                ]
            );
        }

        return $user->fresh(['roles', 'assignedAdmin', 'clientProfile']);
    }

    public function delete(int $id)
    {
        return User::findOrFail($id)->delete();
    }

    public function paginate(int $perPage = 15, array $filters = [])
    {
        return $this->all($filters)->with('roles')->paginate($perPage);
    }
}
