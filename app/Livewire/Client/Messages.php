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
        $admin = $this->getPrimaryAdmin();
        $this->selectedAdminId = $admin?->id;
    }

    private function getAdminIds(): array
    {
        $ids = User::whereIn('role', ['admin', 'superadmin', 'subadmin'])
            ->orWhereHas('roles', function ($q) {
                $q->whereIn('name', ['admin', 'superadmin', 'subadmin', 'super-admin']);
            })
            ->pluck('id')
            ->toArray();

        if (empty($ids)) {
            $first = User::first();
            $ids = $first ? [$first->id] : [1];
        }

        return array_unique($ids);
    }

    private function getPrimaryAdmin(): ?User
    {
        $admin = User::whereIn('role', ['admin', 'superadmin', 'subadmin'])
            ->orWhereHas('roles', function ($q) {
                $q->whereIn('name', ['admin', 'superadmin', 'subadmin', 'super-admin']);
            })
            ->first();

        if (!$admin) {
            $admin = User::first();
        }

        return $admin;
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
        $admins = User::whereIn('role', ['admin', 'superadmin', 'subadmin'])
            ->orWhereHas('roles', function ($q) {
                $q->whereIn('name', ['admin', 'superadmin', 'subadmin', 'super-admin']);
            })
            ->get();

        if ($admins->isEmpty()) {
            $primary = $this->getPrimaryAdmin();
            if ($primary) {
                $admins = collect([$primary]);
            }
        }

        $adminIds = $this->getAdminIds();
        $userId = auth()->id();

        // Get all messages between client and ANY admin user
        $messages = Message::where(function ($q) use ($userId, $adminIds) {
            $q->where('sender_id', $userId)->whereIn('receiver_id', $adminIds);
        })->orWhere(function ($q) use ($userId, $adminIds) {
            $q->whereIn('sender_id', $adminIds)->where('receiver_id', $userId);
        })->with(['sender', 'receiver'])->orderBy('created_at')->get();

        // Mark received messages from any admin as read
        Message::whereIn('sender_id', $adminIds)->where('receiver_id', $userId)->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('livewire.client.messages', compact('admins', 'messages'))
            ->layout('layouts.client');
    }

    public function send()
    {
        $this->validate();

        if (!$this->selectedAdminId) {
            $admin = $this->getPrimaryAdmin();
            $this->selectedAdminId = $admin?->id;
        }

        if (!$this->selectedAdminId) {
            session()->flash('error', 'Unable to find an admin support account.');
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
