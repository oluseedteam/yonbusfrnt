<?php

namespace App\Livewire\Public;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use App\Services\AppointmentService;
use Livewire\Component;

class BookingSystem extends Component
{
    public $step = 1;

    // Form inputs
    public $service_id = '';
    public $accountant_id = '';
    public $appointment_date = '';
    public $appointment_time = '';
    public $first_name = '';
    public $last_name = '';
    public $client_email = '';
    public $client_phone = '';
    public $company_name = '';
    public $notes = '';

    public $bookingSuccess = false;
    public $confirmedAppointment = null;
    public $errorMessage = '';

    protected function appointmentService(): AppointmentService
    {
        return app(AppointmentService::class);
    }

    public function mount()
    {
        $this->appointment_date = now()->addDays(1)->format('Y-m-d');
        if (request()->has('service')) {
            $this->service_id = request()->get('service');
        }

        // Auto select first available accountant if any
        $accountant = User::role('accountant')->first();
        if ($accountant) {
            $this->accountant_id = $accountant->id;
        }
    }

    public function nextStep()
    {
        $this->errorMessage = '';

        if ($this->step === 1) {
            $this->validate([
                'service_id' => 'required|exists:services,id',
            ]);
        } elseif ($this->step === 2) {
            $this->validate([
                'appointment_date' => 'required|date|after_or_equal:today',
                'appointment_time' => 'required',
            ]);
        }
        $this->step++;
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function submitBooking()
    {
        $this->errorMessage = '';

        $this->validate([
            'service_id'       => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'client_email'     => 'required|email|max:255',
            'client_phone'     => 'required|string|max:50',
        ]);

        // 1. Find or create client user
        $user = User::where('email', $this->client_email)->first();
        if (!$user) {
            $user = User::create([
                'first_name' => $this->first_name,
                'last_name'  => $this->last_name,
                'email'      => $this->client_email,
                'password'   => \Hash::make(\Str::random(12)),
                'phone'      => $this->client_phone,
                'is_active'  => true,
            ]);
            $user->assignRole('client');
        }

        // 2. Resolve assigned accountant
        $accountantId = $this->accountant_id;
        if (!$accountantId) {
            $firstAccountant = User::role('accountant')->first();
            $accountantId = $firstAccountant ? $firstAccountant->id : 1;
        }

        // 3. Book via AppointmentService
        $bookingData = [
            'client_id'     => $user->id,
            'accountant_id' => $accountantId,
            'service_id'    => $this->service_id,
            'date'          => $this->appointment_date,
            'time'          => $this->appointment_time,
            'status'        => 'pending',
            'notes'         => $this->notes,
        ];

        $result = $this->appointmentService()->book($bookingData);

        if (!$result['success']) {
            $this->errorMessage = $result['message'];
            return;
        }

        $this->confirmedAppointment = $result['appointment'];
        $this->bookingSuccess = true;
        $this->step = 4;
    }

    public function render()
    {
        $services    = Service::where('is_active', true)->get();
        $accountants = User::role('accountant')->get();

        // Calculate available time slots
        $timeSlots = [];
        if ($this->accountant_id && $this->appointment_date) {
            $slots = $this->appointmentService()->getAvailableSlots((int)$this->accountant_id, $this->appointment_date);
            foreach ($slots as $slot) {
                $timeSlots[$slot . ':00'] = date('g:i A', strtotime($slot));
            }
        }

        // Fallback default slots if no specific availability slot configured yet
        if (empty($timeSlots)) {
            $timeSlots = [
                '09:00:00' => '09:00 AM',
                '10:00:00' => '10:00 AM',
                '11:00:00' => '11:00 AM',
                '13:00:00' => '01:00 PM',
                '14:00:00' => '02:00 PM',
                '15:00:00' => '03:00 PM',
                '16:00:00' => '04:00 PM',
            ];
        }

        return view('livewire.public.booking-system', [
            'services'    => $services,
            'accountants' => $accountants,
            'timeSlots'   => $timeSlots,
        ]);
    }
}
