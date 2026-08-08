<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements RepositoryInterface
{
    public function all(array $filters = [])
    {
        $query = User::query();
        if (!empty($filters['role'])) {
            $query->roleSafe($filters['role']);
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
        return User::with(['roles', 'clientProfile', 'accountantProfile'])->findOrFail($id);
    }

    public function create(array $data)
    {
        $role = $data['role'] ?? 'client';
        $data['role'] = $role;
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user = User::create($data);
        $user->safeAssignRole($role);
        return $user;
    }

    public function update(int $id, array $data)
    {
        $user = User::findOrFail($id);
        if (!empty($data['role'])) {
            try {
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
        return $user->fresh(['roles']);
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
