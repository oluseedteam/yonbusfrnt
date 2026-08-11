<?php

namespace App\Livewire\Admin;

use App\Repositories\AppointmentRepository;
use App\Services\AppointmentService;
use App\Models\Appointment;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AppointmentManager extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'all';
    public $showVideoCallModal = false;
    public $activeRoomName = null;

    // Schedule & Confirm Modal
    public $showScheduleModal = false;
    public $scheduleId = null;
    public $scheduleDate = '';
    public $scheduleTime = '';
    public $scheduleDuration = 60;
    public $scheduleAccountantId = '';

    protected $rules = [
        'scheduleDate'        => 'required|date',
        'scheduleTime'        => 'required',
        'scheduleDuration'    => 'required|integer|min:15|max:480',
        'scheduleAccountantId'=> 'nullable|exists:users,id',
    ];

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
        $staff = User::whereIn('role', ['admin', 'superadmin', 'subadmin', 'accountant'])
            ->orWhereHas('roles', function ($q) {
                $q->whereIn('name', ['admin', 'superadmin', 'subadmin', 'super-admin', 'accountant']);
            })
            ->get();

        return view('livewire.admin.appointment-manager', compact('appointments', 'staff'))
            ->layout('layouts.admin');
    }

    // ── Schedule & Confirm ──────────────────────────────────────────────────
    public function openSchedule($id)
    {
        $appt = Appointment::findOrFail($id);
        $this->scheduleId = $appt->id;
        $this->scheduleDate = $appt->date ? $appt->date->format('Y-m-d') : now()->addDay()->format('Y-m-d');
        $this->scheduleTime = $appt->time ?: '10:00';
        $this->scheduleDuration = $appt->duration ?? 60;
        $this->scheduleAccountantId = $appt->accountant_id ?? '';
        $this->showScheduleModal = true;
    }

    public function scheduleAndConfirm()
    {
        $this->validate();

        $appt = Appointment::findOrFail($this->scheduleId);
        $appt->update([
            'date'          => $this->scheduleDate,
            'time'          => $this->scheduleTime,
            'duration'      => $this->scheduleDuration,
            'accountant_id' => $this->scheduleAccountantId ?: null,
            'status'        => 'confirmed',
        ]);

        $this->showScheduleModal = false;
        $this->reset(['scheduleId', 'scheduleDate', 'scheduleTime', 'scheduleDuration', 'scheduleAccountantId']);
        session()->flash('message', 'Appointment scheduled and confirmed successfully.');
    }

    public function closeScheduleModal()
    {
        $this->showScheduleModal = false;
        $this->reset(['scheduleId', 'scheduleDate', 'scheduleTime', 'scheduleDuration', 'scheduleAccountantId']);
    }

    // ── Other actions ────────────────────────────────────────────────────────
    public function confirm($id)
    {
        $this->service()->confirm($id);
        session()->flash('message', 'Appointment confirmed successfully.');
    }

    public function startConsultation($appointmentId)
    {
        $appt = Appointment::findOrFail($appointmentId);
        $this->activeRoomName = 'yonbus-consultation-apt-' . $appt->id;
        $this->showVideoCallModal = true;
    }

    public function closeVideoCall()
    {
        $this->showVideoCallModal = false;
        $this->activeRoomName = null;
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
