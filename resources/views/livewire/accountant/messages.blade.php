<div class="h-[calc(100vh-160px)] flex flex-col md:flex-row gap-6">
    <div class="w-full md:w-80 card-box p-4 flex flex-col justify-between flex-shrink-0">
        <div>
            <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading mb-4">Client Conversations</h3>
            <div class="space-y-2">
                @foreach($clients as $c)
                    <button wire:click="$set('selectedClientId', {{ $c->id }})" 
                            class="w-full text-left p-3 rounded-xl flex items-center gap-3 transition-colors {{ $selectedClientId == $c->id ? 'bg-blue-50 dark:bg-blue-950/50 border border-blue-100 dark:border-blue-900/50' : 'hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <img src="{{ $c->avatar_url }}" class="w-10 h-10 rounded-xl object-cover">
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-xs text-gray-900 dark:text-white font-heading truncate">{{ $c->name }}</p>
                            <p class="text-[11px] text-gray-400 truncate">{{ $c->email }}</p>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex-1 card-box p-0 flex flex-col h-full overflow-hidden">
        <div class="p-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-gray-50/50 dark:bg-gray-800/30">
            <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading">
                @if($selectedClientId)
                    Chatting with {{ $clients->firstWhere('id', $selectedClientId)?->name }}
                @else
                    Select Client
                @endif
            </h3>
        </div>

        <div class="flex-1 p-6 overflow-y-auto space-y-4">
            @forelse($messages as $msg)
                @php $isMe = $msg->sender_id === auth()->id(); @endphp
                <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}">
                    <div class="flex items-end gap-2 max-w-lg {{ $isMe ? 'flex-row-reverse' : 'flex-row' }}">
                        <img src="{{ $msg->sender?->avatar_url }}" class="w-7 h-7 rounded-lg object-cover">
                        <div class="p-3.5 rounded-2xl text-xs {{ $isMe ? 'bg-[#005DFF] text-white rounded-br-none shadow-md' : 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-bl-none' }}">
                            <p>{{ $msg->body }}</p>
                        </div>
                    </div>
                    <span class="text-[10px] text-gray-400 mt-1 px-1">{{ $msg->created_at->format('g:i A') }}</span>
                </div>
            @empty
                <p class="text-center text-xs text-gray-400 py-12">No message history.</p>
            @endforelse
        </div>

        <form wire:submit.prevent="send" class="p-4 border-t border-gray-100 dark:border-gray-800 flex items-center gap-3 bg-white dark:bg-gray-900">
            <input type="text" wire:model="body" placeholder="Type your response to client..." class="flex-1 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2.5 px-4 text-xs">
            <button type="submit" class="btn-primary text-xs py-2.5 px-5">Send</button>
        </form>
    </div>
</div>
