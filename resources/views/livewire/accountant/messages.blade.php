<div class="h-[calc(100vh-160px)] flex flex-col md:flex-row gap-6" wire:poll.5s>
    <!-- Client Selector Sidebar -->
    <div class="w-full md:w-80 card-box p-4 flex flex-col justify-between flex-shrink-0">
        <div>
            <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading mb-4">Client Conversations</h3>
            <div class="space-y-2">
                @forelse($clients as $c)
                    <button wire:click="$set('selectedClientId', {{ $c->id }})"
                            class="w-full text-left p-3 rounded-xl flex items-center gap-3 transition-colors {{ $selectedClientId == $c->id ? 'bg-blue-50 dark:bg-blue-950/50 border border-blue-100 dark:border-blue-900/50' : 'hover:bg-gray-50 dark:hover:bg-gray-800 border border-transparent' }}">
                        <img src="{{ $c->avatar_url }}" class="w-10 h-10 rounded-xl object-cover">
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-xs text-gray-900 dark:text-white font-heading truncate">{{ $c->name }}</p>
                            <p class="text-[11px] text-gray-400 truncate">{{ $c->email }}</p>
                        </div>
                    </button>
                @empty
                    <p class="text-xs text-gray-400 py-4 text-center">No clients have booked yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Chat Stream -->
    <div class="flex-1 card-box p-0 flex flex-col h-full overflow-hidden">
        <!-- Chat Header -->
        <div class="p-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-gray-50/50 dark:bg-gray-800/30">
            <div>
                <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading">
                    @if($selectedClientId)
                        Chatting with {{ $clients->firstWhere('id', $selectedClientId)?->name }}
                    @else
                        Select a Client
                    @endif
                </h3>
                <p class="text-[10px] text-[#005DFF] font-semibold flex items-center gap-1 mt-0.5">
                    <span class="w-1.5 h-1.5 bg-[#005DFF] rounded-full animate-pulse"></span>
                    Live Chat Active
                </p>
            </div>

            <!-- Video Call Button -->
            @if($selectedClientId)
            <button wire:click="startVideoCall"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                <span>Video & Screen Share</span>
            </button>
            @endif
        </div>

        <!-- Messages Thread -->
        <div class="flex-1 p-6 overflow-y-auto space-y-4">
            @forelse($messages as $msg)
                @php $isMe = $msg->sender_id === auth()->id(); @endphp
                <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}">
                    <div class="flex items-end gap-2 max-w-lg {{ $isMe ? 'flex-row-reverse' : 'flex-row' }}">
                        <img src="{{ $msg->sender?->avatar_url }}" class="w-7 h-7 rounded-lg object-cover">
                        <div class="p-3.5 rounded-2xl text-xs {{ $isMe ? 'bg-[#005DFF] text-white rounded-br-none shadow-md' : 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-bl-none border border-gray-200/60 dark:border-gray-700/60' }}">
                            <p class="whitespace-pre-line leading-relaxed">{{ $msg->body }}</p>
                            @if($msg->attachment)
                                <div class="mt-2 pt-2 border-t {{ $isMe ? 'border-blue-400/40' : 'border-gray-200 dark:border-gray-700' }} flex items-center gap-2">
                                    <a href="{{ Storage::url($msg->attachment) }}" target="_blank" class="text-xs font-bold hover:underline flex items-center gap-1">
                                        📎 {{ $msg->attachment_name ?? 'Attachment' }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <span class="text-[10px] text-gray-400 mt-1 px-1">{{ $msg->created_at->format('g:i A') }}</span>
                </div>
            @empty
                <div class="text-center py-16 px-4">
                    <div class="w-12 h-12 bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h4 class="font-bold text-sm text-gray-800 dark:text-gray-200">No Messages Yet</h4>
                    <p class="text-xs text-gray-400 max-w-sm mx-auto mt-1">Select a client from the left to start your conversation.</p>
                </div>
            @endforelse
        </div>

        <!-- Send Form -->
        @if($selectedClientId)
        <form wire:submit.prevent="send" class="p-4 border-t border-gray-100 dark:border-gray-800 flex items-center gap-3 bg-white dark:bg-gray-900">
            <input type="text" wire:model="body" placeholder="Type your response to client..."
                   class="flex-1 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2.5 px-4 text-xs focus:ring-[#005DFF] focus:border-[#005DFF]">
            <button type="submit" class="btn-primary text-xs py-2.5 px-5 flex items-center gap-1.5">
                <span>Send</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>
        @else
        <div class="p-4 border-t border-gray-100 dark:border-gray-800 text-center text-xs text-gray-400">
            Select a client conversation from the left panel.
        </div>
        @endif
    </div>

    <!-- LiveKit Video Call Modal -->
    @if($showVideoCallModal)
        @include('livewire.client.video-call-modal')
    @endif
</div>
