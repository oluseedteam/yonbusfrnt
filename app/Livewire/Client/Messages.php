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
    public $selectedAccountantId = null;

    protected $rules = [
        'body'       => 'required|string|max:1000',
        'attachment' => 'nullable|file|max:10240',
    ];

    public function mount()
    {
        // Auto-select first accountant if available
        $accountant = User::where('role', 'accountant')->first();
        $this->selectedAccountantId = $accountant?->id;
    }

    public function render()
    {
        $accountants = User::where('role', 'accountant')->get();

        $messages = [];
        if ($this->selectedAccountantId) {
            $userId = auth()->id();
            $acctId = $this->selectedAccountantId;
            $messages = Message::where(function ($q) use ($userId, $acctId) {
                $q->where('sender_id', $userId)->where('receiver_id', $acctId);
            })->orWhere(function ($q) use ($userId, $acctId) {
                $q->where('sender_id', $acctId)->where('receiver_id', $userId);
            })->with(['sender', 'receiver'])->orderBy('created_at')->get();

            // Mark received messages as read
            Message::where('sender_id', $acctId)->where('receiver_id', $userId)->whereNull('read_at')
                ->update(['read_at' => now()]);
        }

        return view('livewire.client.messages', compact('accountants', 'messages'))
            ->layout('layouts.client');
    }

    public function send()
    {
        $this->validate();
        $data = [
            'sender_id'   => auth()->id(),
            'receiver_id' => $this->selectedAccountantId,
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
