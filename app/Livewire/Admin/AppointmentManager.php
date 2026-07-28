<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use Livewire\Component;

class AppointmentManager extends Component
{
    public $search = '';
    public $statusFilter = 'all';

    public function render()
    {
        $query = Appointment::with(['client', 'accountant', 'service']);
        if ($this->statusFilter !== 'all') $query->where('status', $this->statusFilter);
        if ($this->search) {
            $query->whereHas('client', fn($q) => $q->where('name', 'like', "%{$this->search}%"));
        }
        $appointments = $query->orderByDesc('date')->paginate(15);
        return view('livewire.admin.appointment-manager', compact('appointments'))->layout('layouts.admin');
    }
}
