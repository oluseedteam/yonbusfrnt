<?php

namespace App\Livewire\Client;

use Livewire\Component;

use Illuminate\Support\Facades\Hash;
use App\Models\ActivityLog;

class Settings extends Component
{
    public $email_notifications = true;
    public $sms_reminders = true;
    
    public $current_password = '';
    public $new_password = '';
    public $new_password_confirmation = '';

    public function mount()
    {
        $user = auth()->user();
        $this->email_notifications = $user->email_notifications ?? true;
        $this->sms_reminders = $user->sms_reminders ?? true;
    }

    public function updatePreferences()
    {
        auth()->user()->update([
            'email_notifications' => $this->email_notifications,
            'sms_reminders'       => $this->sms_reminders,
        ]);
        ActivityLog::log('settings.updated', 'Updated notification preferences.');
        session()->flash('message', 'Notification preferences saved!');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'new_password'     => 'required|string|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        ActivityLog::log('password.updated', 'Changed account password.');
        session()->flash('message', 'Password updated successfully!');
    }

    public function render()
    {
        return view('livewire.client.settings')->layout('layouts.client');
    }
}
