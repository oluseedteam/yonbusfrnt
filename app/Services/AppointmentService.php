<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\AvailabilitySlot;
use App\Models\Holiday;
use App\Repositories\AppointmentRepository;
use App\Events\AppointmentBooked;
use App\Events\AppointmentConfirmed;
use App\Events\AppointmentCancelled;
use App\Events\AppointmentCompleted;
use Illuminate\Support\Carbon;

class AppointmentService
{
    public function __construct(protected AppointmentRepository $repository) {}

    /**
     * Book a new appointment with full business rule validation.
     */
    public function book(array $data): array
    {
        [$isValid, $message] = $this->validateSlot(
            $data['accountant_id'],
            $data['date'],
            $data['time']
        );

        if (!$isValid) {
            return ['success' => false, 'message' => $message];
        }

        $appointment = $this->repository->create($data);
        event(new AppointmentBooked($appointment));

        return ['success' => true, 'appointment' => $appointment];
    }

    /**
     * Validate a booking slot against all business rules.
     */
    public function validateSlot(?int $accountantId, string $date, string $time, ?int $duration = 45, ?int $excludeId = null): array
    {
        $carbonDate = Carbon::parse($date);

        // 1. Check past date
        if ($carbonDate->isPast() && !$carbonDate->isToday()) {
            return [false, 'The selected date is in the past. Please choose today or a future date.'];
        }

        // 2. Check Sunday closed
        if ($carbonDate->isSunday()) {
            return [false, 'Our consultation offices are closed on Sundays. Please choose Monday to Saturday.'];
        }

        // 3. Check holiday
        if (Holiday::where('date', $date)->exists()) {
            return [false, 'The selected date is a public holiday. Please choose another day.'];
        }

        // 4. Check accountant availability if custom slot configured
        if ($accountantId) {
            $dayOfWeek = strtolower($carbonDate->format('l'));
            $hasAnySlots = AvailabilitySlot::where('accountant_id', $accountantId)->exists();

            if ($hasAnySlots) {
                $available = AvailabilitySlot::where('accountant_id', $accountantId)
                    ->where('day_of_week', $dayOfWeek)
                    ->where('is_available', true)
                    ->where('start_time', '<=', $time)
                    ->where('end_time', '>', $time)
                    ->exists();

                if (!$available) {
                    return [false, 'The selected time is outside this consultant\'s working hours. Please choose another slot.'];
                }
            }
        }

        // 5. Check double booking and time range overlap
        if ($this->repository->isSlotTaken($accountantId, $date, $time, $duration, $excludeId)) {
            return [false, 'This time slot is already booked and unavailable. Please choose an available time.'];
        }

        return [true, 'Available'];
    }

    public function confirm(int $id): Appointment
    {
        $appointment = $this->repository->update($id, ['status' => 'confirmed']);
        event(new AppointmentConfirmed($appointment));
        return $appointment;
    }

    public function cancel(int $id, string $reason = ''): Appointment
    {
        $appointment = $this->repository->update($id, [
            'status' => 'cancelled',
            'notes'  => $reason ?: $this->repository->find($id)->notes,
        ]);
        event(new AppointmentCancelled($appointment));
        return $appointment;
    }

    public function complete(int $id): Appointment
    {
        $appointment = $this->repository->update($id, ['status' => 'completed']);
        event(new AppointmentCompleted($appointment));
        return $appointment;
    }

    public function reschedule(int $id, string $date, string $time, ?int $duration = 45): array
    {
        $appointment = $this->repository->find($id);
        [$isValid, $message] = $this->validateSlot(
            $appointment->accountant_id, $date, $time, $duration, $id
        );

        if (!$isValid) {
            return ['success' => false, 'message' => $message];
        }

        $updated = $this->repository->update($id, [
            'date'   => $date,
            'time'   => $time,
            'status' => 'rescheduled',
        ]);

        return ['success' => true, 'appointment' => $updated];
    }

    /**
     * Get all time slots with active availability/booked status for a date and consultant.
     */
    public function getAvailableSlots(?int $accountantId, string $date, int $durationMinutes = 45): array
    {
        $carbonDate = Carbon::parse($date);

        if ($carbonDate->isSunday() || Holiday::where('date', $date)->exists()) {
            return [];
        }

        $standardTimes = [
            '09:00:00' => '09:00 AM',
            '09:45:00' => '09:45 AM',
            '10:30:00' => '10:30 AM',
            '11:15:00' => '11:15 AM',
            '12:00:00' => '12:00 PM',
            '13:00:00' => '01:00 PM',
            '13:45:00' => '01:45 PM',
            '14:30:00' => '02:30 PM',
            '15:15:00' => '03:15 PM',
            '16:00:00' => '04:00 PM',
            '16:45:00' => '04:45 PM',
        ];

        // If Saturday, shorter hours
        if ($carbonDate->isSaturday()) {
            $standardTimes = [
                '10:00:00' => '10:00 AM',
                '11:00:00' => '11:00 AM',
                '12:00:00' => '12:00 PM',
                '13:00:00' => '01:00 PM',
                '14:00:00' => '02:00 PM',
            ];
        }

        $slots = [];

        foreach ($standardTimes as $timeVal => $label) {
            $isTaken = $this->repository->isSlotTaken($accountantId, $date, $timeVal, $durationMinutes);

            $slots[] = [
                'time'         => $timeVal,
                'time_short'   => substr($timeVal, 0, 5),
                'formatted'    => $label,
                'is_available' => !$isTaken,
                'status'       => $isTaken ? 'booked' : 'available',
                'reason'       => $isTaken ? 'Already Booked' : 'Available',
            ];
        }

        return $slots;
    }
}
