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
        $this->settings = Setting::all()->keyBy('key')->map(fn($s) => $s->value)->toArray();
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
        session()->flash('message', 'Settings saved successfully.');
    }
}
