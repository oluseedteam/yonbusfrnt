<?php

namespace App\Livewire\Admin;

use App\Models\ActivityLog;
use Livewire\Component;

class ActivityLogs extends Component
{
    public $search = '';

    public function render()
    {
        $logs = ActivityLog::with('user')
            ->when($this->search, fn($q) => $q->where('action', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%"))
            ->latest()->paginate(20);

        return view('livewire.admin.activity-logs', compact('logs'))->layout('layouts.admin');
    }
}
