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
        if ($services->isEmpty()) {
            $services = Service::all();
            if ($services->isEmpty()) {
                Service::create(['name' => 'Personal Tax Preparation (T1)', 'description' => 'Comprehensive personal income tax return filing.', 'price' => 150.00, 'duration' => 45, 'is_active' => true]);
                Service::create(['name' => 'Corporate Tax Filing (T2)', 'description' => 'Corporate tax return and business financial statements.', 'price' => 500.00, 'duration' => 60, 'is_active' => true]);
                Service::create(['name' => 'Bookkeeping & Accounting Consultation', 'description' => 'Monthly bookkeeping and advisory session.', 'price' => 100.00, 'duration' => 30, 'is_active' => true]);
                Service::create(['name' => 'CRA Audit & HST/GST Consultation', 'description' => 'CRA review representation and sales tax support.', 'price' => 200.00, 'duration' => 60, 'is_active' => true]);
                $services = Service::where('is_active', true)->get();
            }
        }

        return view('livewire.client.appointment-manager', compact('appointments', 'services'))
            ->layout('layouts.client');
    }

    public function openModal()
    {
        $this->reset(['editId', 'service_id', 'date', 'time', 'notes']);
        $this->date = date('Y-m-d');
        $this->time = '10:00';
        $this->showModal = true;
    }

    public function edit($id)
    {
        $appt = Appointment::where('id', $id)->where('client_id', auth()->id())->firstOrFail();
        $this->editId = $appt->id;
        $this->service_id = $appt->service_id;
        $this->date = Carbon::parse($appt->date)->format('Y-m-d');
        $this->time = $appt->time;
        $this->notes = $appt->notes;
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
        $this->validate();

        if ($this->editId) {
            $appt = Appointment::where('id', $this->editId)->where('client_id', auth()->id())->firstOrFail();
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
            ActivityLog::log('appointment.created', 'Appointment booked successfully.', $appt);
            session()->flash('message', 'Appointment booked successfully! Our team will confirm your consultation.');
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
