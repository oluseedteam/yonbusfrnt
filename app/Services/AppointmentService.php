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
    public function validateSlot(int $accountantId, string $date, string $time, ?int $excludeId = null): array
    {
        // 1. Check holiday
        if (Holiday::where('date', $date)->exists()) {
            return [false, 'The selected date is a public holiday.'];
        }

        // 2. Check accountant availability
        $dayOfWeek = strtolower(Carbon::parse($date)->format('l'));
        $available = AvailabilitySlot::where('accountant_id', $accountantId)
            ->where('day_of_week', $dayOfWeek)
            ->where('is_available', true)
            ->where('start_time', '<=', $time)
            ->where('end_time', '>', $time)
            ->exists();

        if (!$available) {
            return [false, 'The selected accountant is not available at this time.'];
        }

        // 3. Check double booking
        if ($this->repository->isSlotTaken($accountantId, $date, $time, $excludeId)) {
            return [false, 'This time slot is already booked.'];
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

    public function reschedule(int $id, string $date, string $time): array
    {
        $appointment = $this->repository->find($id);
        [$isValid, $message] = $this->validateSlot(
            $appointment->accountant_id, $date, $time, $id
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
     * Get available time slots for an accountant on a given date.
     */
    public function getAvailableSlots(int $accountantId, string $date): array
    {
        if (Holiday::where('date', $date)->exists()) {
            return [];
        }

        $dayOfWeek = strtolower(Carbon::parse($date)->format('l'));
        $slot = AvailabilitySlot::where('accountant_id', $accountantId)
            ->where('day_of_week', $dayOfWeek)
            ->where('is_available', true)
            ->first();

        if (!$slot) return [];

        $bookedTimes = Appointment::where('accountant_id', $accountantId)
            ->where('date', $date)
            ->whereNotIn('status', ['cancelled'])
            ->pluck('time')
            ->map(fn($t) => substr($t, 0, 5))
            ->toArray();

        $slots = [];
        $current = Carbon::parse($slot->start_time);
        $end     = Carbon::parse($slot->end_time);

        while ($current < $end) {
            $timeStr = $current->format('H:i');
            if (!in_array($timeStr, $bookedTimes)) {
                $slots[] = $timeStr;
            }
            $current->addMinutes(30);
        }

        return $slots;
    }
}
