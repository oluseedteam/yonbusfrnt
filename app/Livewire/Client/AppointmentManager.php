<?php

namespace App\Livewire\Client;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class AppointmentManager extends Component
{
    use WithPagination;

    public $showModal = false;
    public $showVideoCallModal = false;
    public $activeRoomName = null;
    public $editId = null;
    public $service_id = '';
    public $accountant_id = '';
    public $date = '';
    public $time = '';
    public $notes = '';
    public $filter = 'all';
    public $errorMessage = '';

    protected function appointmentService(): \App\Services\AppointmentService
    {
        return app(\App\Services\AppointmentService::class);
    }

    protected $rules = [
        'service_id'    => 'required|exists:services,id',
        'accountant_id' => 'nullable|exists:users,id',
        'date'          => 'required|date|after_or_equal:today',
        'time'          => 'required',
        'notes'         => 'nullable|string|max:500',
    ];

    public function selectTimeSlot(string $timeVal, bool $isAvailable)
    {
        if (!$isAvailable) {
            $this->errorMessage = 'This time slot is already booked. Please choose another time.';
            return;
        }
        $this->errorMessage = '';
        $this->time = $timeVal;
    }

    public function render()
    {
        $query = Appointment::where('client_id', auth()->id())->with(['service', 'accountant']);

        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }

        $appointments = $query->orderByDesc('date')->paginate(10);
        
        $services = Service::where('is_active', true)->get();
        if ($services->isEmpty()) {
            $services = Service::all();
        }

        $consultants = \App\Models\User::whereIn('role', ['admin', 'superadmin', 'accountant'])
            ->orWhere('email', 'like', '%@yonbustax.ca')
            ->get();

        // Calculate available time slots for the modal date & consultant
        $timeSlots = [];
        if ($this->date) {
            $timeSlots = $this->appointmentService()->getAvailableSlots(
                $this->accountant_id ? (int)$this->accountant_id : (auth()->user()->assigned_admin_id ?? null),
                $this->date,
                45
            );
        }

        return view('livewire.client.appointment-manager', compact('appointments', 'services', 'consultants', 'timeSlots'))
            ->layout('layouts.client');
    }

    public function openModal()
    {
        $this->reset(['editId', 'service_id', 'date', 'time', 'notes', 'errorMessage']);
        $this->accountant_id = auth()->user()->assigned_admin_id ?? '';
        $this->date = now()->addDays(1)->format('Y-m-d');
        $this->time = '09:00:00';
        $this->showModal = true;
    }

    public function edit($id)
    {
        $appt = Appointment::where('id', $id)->where('client_id', auth()->id())->firstOrFail();
        $this->editId = $appt->id;
        $this->service_id = $appt->service_id;
        $this->accountant_id = $appt->accountant_id;
        $this->date = Carbon::parse($appt->date)->format('Y-m-d');
        $this->time = strlen($appt->time) === 5 ? $appt->time . ':00' : $appt->time;
        $this->notes = $appt->notes;
        $this->errorMessage = '';
        $this->showModal = true;
    }

    public function startConsultation($appointmentId)
    {
        $appt = Appointment::where('id', $appointmentId)
            ->where('client_id', auth()->id())
            ->firstOrFail();

        $this->activeRoomName = 'yonbus-consultation-apt-' . $appt->id;
        $this->showVideoCallModal = true;
    }

    public function closeVideoCall()
    {
        $this->showVideoCallModal = false;
        $this->activeRoomName = null;
    }

    public function save()
    {
        $this->errorMessage = '';
        $this->validate();

        $accountantId = $this->accountant_id ?: (auth()->user()->assigned_admin_id ?: null);

        // Validate time slot availability
        [$isValid, $msg] = $this->appointmentService()->validateSlot(
            $accountantId ? (int)$accountantId : null,
            $this->date,
            $this->time,
            45,
            $this->editId
        );

        if (!$isValid) {
            $this->errorMessage = $msg;
            return;
        }

        if ($this->editId) {
            $appt = Appointment::where('id', $this->editId)->where('client_id', auth()->id())->firstOrFail();
            $appt->update([
                'service_id'    => $this->service_id,
                'accountant_id' => $accountantId,
                'date'          => $this->date,
                'time'          => $this->time,
                'notes'         => $this->notes,
                'status'        => 'rescheduled',
            ]);
            ActivityLog::log('appointment.rescheduled', 'Appointment rescheduled.', $appt);
            session()->flash('message', 'Appointment rescheduled successfully.');
        } else {
            $appt = Appointment::create([
                'client_id'     => auth()->id(),
                'accountant_id' => $accountantId,
                'service_id'    => $this->service_id,
                'date'          => $this->date,
                'time'          => $this->time,
                'duration'      => 45,
                'notes'         => $this->notes,
                'status'        => 'pending',
            ]);
            ActivityLog::log('appointment.created', 'Appointment booked successfully.', $appt);
            session()->flash('message', 'Appointment booked successfully! Your dedicated consultant has received the schedule.');
        }

        $this->showModal = false;
        $this->reset(['editId', 'service_id', 'date', 'time', 'notes', 'errorMessage']);
    }

    public function cancel($id)
    {
        $appt = Appointment::where('id', $id)->where('client_id', auth()->id())->firstOrFail();
        $appt->update(['status' => 'cancelled']);
        ActivityLog::log('appointment.cancelled', 'Appointment cancelled.', $appt);
        session()->flash('message', 'Appointment cancelled.');
    }
}
