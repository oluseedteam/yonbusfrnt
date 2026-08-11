<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ActivityLog;

class Profile extends Component
{
    use WithFileUploads;

    public $name, $email, $phone, $company_name, $tax_identification_number, $address;
    public $avatar;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->company_name = $user->company_name;
        $this->tax_identification_number = $user->tax_identification_number;
        $this->address = $user->address;
    }

    public function render()
    {
        return view('livewire.client.profile')->layout('layouts.client');
    }

    public function save()
    {
        $this->validate([
            'name'                       => 'required|string|max:255',
            'email'                      => 'required|email|unique:users,email,' . auth()->id(),
            'phone'                      => 'nullable|string|max:20',
            'company_name'               => 'nullable|string|max:255',
            'tax_identification_number'  => 'nullable|string|max:50',
            'address'                    => 'nullable|string|max:500',
            'avatar'                     => 'nullable|image|max:5120',
        ]);

        $user = auth()->user();
        $updateData = [
            'name'                      => $this->name,
            'email'                     => $this->email,
            'phone'                     => $this->phone,
            'company_name'              => $this->company_name,
            'tax_identification_number' => $this->tax_identification_number,
            'address'                   => $this->address,
        ];

        if ($this->avatar) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $this->avatar->store('avatars', 'public');
            $updateData['avatar'] = $avatarPath;
        }

        $user->update($updateData);
        $this->reset('avatar');

        ActivityLog::log('profile.updated', 'Profile updated successfully.');
        session()->flash('message', 'Profile updated successfully!');
    }

    public function removeAvatar()
    {
        $user = auth()->user();
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }
        $user->update(['avatar' => null]);
        $this->reset('avatar');
        ActivityLog::log('profile.avatar_removed', 'Profile picture removed.');
        session()->flash('message', 'Profile picture removed successfully.');
    }
}

