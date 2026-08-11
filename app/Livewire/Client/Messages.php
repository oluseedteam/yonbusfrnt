<?php

namespace App\Livewire\Client;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Messages extends Component
{
    use WithFileUploads;

    public $body = '';
    public $attachment;
    public $selectedAdminId = null;
    public $showVideoCallModal = false;

    protected $rules = [
        'body'       => 'required|string|max:1000',
        'attachment' => 'nullable|file|max:10240',
    ];

    public function mount()
    {
        // Auto-select primary admin support account
        $admin = User::whereIn('role', ['admin', 'superadmin', 'subadmin'])->first();
        if (!$admin) {
            $admin = User::first();
        }
        $this->selectedAdminId = $admin?->id;
    }

    public function selectAdmin($adminId)
    {
        $this->selectedAdminId = $adminId;
    }

    public function startVideoCall()
    {
        $this->showVideoCallModal = true;
    }

    public function closeVideoCall()
    {
        $this->showVideoCallModal = false;
    }

    public function render()
    {
        $admins = User::whereIn('role', ['admin', 'superadmin', 'subadmin'])->get();
        if ($admins->isEmpty() && $this->selectedAdminId) {
            $admins = User::where('id', $this->selectedAdminId)->get();
        }

        $messages = [];
        if ($this->selectedAdminId) {
            $userId = auth()->id();
            $adminId = $this->selectedAdminId;

            $messages = Message::where(function ($q) use ($userId, $adminId) {
                $q->where('sender_id', $userId)->where('receiver_id', $adminId);
            })->orWhere(function ($q) use ($userId, $adminId) {
                $q->where('sender_id', $adminId)->where('receiver_id', $userId);
            })->with(['sender', 'receiver'])->orderBy('created_at')->get();

            // Mark received messages as read
            Message::where('sender_id', $adminId)->where('receiver_id', $userId)->whereNull('read_at')
                ->update(['read_at' => now()]);
        }

        return view('livewire.client.messages', compact('admins', 'messages'))
            ->layout('layouts.client');
    }

    public function send()
    {
        $this->validate();

        if (!$this->selectedAdminId) {
            $admin = User::whereIn('role', ['admin', 'superadmin', 'subadmin'])->first();
            $this->selectedAdminId = $admin?->id;
        }

        if (!$this->selectedAdminId) {
            session()->flash('error', 'Unable to find an admin support account. Please try again later.');
            return;
        }

        $data = [
            'sender_id'   => auth()->id(),
            'receiver_id' => $this->selectedAdminId,
            'body'        => $this->body,
        ];

        if ($this->attachment) {
            $path = $this->attachment->store('messages', 'local');
            $data['attachment'] = $path;
            $data['attachment_name'] = $this->attachment->getClientOriginalName();
        }

        Message::create($data);
        $this->reset(['body', 'attachment']);
    }
}
