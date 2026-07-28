<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\ActivityLog;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class UserManager extends Component
{
    public $search = '';
    public $roleFilter = 'all';
    public $showModal = false;
    public $editId = null;
    public $name = '';
    public $email = '';
    public $role = 'client';
    public $phone = '';
    public $password = '';

    public function render()
    {
        $query = User::query();
        if ($this->roleFilter !== 'all') $query->where('role', $this->roleFilter);
        if ($this->search) {
            $query->where(fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%"));
        }
        $users = $query->latest()->paginate(10);
        return view('livewire.admin.user-manager', compact('users'))->layout('layouts.admin');
    }

    public function openModal()
    {
        $this->reset(['editId', 'name', 'email', 'role', 'phone', 'password']);
        $this->showModal = true;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->editId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->phone = $user->phone;
        $this->showModal = true;
    }

    public function save()
    {
        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($this->editId ? ",{$this->editId}" : ''),
            'role'  => 'required|in:admin,accountant,client',
            'phone' => 'nullable|string|max:20',
        ];
        if (!$this->editId) $rules['password'] = 'required|min:8';
        $this->validate($rules);

        if ($this->editId) {
            User::findOrFail($this->editId)->update(['name' => $this->name, 'email' => $this->email, 'role' => $this->role, 'phone' => $this->phone]);
            ActivityLog::log('user.updated', "Updated user: {$this->name}");
        } else {
            $user = User::create(['name' => $this->name, 'email' => $this->email, 'role' => $this->role, 'phone' => $this->phone, 'password' => Hash::make($this->password)]);
            ActivityLog::log('user.created', "Created user: {$this->name}");
        }
        $this->showModal = false;
        session()->flash('message', 'User saved successfully.');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active' => !$user->is_active]);
        ActivityLog::log('user.status_toggled', "Toggled status for: {$user->name}");
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        ActivityLog::log('user.deleted', "Deleted user: {$user->name}");
        $user->delete();
        session()->flash('message', 'User deleted.');
    }
}
