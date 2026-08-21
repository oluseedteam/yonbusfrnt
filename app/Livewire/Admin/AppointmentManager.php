<?php

namespace App\Livewire\Admin;

use App\Repositories\AppointmentRepository;
use App\Services\AppointmentService;
use App\Models\Appointment;
use App\Models\User;
use App\Notifications\AppointmentReminderNotification;
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

    // Edit / Reschedule Modal
    public $showEditModal = false;
    public $editId = null;
    public $editClientName = '';
    public $editServiceName = '';
    public $editDate = '';
    public $editTime = '';
    public $editDuration = 60;
    public $editAccountantId = '';
    public $editStatus = 'confirmed';
    public $editNotes = '';

    // Reminder Modal
    public $showReminderModal = false;
    public $reminderId = null;
    public $reminderClientName = '';
    public $reminderClientEmail = '';
    public $reminderCustomMessage = '';

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

    // ── Edit & Update Booking Time / Details ────────────────────────────────
    public function openEditModal($id)
    {
        $appt = Appointment::with(['client', 'service', 'accountant'])->findOrFail($id);
        $this->editId = $appt->id;
        $this->editClientName = $appt->client?->name ?? 'Guest Client';
        $this->editServiceName = $appt->service?->name ?? 'Consultation';
        $this->editDate = $appt->date ? $appt->date->format('Y-m-d') : date('Y-m-d');
        $this->editTime = $appt->time ? substr($appt->time, 0, 5) : '10:00';
        $this->editDuration = $appt->duration ?? 60;
        $this->editAccountantId = $appt->accountant_id ?? '';
        $this->editStatus = $appt->status ?? 'confirmed';
        $this->editNotes = $appt->notes ?? '';
        $this->showEditModal = true;
    }

    public function saveEditAppointment()
    {
        $this->validate([
            'editDate'         => 'required|date',
            'editTime'         => 'required',
            'editDuration'     => 'required|integer|min:15|max:480',
            'editAccountantId' => 'nullable|exists:users,id',
            'editStatus'       => 'required|in:pending,confirmed,completed,cancelled,rescheduled',
            'editNotes'        => 'nullable|string|max:1000',
        ]);

        $appt = Appointment::findOrFail($this->editId);
        $appt->update([
            'date'          => $this->editDate,
            'time'          => $this->editTime,
            'duration'      => $this->editDuration,
            'accountant_id' => $this->editAccountantId ?: null,
            'status'        => $this->editStatus,
            'notes'         => $this->editNotes,
        ]);

        $this->showEditModal = false;
        $this->reset(['editId', 'editClientName', 'editServiceName', 'editDate', 'editTime', 'editDuration', 'editAccountantId', 'editStatus', 'editNotes']);
        session()->flash('message', 'Booking time and details updated successfully for ' . ($appt->client?->name ?? 'client') . '.');
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->reset(['editId', 'editClientName', 'editServiceName', 'editDate', 'editTime', 'editDuration', 'editAccountantId', 'editStatus', 'editNotes']);
    }

    // ── Send Reminder to Client ──────────────────────────────────────────────
    public function openReminderModal($id)
    {
        $appt = Appointment::with(['client', 'service', 'accountant'])->findOrFail($id);
        $this->reminderId = $appt->id;
        $this->reminderClientName = $appt->client?->name ?? 'Valued Client';
        $this->reminderClientEmail = $appt->client?->email ?? 'No email on file';
        $this->reminderCustomMessage = '';
        $this->showReminderModal = true;
    }

    public function sendReminder()
    {
        $appt = Appointment::with(['client', 'service', 'accountant'])->findOrFail($this->reminderId);

        if ($appt->client) {
            $appt->client->notify(new AppointmentReminderNotification($appt, $this->reminderCustomMessage));
        }

        $this->showReminderModal = false;
        $this->reset(['reminderId', 'reminderClientName', 'reminderClientEmail', 'reminderCustomMessage']);
        session()->flash('message', 'Appointment reminder notification and email sent successfully to ' . ($appt->client?->name ?? 'client') . '.');
    }

    public function sendQuickReminder($id)
    {
        $appt = Appointment::with(['client', 'service', 'accountant'])->findOrFail($id);

        if ($appt->client) {
            $appt->client->notify(new AppointmentReminderNotification($appt));
        }

        session()->flash('message', 'Quick appointment reminder sent to ' . ($appt->client?->name ?? 'client') . ' (' . ($appt->client?->email ?? '') . ').');
    }

    public function closeReminderModal()
    {
        $this->showReminderModal = false;
        $this->reset(['reminderId', 'reminderClientName', 'reminderClientEmail', 'reminderCustomMessage']);
    }

    // ── Schedule & Confirm ──────────────────────────────────────────────────
    public function openSchedule($id)
    {
        $appt = Appointment::findOrFail($id);
        $this->scheduleId = $appt->id;
        $this->scheduleDate = $appt->date ? $appt->date->format('Y-m-d') : now()->addDay()->format('Y-m-d');
        $this->scheduleTime = $appt->time ? substr($appt->time, 0, 5) : '10:00';
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
