<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use App\Models\Client;

class ClientRepository implements RepositoryInterface
{
    public function all(array $filters = [])
    {
        $query = Client::with('user');

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('company_name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('tax_number', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('client_number', 'like', '%' . $filters['search'] . '%')
                  ->orWhereHas('user', fn($u) => $u->where('first_name', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('last_name', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('email', 'like', '%' . $filters['search'] . '%'));
            });
        }

        return $query->latest();
    }

    public function find(int $id)
    {
        return Client::with(['user', 'appointments', 'documents', 'serviceRequests'])->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['client_number'] = $this->generateClientNumber();
        return Client::create($data);
    }

    public function update(int $id, array $data)
    {
        $client = Client::findOrFail($id);
        $client->update($data);
        return $client->fresh(['user']);
    }

    public function delete(int $id)
    {
        return Client::findOrFail($id)->delete();
    }

    public function paginate(int $perPage = 15, array $filters = [])
    {
        return $this->all($filters)->paginate($perPage);
    }

    private function generateClientNumber(): string
    {
        $count = Client::withTrashed()->count() + 1;
        return 'CLT-' . str_pad($count, 5, '0', STR_PAD_LEFT);
    }
}
