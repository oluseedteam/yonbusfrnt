<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\AuditService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class UserManager extends Component
{
    use WithPagination, WithFileUploads;

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
    public $company_name = '';
    public $tax_number = '';
    public $address = '';
    public $city = '';
    public $province = '';
    public $postal_code = '';
    public $consultantFilter = 'my';
    public $assigned_admin_id = null;
    public $avatar = null;
    public $lastCreatedCredentials = null;

    protected function repo(): UserRepository
    {
        return app(UserRepository::class);
    }

    public function mount()
    {
        $admin = auth()->user();
        // If the user is a partner admin (Olubukunola or Adeshola), default filter to their assigned clients
        if ($admin && (str_contains(strtolower($admin->email), 'olubukunola') || str_contains(strtolower($admin->email), 'adeshola'))) {
            $this->consultantFilter = 'my';
        } else {
            $this->consultantFilter = 'all';
        }
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

        // Apply consultant scoping
        $admin = auth()->user();
        if ($this->consultantFilter === 'my' && $admin) {
            $filters['assigned_admin_id'] = $admin->id;
        } elseif ($this->consultantFilter === 'olubukunola') {
            $partner = User::where('email', 'olubukunola@yonbustax.ca')->first();
            if ($partner) $filters['assigned_admin_id'] = $partner->id;
        } elseif ($this->consultantFilter === 'adeshola') {
            $partner = User::where('email', 'like', 'adeshola%')->first();
            if ($partner) $filters['assigned_admin_id'] = $partner->id;
        }

        $users = $this->repo()->paginate(10, $filters);
        $consultants = User::whereIn('role', ['admin', 'superadmin'])
            ->orWhere('email', 'like', '%@yonbustax.ca')
            ->get();

        return view('livewire.admin.user-manager', compact('users', 'consultants'))->layout('layouts.admin');
    }

    public function openModal($defaultRole = 'client')
    {
        $this->reset([
            'editId', 'first_name', 'last_name', 'email', 'phone', 
            'password', 'company_name', 'tax_number', 'address', 
            'city', 'province', 'postal_code', 'avatar'
        ]);
        $this->role = $defaultRole;
        $this->assigned_admin_id = auth()->id();
        $this->generatePassword();
        $this->showModal = true;
    }

    public function generatePassword()
    {
        $this->password = 'Yonbus' . rand(1000, 9999) . '!';
    }

    public function edit($id)
    {
        $user = $this->repo()->find($id);
        $this->editId            = $user->id;
        $this->first_name        = $user->first_name;
        $this->last_name         = $user->last_name;
        $this->email             = $user->email;
        $this->role              = $user->getRoleNames()->first() ?? 'client';
        $this->assigned_admin_id = $user->assigned_admin_id ?? $user->clientProfile?->assigned_admin_id ?? auth()->id();
        $this->phone             = $user->phone;
        $this->company_name      = $user->company_name ?? $user->clientProfile?->company_name ?? '';
        $this->tax_number        = $user->tax_identification_number ?? $user->clientProfile?->tax_number ?? '';
        $this->address           = $user->address ?? $user->clientProfile?->address ?? '';
        $this->city              = $user->clientProfile?->city ?? '';
        $this->province          = $user->clientProfile?->province ?? '';
        $this->postal_code       = $user->clientProfile?->postal_code ?? '';
        $this->password          = '';
        $this->avatar            = null;
        $this->showModal         = true;
    }

    public function save()
    {
        $rules = [
            'first_name'        => 'required|string|max:255',
            'last_name'         => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email' . ($this->editId ? ",{$this->editId}" : ''),
            'role'              => 'required|in:admin,subadmin,accountant,client',
            'assigned_admin_id' => 'nullable|exists:users,id',
            'phone'             => 'nullable|string|max:20',
            'company_name'      => 'nullable|string|max:255',
            'tax_number'        => 'nullable|string|max:50',
            'address'           => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:100',
            'province'          => 'nullable|string|max:100',
            'postal_code'       => 'nullable|string|max:20',
            'avatar'            => 'nullable|image|max:5120',
        ];

        if (!$this->editId) {
            $rules['password'] = 'required|min:6';
        } else {
            $rules['password'] = 'nullable|min:6';
        }

        $this->validate($rules);

        $data = [
            'first_name'                => $this->first_name,
            'last_name'                 => $this->last_name,
            'email'                     => $this->email,
            'role'                      => $this->role,
            'assigned_admin_id'         => $this->assigned_admin_id ?: auth()->id(),
            'phone'                     => $this->phone,
            'company_name'              => $this->company_name,
            'tax_identification_number' => $this->tax_number,
            'address'                   => $this->address,
            'city'                      => $this->city,
            'province'                  => $this->province,
            'postal_code'               => $this->postal_code,
            'is_active'                 => true,
            'email_verified_at'         => now(),
        ];

        $rawPassword = $this->password;
        if (!empty($this->password)) {
            $data['password'] = $this->password;
        }

        if ($this->avatar) {
            $data['avatar'] = $this->avatar->store('avatars', 'public');
        }

        if ($this->editId) {
            $user = $this->repo()->update($this->editId, $data);
            AuditService::log('user.updated', "Updated user: {$user->name} ({$this->role})", 'User', $user->id);
            session()->flash('message', "Account for {$user->name} updated successfully.");
        } else {
            $user = $this->repo()->create($data);
            AuditService::log('user.created', "Created user: {$user->name} ({$this->role})", 'User', $user->id);
            
            $this->lastCreatedCredentials = [
                'name'     => $user->name,
                'email'    => $user->email,
                'password' => $rawPassword,
                'role'     => $this->role,
            ];

            session()->flash('message', "{$this->role} account for '{$user->name}' ({$user->email}) created successfully! They can immediately sign in with password: {$rawPassword}");
        }

        $this->showModal = false;
        $this->reset('avatar');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active' => !$user->is_active]);
        AuditService::log('user.status_toggled', "Toggled status for: {$user->name}", 'User', $user->id);
    }

    public function confirmDelete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return;
        }

        if ($user->id === auth()->id()) {
            session()->flash('error', 'You cannot delete your own logged-in account.');
            return;
        }

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
            $user = User::find($this->confirmingDeleteId);
            if (!$user) {
                $this->confirmingDeleteId = null;
                $this->showDeleteModal = false;
                return;
            }

            if ($user->id === auth()->id()) {
                session()->flash('error', 'You cannot delete your own logged-in account.');
                $this->confirmingDeleteId = null;
                $this->showDeleteModal = false;
                return;
            }

            $userName = $user->name ?: $user->email;
            $userEmail = $user->email;
            $userRole = ucfirst($user->getRoleNames()->first() ?? $user->role ?? 'User');

            // Log administrative action
            AuditService::log('user.deleted', "Deleted {$userRole} account: {$userName} ({$userEmail})", 'User', $user->id);

            // Clean up avatar if stored
            if ($user->avatar && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->avatar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->avatar);
            }

            // Delete user via repository
            $this->repo()->delete($user->id);

            session()->flash('message', "{$userRole} account '{$userName}' ({$userEmail}) deleted successfully.");
        }
        $this->confirmingDeleteId = null;
        $this->showDeleteModal = false;
    }

    public function delete($id)
    {
        $this->confirmDelete($id);
    }
}
