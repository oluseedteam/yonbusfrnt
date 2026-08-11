<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\AuditService;
use Livewire\Component;
use Livewire\WithPagination;

class UserManager extends Component
{
    use WithPagination;

    public $search = '';
    public $roleFilter = 'all';
    public $showModal = false;
    public $showDeleteModal = false;
    public $confirmingDeleteId = null;
    public $editId = null;
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $role = 'client';
    public $phone = '';
    public $password = '';

    protected function repo(): UserRepository
    {
        return app(UserRepository::class);
    }

    public function render()
    {
        $filters = [];
        if ($this->roleFilter !== 'all') {
            $filters['role'] = $this->roleFilter;
        }
        if (!empty($this->search)) {
            $filters['search'] = $this->search;
        }

        $users = $this->repo()->paginate(10, $filters);
        return view('livewire.admin.user-manager', compact('users'))->layout('layouts.admin');
    }

    public function openModal()
    {
        $this->reset(['editId', 'first_name', 'last_name', 'email', 'role', 'phone', 'password']);
        $this->showModal = true;
    }

    public function edit($id)
    {
        $user = $this->repo()->find($id);
        $this->editId     = $user->id;
        $this->first_name = $user->first_name;
        $this->last_name  = $user->last_name;
        $this->email      = $user->email;
        $this->role       = $user->getRoleNames()->first() ?? 'client';
        $this->phone      = $user->phone;
        $this->showModal  = true;
    }

    public function save()
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email' . ($this->editId ? ",{$this->editId}" : ''),
            'role'       => 'required|in:admin,subadmin,accountant,client',
            'phone'      => 'nullable|string|max:20',
        ];

        if (!$this->editId) {
            $rules['password'] = 'required|min:6';
        }

        $this->validate($rules);

        $data = [
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            'role'       => $this->role,
            'phone'      => $this->phone,
        ];

        if (!empty($this->password)) {
            $data['password'] = $this->password;
        }

        if ($this->editId) {
            $user = $this->repo()->update($this->editId, $data);
            AuditService::log('user.updated', "Updated user: {$user->name} ({$this->role})", 'User', $user->id);
        } else {
            $user = $this->repo()->create($data);
            AuditService::log('user.created', "Created user: {$user->name} ({$this->role})", 'User', $user->id);
        }

        $this->showModal = false;
        session()->flash('message', 'User saved successfully.');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active' => !$user->is_active]);
        AuditService::log('user.status_toggled', "Toggled status for: {$user->name}", 'User', $user->id);
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->confirmingDeleteId = null;
        $this->showDeleteModal = false;
    }

    public function deleteConfirmed()
    {
        if ($this->confirmingDeleteId) {
            $user = User::findOrFail($this->confirmingDeleteId);
            AuditService::log('user.deleted', "Deleted user: {$user->name}", 'User', $user->id);
            $this->repo()->delete($this->confirmingDeleteId);
            session()->flash('message', "User '{$user->name}' deleted successfully.");
        }
        $this->confirmingDeleteId = null;
        $this->showDeleteModal = false;
    }

    public function delete($id)
    {
        $this->confirmDelete($id);
    }
}
