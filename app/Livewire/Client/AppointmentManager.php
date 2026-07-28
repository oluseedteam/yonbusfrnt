<?php

namespace App\Livewire\Client;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\ActivityLog;
use Livewire\Component;
use Illuminate\Support\Carbon;

class AppointmentManager extends Component
{
    public $showModal = false;
    public $editId = null;
    public $service_id = '';
    public $date = '';
    public $time = '';
    public $notes = '';
    public $filter = 'all';

    protected $rules = [
        'service_id' => 'required|exists:services,id',
        'date'       => 'required|date|after_or_equal:today',
        'time'       => 'required',
        'notes'      => 'nullable|string|max:500',
    ];

    public function render()
    {
        $query = Appointment::where('client_id', auth()->id())->with(['service', 'accountant']);

        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }

        $appointments = $query->orderByDesc('date')->paginate(10);
        $services = Service::where('is_active', true)->get();

        return view('livewire.client.appointment-manager', compact('appointments', 'services'))
            ->layout('layouts.client');
    }

    public function openModal()
    {
        $this->reset(['editId', 'service_id', 'date', 'time', 'notes']);
        $this->showModal = true;
    }

    public function edit($id)
    {
        $appt = Appointment::findOrFail($id);
        $this->editId = $appt->id;
        $this->service_id = $appt->service_id;
        $this->date = Carbon::parse($appt->date)->format('Y-m-d');
        $this->time = $appt->time;
        $this->notes = $appt->notes;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->editId) {
            $appt = Appointment::findOrFail($this->editId);
            $appt->update([
                'service_id' => $this->service_id,
                'date'       => $this->date,
                'time'       => $this->time,
                'notes'      => $this->notes,
                'status'     => 'rescheduled',
            ]);
            ActivityLog::log('appointment.rescheduled', 'Appointment rescheduled.', $appt);
            session()->flash('message', 'Appointment rescheduled successfully.');
        } else {
            $appt = Appointment::create([
                'client_id'  => auth()->id(),
                'service_id' => $this->service_id,
                'date'       => $this->date,
                'time'       => $this->time,
                'notes'      => $this->notes,
                'status'     => 'pending',
            ]);
            ActivityLog::log('appointment.created', 'Appointment booked.', $appt);
            session()->flash('message', 'Appointment booked successfully!');
        }

        $this->showModal = false;
        $this->reset(['editId', 'service_id', 'date', 'time', 'notes']);
    }

    public function cancel($id)
    {
        $appt = Appointment::where('id', $id)->where('client_id', auth()->id())->firstOrFail();
        $appt->update(['status' => 'cancelled']);
        ActivityLog::log('appointment.cancelled', 'Appointment cancelled.', $appt);
        session()->flash('message', 'Appointment cancelled.');
    }
}
