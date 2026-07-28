<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;

class ServiceManager extends Component
{
    public $showModal = false;
    public $editId = null;
    public $name = '';
    public $description = '';
    public $duration = 60;
    public $price = 0;

    protected $rules = [
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'duration'    => 'required|integer|min:15',
        'price'       => 'required|numeric|min:0',
    ];

    public function render()
    {
        $services = Service::latest()->paginate(10);
        return view('livewire.admin.service-manager', compact('services'))->layout('layouts.admin');
    }

    public function save()
    {
        $this->validate();
        if ($this->editId) {
            Service::findOrFail($this->editId)->update(['name' => $this->name, 'description' => $this->description, 'duration' => $this->duration, 'price' => $this->price]);
        } else {
            Service::create(['name' => $this->name, 'description' => $this->description, 'duration' => $this->duration, 'price' => $this->price]);
        }
        $this->showModal = false;
        $this->reset(['editId', 'name', 'description', 'duration', 'price']);
        session()->flash('message', 'Service saved.');
    }

    public function edit($id)
    {
        $s = Service::findOrFail($id);
        $this->editId = $s->id;
        $this->name = $s->name;
        $this->description = $s->description;
        $this->duration = $s->duration;
        $this->price = $s->price;
        $this->showModal = true;
    }

    public function delete($id)
    {
        Service::findOrFail($id)->delete();
        session()->flash('message', 'Service deleted.');
    }
}
