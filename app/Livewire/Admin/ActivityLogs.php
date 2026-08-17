<?php

namespace App\Livewire\Admin;

use App\Models\ActivityLog;
use App\Services\AuditService;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityLogs extends Component
{
    use WithPagination;

    public $search = '';
    public $filterAction = '';
    public $adminFilter = '';

    public function render()
    {
        $adminUsers = \App\Models\User::whereIn('role', ['admin', 'superadmin', 'subadmin'])
            ->orWhere('email', 'like', '%@yonbustax.ca')
            ->get();

        $logs = ActivityLog::with('user')
            ->when($this->search, fn($q) => $q->where('action', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%")
                ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$this->search}%")))
            ->when($this->filterAction, fn($q) => $q->where('action', $this->filterAction))
            ->when($this->adminFilter, fn($q) => $q->where('user_id', $this->adminFilter))
            ->latest()->paginate(20);

        $actionTypes = ActivityLog::select('action')->distinct()->orderBy('action')->pluck('action');

        return view('livewire.admin.activity-logs', compact('logs', 'actionTypes', 'adminUsers'))->layout('layouts.admin');
    }

    public function clearOldLogs()
    {
        $count = ActivityLog::where('created_at', '<', now()->subDays(90))->count();
        ActivityLog::where('created_at', '<', now()->subDays(90))->delete();
        AuditService::log('logs.cleared', "Cleared {$count} activity log entries older than 90 days.");
        session()->flash('message', "{$count} old log entries cleared successfully.");
    }
}
