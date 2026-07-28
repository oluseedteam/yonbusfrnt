<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ActivityLog;

class Profile extends Component
{
    public $name, $email, $phone, $company_name, $tax_identification_number, $address;

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
        ]);

        auth()->user()->update([
            'name'                      => $this->name,
            'email'                     => $this->email,
            'phone'                     => $this->phone,
            'company_name'              => $this->company_name,
            'tax_identification_number' => $this->tax_identification_number,
            'address'                   => $this->address,
        ]);

        ActivityLog::log('profile.updated', 'Profile updated.');
        session()->flash('message', 'Profile updated successfully!');
    }
}
