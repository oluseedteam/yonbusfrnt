<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use App\Services\AuditService;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceManager extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editId = null;
    public $name = '';
    public $description = '';
    public $duration = 60;
    public $price = 0;
    public $is_active = true;

    protected $rules = [
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'duration'    => 'required|integer|min:15',
        'price'       => 'required|numeric|min:0',
        'is_active'   => 'boolean',
    ];

    public function render()
    {
        $services = Service::latest()->paginate(10);
        return view('livewire.admin.service-manager', compact('services'))->layout('layouts.admin');
    }

    public function openModal()
    {
        $this->reset(['editId', 'name', 'description', 'duration', 'price']);
        $this->is_active = true;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $s = Service::findOrFail($id);
        $this->editId      = $s->id;
        $this->name        = $s->name;
        $this->description = $s->description;
        $this->duration    = $s->duration;
        $this->price       = $s->price;
        $this->is_active   = (bool) $s->is_active;
        $this->showModal   = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name'        => $this->name,
            'description' => $this->description,
            'duration'    => $this->duration,
            'price'       => $this->price,
            'is_active'   => $this->is_active,
        ];

        if ($this->editId) {
            $s = Service::findOrFail($this->editId);
            $s->update($data);
            AuditService::log('service.updated', "Updated service: {$s->name}", 'Service', $s->id);
        } else {
            $s = Service::create($data);
            AuditService::log('service.created', "Created service: {$s->name}", 'Service', $s->id);
        }

        $this->showModal = false;
        $this->reset(['editId', 'name', 'description', 'duration', 'price', 'is_active']);
        session()->flash('message', 'Service saved successfully.');
    }

    public function delete($id)
    {
        $s = Service::findOrFail($id);
        AuditService::log('service.deleted', "Deleted service: {$s->name}", 'Service', $s->id);
        $s->delete();
        session()->flash('message', 'Service deleted successfully.');
    }
}
