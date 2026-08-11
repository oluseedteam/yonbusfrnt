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
        // Select client with most recent message or first client
        $recentMsg = Message::latest()->first();
        if ($recentMsg) {
            $adminIds = $this->getAdminIds();
            if (in_array($recentMsg->sender_id, $adminIds)) {
                $this->selectedClientId = $recentMsg->receiver_id;
            } else {
                $this->selectedClientId = $recentMsg->sender_id;
            }
        }

        if (!$this->selectedClientId) {
            $client = User::where('role', 'client')->first();
            $this->selectedClientId = $client?->id;
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
        $adminIds = $this->getAdminIds();

        // Get all clients who have messaged or registered
        $clientsQuery = User::where('role', 'client');

        if ($this->searchClient) {
            $clientsQuery->where(function ($q) {
                $q->where('first_name', 'like', "%{$this->searchClient}%")
                  ->orWhere('last_name', 'like', "%{$this->searchClient}%")
                  ->orWhere('email', 'like', "%{$this->searchClient}%")
                  ->orWhere('company_name', 'like', "%{$this->searchClient}%");
            });
        }

        $clients = $clientsQuery->get()->map(function ($client) use ($adminIds) {
            $client->unread_count = Message::where('sender_id', $client->id)
                ->whereIn('receiver_id', $adminIds)
                ->whereNull('read_at')
                ->count();

            $lastMsg = Message::where(function ($q) use ($client, $adminIds) {
                $q->where('sender_id', $client->id)->whereIn('receiver_id', $adminIds);
            })->orWhere(function ($q) use ($client, $adminIds) {
                $q->whereIn('sender_id', $adminIds)->where('receiver_id', $client->id);
            })->latest()->first();

            $client->last_message = $lastMsg?->body;
            $client->last_message_time = $lastMsg?->created_at;
            return $client;
        })->sortByDesc('last_message_time');

        $messages = [];
        if ($this->selectedClientId) {
            $clientId = $this->selectedClientId;

            $messages = Message::where(function ($q) use ($adminIds, $clientId) {
                $q->whereIn('sender_id', $adminIds)->where('receiver_id', $clientId);
            })->orWhere(function ($q) use ($adminIds, $clientId) {
                $q->where('sender_id', $clientId)->whereIn('receiver_id', $adminIds);
            })->with(['sender', 'receiver'])->orderBy('created_at')->get();

            // Mark unread messages from this client as read
            Message::where('sender_id', $clientId)->whereIn('receiver_id', $adminIds)->whereNull('read_at')
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
