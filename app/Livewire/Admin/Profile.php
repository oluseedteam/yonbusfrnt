<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Services\AuditService;

class Profile extends Component
{
    use WithFileUploads;

    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $phone = '';
    public $avatar = null;

    // Password fields
    public $current_password = '';
    public $new_password = '';
    public $new_password_confirmation = '';

    public function mount()
    {
        $user = auth()->user();
        $this->first_name = $user->first_name;
        $this->last_name  = $user->last_name;
        $this->email      = $user->email;
        $this->phone      = $user->phone;
    }

    public function render()
    {
        return view('livewire.admin.profile', [
            'avatar' => $this->avatar,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
        ])->layout('layouts.admin');
    }

    public function saveProfile()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . auth()->id(),
            'phone'      => 'nullable|string|max:20',
            'avatar'     => 'nullable|image|max:5120',
        ]);

        $user = auth()->user();
        $updateData = [
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            'phone'      => $this->phone,
        ];

        if ($this->avatar) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $updateData['avatar'] = $this->avatar->store('avatars', 'public');
        }

        $user->update($updateData);
        $this->reset('avatar');

        AuditService::log('admin.profile_updated', 'Updated administrator profile information.', 'User', $user->id);
        session()->flash('profile_message', 'Profile details updated successfully.');
    }

    public function removeAvatar()
    {
        $user = auth()->user();
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }
        $user->update(['avatar' => null]);
        $this->reset('avatar');

        AuditService::log('admin.avatar_removed', 'Removed administrator profile photo.', 'User', $user->id);
        session()->flash('profile_message', 'Profile photo removed successfully.');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password'          => 'required|current_password',
            'new_password'              => 'required|string|min:8|different:current_password|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        AuditService::log('admin.password_changed', 'Changed administrator account password.', 'User', $user->id);
        session()->flash('password_message', 'Password updated successfully.');
    }
}
