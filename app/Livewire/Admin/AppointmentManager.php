<?php

namespace App\Livewire\Admin;

use App\Repositories\AppointmentRepository;
use App\Services\AppointmentService;
use Livewire\Component;
use Livewire\WithPagination;

class AppointmentManager extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'all';

    protected function repo(): AppointmentRepository
    {
        return app(AppointmentRepository::class);
    }

    protected function service(): AppointmentService
    {
        return app(AppointmentService::class);
    }

    public function render()
    {
        $filters = [];
        if ($this->statusFilter !== 'all') {
            $filters['status'] = $this->statusFilter;
        }

        $appointments = $this->repo()->paginate(15, $filters);
        return view('livewire.admin.appointment-manager', compact('appointments'))->layout('layouts.admin');
    }

    public function confirm($id)
    {
        $this->service()->confirm($id);
        session()->flash('message', 'Appointment confirmed successfully.');
    }

    public function cancel($id)
    {
        $this->service()->cancel($id, 'Cancelled by admin');
        session()->flash('message', 'Appointment cancelled.');
    }

    public function complete($id)
    {
        $this->service()->complete($id);
        session()->flash('message', 'Appointment marked as completed.');
    }
}
