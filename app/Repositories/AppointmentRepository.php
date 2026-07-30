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
        if (!empty($filters['service_id'])) {
            $query->where('service_id', $filters['service_id']);
        }
        if (!empty($filters['date_from'])) {
            $query->where('date', '>=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $query->where('date', '<=', $filters['date_to']);
        }

        return $query->latest('date');
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

    public function isSlotTaken(int $accountantId, string $date, string $time, ?int $excludeId = null): bool
    {
        $query = Appointment::where('accountant_id', $accountantId)
            ->where('date', $date)
            ->where('time', $time)
            ->whereNotIn('status', ['cancelled']);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    private function generateNumber(): string
    {
        $count = Appointment::withTrashed()->count() + 1;
        return 'APT-' . str_pad($count, 5, '0', STR_PAD_LEFT);
    }
}
