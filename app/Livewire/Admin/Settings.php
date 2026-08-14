<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class Settings extends Component
{
    public $tab = 'general';
    public $settings = [];

    public function mount()
    {
        $dbSettings = Setting::all()->keyBy('key')->map(fn($s) => $s->value)->toArray();

        $defaults = [
            'company_name'  => 'YONBUS Tax & Accounting Services Inc.',
            'company_email' => 'info@yonbustax.ca',
            'company_phone' => '+1 (555) 019-2831',
            'company_ein'   => '12-3456789',
            'tax_rate'      => '7.5',
            'currency'      => 'USD',
        ];

        $this->settings = array_merge($defaults, $dbSettings);
    }

    public function render()
    {
        return view('livewire.admin.settings')->layout('layouts.admin');
    }

    public function save()
    {
        foreach ($this->settings as $key => $value) {
            Setting::set($key, $value);
        }
        \App\Services\AuditService::log('system.settings_updated', 'Updated system configuration settings.');
        session()->flash('message', 'System settings saved successfully.');
    }
}
