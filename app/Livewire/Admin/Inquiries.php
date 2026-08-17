<?php

namespace App\Livewire\Admin;

use App\Models\CommunicationLog;
use App\Services\AuditService;
use Livewire\Component;
use Livewire\WithPagination;

class Inquiries extends Component
{
    use WithPagination;

    public $search = '';
    public $channelFilter = 'all'; // all, contact_form, career_application
    public $statusFilter = 'all';  // all, unread, read
    public $selectedInquiry = null;
    public $showDetailModal = false;

    public function render()
    {
        $query = CommunicationLog::query();

        if ($this->channelFilter !== 'all') {
            $query->where('channel', $this->channelFilter);
        }

        if ($this->statusFilter === 'unread') {
            $query->where('is_read', false);
        } elseif ($this->statusFilter === 'read') {
            $query->where('is_read', true);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%")
                  ->orWhere('phone', 'like', "%{$this->search}%")
                  ->orWhere('subject', 'like', "%{$this->search}%")
                  ->orWhere('message', 'like', "%{$this->search}%");
            });
        }

        $inquiries = $query->latest()->paginate(15);

        $counts = [
            'total'    => CommunicationLog::count(),
            'contacts' => CommunicationLog::where('channel', 'contact_form')->count(),
            'careers'  => CommunicationLog::where('channel', 'career_application')->count(),
            'unread'   => CommunicationLog::where('is_read', false)->count(),
        ];

        return view('livewire.admin.inquiries', compact('inquiries', 'counts'))
            ->layout('layouts.admin');
    }

    public function viewDetails($id)
    {
        $inquiry = CommunicationLog::findOrFail($id);
        $inquiry->update(['is_read' => true]);
        $this->selectedInquiry = $inquiry;
        $this->showDetailModal = true;
    }

    public function toggleRead($id)
    {
        $inquiry = CommunicationLog::findOrFail($id);
        $inquiry->update(['is_read' => !$inquiry->is_read]);
        session()->flash('message', 'Status updated.');
    }

    public function delete($id)
    {
        $inquiry = CommunicationLog::findOrFail($id);
        $desc = "Deleted inquiry from {$inquiry->name} ({$inquiry->channel})";
        $inquiry->delete();
        AuditService::log('inquiry.deleted', $desc);
        session()->flash('message', 'Inquiry deleted successfully.');
        $this->showDetailModal = false;
    }
}
