<?php

namespace App\Livewire\Accountant;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Messages extends Component
{
    public $body = '';
    public $selectedClientId = null;

    public function mount()
    {
        $client = User::where('role', 'client')->first();
        $this->selectedClientId = $client?->id;
    }

    public function render()
    {
        $clients = User::where('role', 'client')->get();
        $messages = [];

        if ($this->selectedClientId) {
            $acctId = auth()->id();
            $clientId = $this->selectedClientId;
            $messages = Message::where(function ($q) use ($acctId, $clientId) {
                $q->where('sender_id', $acctId)->where('receiver_id', $clientId);
            })->orWhere(function ($q) use ($acctId, $clientId) {
                $q->where('sender_id', $clientId)->where('receiver_id', $acctId);
            })->with(['sender'])->orderBy('created_at')->get();

            Message::where('sender_id', $clientId)->where('receiver_id', $acctId)->whereNull('read_at')
                ->update(['read_at' => now()]);
        }

        return view('livewire.accountant.messages', compact('clients', 'messages'))
            ->layout('layouts.accountant');
    }

    public function send()
    {
        $this->validate(['body' => 'required|string|max:1000']);
        Message::create([
            'sender_id'   => auth()->id(),
            'receiver_id' => $this->selectedClientId,
            'body'        => $this->body,
        ]);
        $this->reset('body');
    }
}
