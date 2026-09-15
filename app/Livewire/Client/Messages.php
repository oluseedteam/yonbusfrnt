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
        $ids = User::excludeDeveloper()
            ->where(function ($q) {
                $q->whereIn('role', ['admin', 'superadmin', 'subadmin'])
                  ->orWhereHas('roles', function ($rq) {
                      $rq->whereIn('name', ['admin', 'superadmin', 'subadmin', 'super-admin']);
                  });
            })
            ->pluck('id')
            ->toArray();

        return array_unique($ids);
    }

    private function getPrimaryAdmin(): ?User
    {
        // 1. If client has an assigned practice admin that is not developer, use them
        $assignedId = auth()->user()?->assigned_admin_id;
        if ($assignedId) {
            $assigned = User::excludeDeveloper()->find($assignedId);
            if ($assigned) {
                return $assigned;
            }
        }

        // 2. Default to Olubukunola Eniola (Founder & Partner)
        $founder = User::excludeDeveloper()->where('email', 'olubukunola@yonbustax.ca')->first();
        if ($founder) {
            return $founder;
        }

        // 3. Fallback to any active non-developer admin
        return User::excludeDeveloper()
            ->where(function ($q) {
                $q->whereIn('role', ['admin', 'superadmin', 'subadmin'])
                  ->orWhereHas('roles', function ($rq) {
                      $rq->whereIn('name', ['admin', 'superadmin', 'subadmin', 'super-admin']);
                  });
            })
            ->where('is_active', true)
            ->first();
    }

    public function selectAdmin($adminId)
    {
        $this->selectedAdminId = $adminId;
    }

    public function startVideoCall()
    {
        // Temporarily deactivated (#) - will be reactivated in future release
        // $this->showVideoCallModal = true;
    }

    public function closeVideoCall()
    {
        $this->showVideoCallModal = false;
    }

    public function render()
    {
        $admins = User::excludeDeveloper()
            ->where(function ($q) {
                $q->whereIn('role', ['admin', 'superadmin', 'subadmin'])
                  ->orWhereHas('roles', function ($rq) {
                      $rq->whereIn('name', ['admin', 'superadmin', 'subadmin', 'super-admin']);
                  });
            })
            ->where('is_active', true)
            ->get();

        if ($admins->isEmpty()) {
            $primary = $this->getPrimaryAdmin();
            if ($primary) {
                $admins = collect([$primary]);
            }
        }

        // Ensure selectedAdminId is valid and not developer
        if (!$this->selectedAdminId || !$admins->contains('id', $this->selectedAdminId)) {
            $this->selectedAdminId = $admins->first()?->id;
        }

        $userId = auth()->id();
        $hasAppointment = \App\Models\Appointment::where('client_id', $userId)->exists();

        // Get messages between client and selected admin
        $messages = collect();
        if ($this->selectedAdminId) {
            $targetId = $this->selectedAdminId;
            $messages = Message::where(function ($q) use ($userId, $targetId) {
                $q->where('sender_id', $userId)->where('receiver_id', $targetId);
            })->orWhere(function ($q) use ($userId, $targetId) {
                $q->where('sender_id', $targetId)->where('receiver_id', $userId);
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at')
            ->get();

            // Mark unread received messages as read
            Message::where('receiver_id', $userId)
                ->where('sender_id', $targetId)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        }

        return view('livewire.client.messages', compact('admins', 'messages', 'hasAppointment'))
            ->layout('layouts.client');
    }

    public function send()
    {
        $hasAppointment = \App\Models\Appointment::where('client_id', auth()->id())->exists();
        if (!$hasAppointment) {
            session()->flash('error', 'You must book an appointment first before messaging our support team.');
            return;
        }

        $this->validate();

        if (!$this->selectedAdminId) {
            $admin = $this->getPrimaryAdmin();
            $this->selectedAdminId = $admin?->id;
        }

        // Guard: ensure recipient is not developer
        if ($this->selectedAdminId) {
            $validRecipient = User::excludeDeveloper()->find($this->selectedAdminId);
            if (!$validRecipient) {
                $this->selectedAdminId = $this->getPrimaryAdmin()?->id;
            }
        }

        if (!$this->selectedAdminId) {
            session()->flash('error', 'Unable to find an admin support account.');
            return;
        }

        $data = [
            'sender_id'   => auth()->id(),
            'receiver_id' => $this->selectedAdminId,
            'body'        => trim($this->body),
        ];

        if ($this->attachment) {
            $path = $this->attachment->store('messages', 'public');
            $data['attachment'] = $path;
            $data['attachment_name'] = $this->attachment->getClientOriginalName();
        }

        $msg = Message::create($data);

        $receiver = User::find($this->selectedAdminId);
        if ($receiver) {
            try {
                $receiver->notify(new \App\Notifications\NewMessageNotification($msg));
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning("Failed to notify receiver {$receiver->email} of new message: " . $e->getMessage());
            }
        }

        $this->reset(['body', 'attachment']);
        session()->flash('message', 'Message sent successfully.');
    }
}
