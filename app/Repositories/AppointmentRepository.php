<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use App\Models\Appointment;

class AppointmentRepository implements RepositoryInterface
{
    public function all(array $filters = [])
    {
        $query = Appointment::with(['client', 'accountant', 'service']);

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['client_id'])) {
            $query->where('client_id', $filters['client_id']);
        }
        if (!empty($filters['accountant_id'])) {
            $query->where('accountant_id', $filters['accountant_id']);
        }
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('appointment_number', 'like', "%{$search}%")
                  ->orWhere('notes', 'like', "%{$search}%")
                  ->orWhereHas('client', function ($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%")
                         ->orWhere('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%");
                  })
                  ->orWhereHas('service', function ($sq) use ($search) {
                      $sq->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('accountant', function ($aq) use ($search) {
                      $aq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if (!empty($filters['date_from'])) {
            $query->where('date', '>=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $query->where('date', '<=', $filters['date_to']);
        }

        return $query->orderByDesc('created_at');
    }

    public function find(int $id)
    {
        return Appointment::with(['client', 'accountant', 'service'])->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['appointment_number'] = $this->generateNumber();
        return Appointment::create($data);
    }

    public function update(int $id, array $data)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($data);
        return $appointment->fresh(['client', 'accountant', 'service']);
    }

    public function delete(int $id)
    {
        return Appointment::findOrFail($id)->delete();
    }

    public function paginate(int $perPage = 15, array $filters = [])
    {
        return $this->all($filters)->paginate($perPage);
    }

    public function isSlotTaken(?int $accountantId, string $date, string $time, ?int $duration = 45, ?int $excludeId = null): bool
    {
        $timeNorm = strlen($time) === 5 ? $time . ':00' : $time;
        $dateStr = \Illuminate\Support\Carbon::parse($date)->format('Y-m-d');
        
        $slotStart = \Illuminate\Support\Carbon::parse("$dateStr $timeNorm");
        $slotDuration = $duration ?: 45;
        $slotEnd = (clone $slotStart)->addMinutes($slotDuration);

        $query = Appointment::whereDate('date', $dateStr)
            ->whereNotIn('status', ['cancelled']);

        if ($accountantId) {
            $query->where('accountant_id', $accountantId);
        }

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $existingAppointments = $query->get();

        foreach ($existingAppointments as $appt) {
            $appTime = strlen($appt->time) === 5 ? $appt->time . ':00' : $appt->time;
            $appDate = $appt->date instanceof \DateTimeInterface ? $appt->date->format('Y-m-d') : substr((string)$appt->date, 0, 10);
            
            $apptStart = \Illuminate\Support\Carbon::parse("$appDate $appTime");
            $apptDuration = $appt->duration ?: 45;
            $apptEnd = (clone $apptStart)->addMinutes($apptDuration);

            // Check if intervals overlap: [slotStart, slotEnd) overlaps [apptStart, apptEnd)
            if ($slotStart < $apptEnd && $slotEnd > $apptStart) {
                return true;
            }
        }

        return false;
    }

    private function generateNumber(): string
    {
        $count = Appointment::withTrashed()->count() + 1;
        return 'APT-' . str_pad($count, 5, '0', STR_PAD_LEFT);
    }
}
