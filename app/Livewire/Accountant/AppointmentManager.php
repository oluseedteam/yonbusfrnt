<?php

namespace App\Livewire\Accountant;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Service;
use Livewire\Component;

class AppointmentManager extends Component
{
    public $search = '';
    public $statusFilter = 'all';
    public $showModal = false;
    public $editId = null;
    public $status = 'confirmed';

    public function render()
    {
        $query = Appointment::with(['client', 'service'])
            ->where('accountant_id', auth()->id());

        if ($this->statusFilter !== 'all') $query->where('status', $this->statusFilter);
        if ($this->search) {
            $query->whereHas('client', fn($q) => $q->where('name', 'like', "%{$this->search}%"));
        }

        $appointments = $query->orderByDesc('date')->paginate(10);
        return view('livewire.accountant.appointment-manager', compact('appointments'))
            ->layout('layouts.accountant');
    }

    public function updateStatus($id, $status)
    {
        Appointment::where('id', $id)->where('accountant_id', auth()->id())->update(['status' => $status]);
        session()->flash('message', 'Appointment updated.');
    }
}
