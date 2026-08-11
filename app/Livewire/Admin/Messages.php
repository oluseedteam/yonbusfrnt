<?php

namespace App\Livewire\Admin;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Messages extends Component
{
    use WithFileUploads;

    public $body = '';
    public $attachment;
    public $selectedClientId = null;
    public $searchClient = '';
    public $showVideoCallModal = false;

    protected $rules = [
        'body'       => 'required|string|max:1000',
        'attachment' => 'nullable|file|max:10240',
    ];

    public function mount()
    {
        $adminIds = $this->getAdminIds();

        // Select client with most recent message
        $recentMsg = Message::where(function ($q) use ($adminIds) {
            $q->whereIn('sender_id', $adminIds)->orWhereIn('receiver_id', $adminIds);
        })->latest()->first();

        if ($recentMsg) {
            if (in_array($recentMsg->sender_id, $adminIds)) {
                $this->selectedClientId = $recentMsg->receiver_id;
            } else {
                $this->selectedClientId = $recentMsg->sender_id;
            }
        }

        if (!$this->selectedClientId) {
            $firstClientWithMsg = User::where('role', 'client')
                ->whereHas('sentMessages')
                ->first();
            $this->selectedClientId = $firstClientWithMsg?->id;
        }
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
            $ids = [auth()->id()];
        }

        return array_unique($ids);
    }

    public function selectClient($clientId)
    {
        $this->selectedClientId = $clientId;
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
        // Query clients or users who have message history or role client
        $clientsQuery = User::where(function ($q) {
            $q->whereIn('role', ['client', 'user'])
              ->orWhereHas('sentMessages')
              ->orWhereHas('receivedMessages');
        });

        if ($this->searchClient) {
            $search = $this->searchClient;
            $clientsQuery->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        $allClients = $clientsQuery->get();

        $clients = $allClients->map(function ($client) {
            $client->unread_count = Message::where('sender_id', $client->id)
                ->whereNull('read_at')
                ->count();

            $lastMsg = Message::where('sender_id', $client->id)
                ->orWhere('receiver_id', $client->id)
                ->latest('created_at')
                ->first();

            $client->last_message = $lastMsg?->body;
            $client->last_message_time = $lastMsg?->created_at;
            return $client;
        })->filter(function ($c) {
            return !empty($this->searchClient) || $c->last_message !== null || $c->unread_count > 0;
        })->sortByDesc(function ($c) {
            return $c->last_message_time ? $c->last_message_time->timestamp : 0;
        });

        // Fallback: If selected client is not set but clients exist, pick first client with messages
        if (!$this->selectedClientId && $clients->isNotEmpty()) {
            $this->selectedClientId = $clients->first()->id;
        }

        $messages = [];
        if ($this->selectedClientId) {
            $clientId = $this->selectedClientId;

            $messages = Message::where('sender_id', $clientId)
                ->orWhere('receiver_id', $clientId)
                ->with(['sender', 'receiver'])
                ->orderBy('created_at')
                ->get();

            // Mark unread messages from this client as read
            Message::where('sender_id', $clientId)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        }

        return view('livewire.admin.messages', compact('clients', 'messages'))
            ->layout('layouts.admin');
    }

    public function send()
    {
        $this->validate();

        if (!$this->selectedClientId) {
            session()->flash('error', 'Please select a client to message.');
            return;
        }

        $data = [
            'sender_id'   => auth()->id(),
            'receiver_id' => $this->selectedClientId,
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
