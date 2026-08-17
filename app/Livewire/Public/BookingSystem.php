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

        // Auto select first partner or consultant
        $consultant = User::where('email', 'olubukunola@yonbustax.ca')->first() ?? User::roleSafe('accountant')->first();
        if ($consultant) {
            $this->accountant_id = $consultant->id;
        }
    }

    public function selectTimeSlot(string $time, bool $isAvailable)
    {
        if (!$isAvailable) {
            $this->errorMessage = 'This time slot is already booked and unavailable. Please select another slot.';
            return;
        }
        $this->errorMessage = '';
        $this->appointment_time = $time;
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

            // Validate slot is actually available
            [$isValid, $msg] = $this->appointmentService()->validateSlot(
                $this->accountant_id ? (int)$this->accountant_id : null,
                $this->appointment_date,
                $this->appointment_time,
                45
            );

            if (!$isValid) {
                $this->errorMessage = $msg;
                return;
            }
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

        // Validate slot again
        [$isValid, $msg] = $this->appointmentService()->validateSlot(
            $this->accountant_id ? (int)$this->accountant_id : null,
            $this->appointment_date,
            $this->appointment_time,
            45
        );

        if (!$isValid) {
            $this->errorMessage = $msg;
            $this->step = 2;
            return;
        }

        // 1. Find or create client user
        $user = User::where('email', $this->client_email)->first();
        if (!$user) {
            $user = User::create([
                'first_name'        => $this->first_name,
                'last_name'         => $this->last_name,
                'email'             => $this->client_email,
                'password'          => \Hash::make(\Str::random(12)),
                'phone'             => $this->client_phone,
                'assigned_admin_id' => $this->accountant_id ?: null,
                'is_active'         => true,
                'email_verified_at' => now(),
            ]);
            $user->safeAssignRole('client');

            \App\Models\Client::create([
                'user_id'           => $user->id,
                'assigned_admin_id' => $this->accountant_id ?: null,
                'phone'             => $this->client_phone,
                'company_name'      => $this->company_name,
            ]);
        }

        // 2. Resolve assigned accountant
        $accountantId = $this->accountant_id;
        if (!$accountantId) {
            $firstAccountant = User::whereIn('role', ['admin', 'accountant'])->first();
            $accountantId = $firstAccountant ? $firstAccountant->id : 1;
        }

        // 3. Book via AppointmentService
        $bookingData = [
            'client_id'     => $user->id,
            'accountant_id' => $accountantId,
            'service_id'    => $this->service_id,
            'date'          => $this->appointment_date,
            'time'          => $this->appointment_time,
            'duration'      => 45,
            'status'        => 'pending',
            'notes'         => $this->notes,
        ];

        $result = $this->appointmentService()->book($bookingData);

        if (!$result['success']) {
            $this->errorMessage = $result['message'];
            $this->step = 2;
            return;
        }

        $this->confirmedAppointment = $result['appointment'];
        $this->bookingSuccess = true;
        $this->step = 4;
    }

    public function render()
    {
        $services    = Service::where('is_active', true)->get();
        $accountants = User::whereIn('role', ['admin', 'superadmin', 'accountant'])
            ->orWhere('email', 'like', '%@yonbustax.ca')
            ->get();

        // Calculate available and booked time slots
        $timeSlots = [];
        if ($this->appointment_date) {
            $timeSlots = $this->appointmentService()->getAvailableSlots(
                $this->accountant_id ? (int)$this->accountant_id : null,
                $this->appointment_date,
                45
            );
        }

        return view('livewire.public.booking-system', [
            'services'    => $services,
            'accountants' => $accountants,
            'timeSlots'   => $timeSlots,
        ]);
    }
}
