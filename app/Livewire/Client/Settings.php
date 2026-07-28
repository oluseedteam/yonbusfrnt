<?php

namespace App\Livewire\Client;

use Livewire\Component;

class Settings extends Component
{
    public $tab = 'account';

    public function render()
    {
        return view('livewire.client.settings')->layout('layouts.client');
    }
}
