<div class="h-[calc(100vh-140px)] flex flex-col md:flex-row gap-6" wire:poll.5s>
    <!-- Client Inbox Sidebar -->
    <div class="w-full md:w-80 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl p-5 shadow-sm flex flex-col justify-between flex-shrink-0">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-sm text-slate-900 dark:text-white font-heading">Client Inquiries</h3>
                <span class="text-[11px] font-semibold text-[#005DFF] dark:text-blue-400 bg-blue-50 dark:bg-blue-950 px-2.5 py-1 rounded-full">
                    {{ $clients->sum('unread_count') }} Unread
                </span>
            </div>

            <!-- Client Search -->
            <div class="mb-4">
                <input type="text" wire:model.live.debounce.300ms="searchClient" placeholder="Search clients..." class="w-full bg-[#f8fafc] dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-3.5 py-2 text-xs text-gray-900 dark:text-white focus:ring-[#005DFF] focus:border-[#005DFF]">
            </div>

            <div class="space-y-1.5 overflow-y-auto flex-1 pr-1">
                @forelse($clients as $client)
                    <button wire:click="selectClient({{ $client->id }})" 
                            class="w-full text-left p-3 rounded-2xl flex items-center gap-3 transition-all relative {{ $selectedClientId == $client->id ? 'bg-blue-50 dark:bg-blue-950/50 border border-blue-200 dark:border-blue-800 shadow-sm' : 'hover:bg-gray-50 dark:hover:bg-gray-800 border border-transparent' }}">
                        <img src="{{ $client->avatar_url }}" class="w-10 h-10 rounded-xl object-cover flex-shrink-0">
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-xs text-gray-900 dark:text-white font-heading truncate">{{ $client->name }}</p>
                                @if($client->last_message_time)
                                    <span class="text-[10px] text-gray-400">{{ $client->last_message_time->format('g:i A') }}</span>
                                @endif
                            </div>
                            <p class="text-[11px] text-gray-500 dark:text-gray-400 truncate mt-0.5">
                                {{ $client->last_message ?? ($client->company_name ?: 'Client Account') }}
                            </p>
                        </div>
                        @if($client->unread_count > 0)
                            <span class="w-5 h-5 bg-[#005DFF] text-white rounded-full text-[10px] font-bold flex items-center justify-center flex-shrink-0 shadow-sm">
                                {{ $client->unread_count }}
                            </span>
                        @endif
                    </button>
                @empty
                    <div class="p-8 text-center text-xs text-slate-400">
                        No active client message threads found.<br>Search for a client above to initiate a chat.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Chat Stream -->
    <div class="flex-1 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl p-0 flex flex-col h-full overflow-hidden shadow-sm">
        @php $activeClient = $clients->firstWhere('id', $selectedClientId); @endphp
        
        <!-- Chat Header -->
        <div class="p-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-gray-50/50 dark:bg-gray-800/30">
            <div class="flex items-center gap-3">
                @if($activeClient)
                    <img src="{{ $activeClient->avatar_url }}" class="w-9 h-9 rounded-xl object-cover">
                    <div>
                        <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading">
                            {{ $activeClient->name }}
                        </h3>
                        <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium">
                            {{ $activeClient->email }} {{ $activeClient->company_name ? '• ' . $activeClient->company_name : '' }}
                        </p>
                    </div>
                @else
                    <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading">Client Inbox</h3>
                @endif
            </div>

            @if($activeClient)
                <div class="flex items-center gap-2">
                    <!-- Video Call & Screen Share Trigger -->
                    <button wire:click="startVideoCall" 
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 rounded-lg shadow-sm transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span>Start Video Call / Screen Share</span>
                    </button>
                </div>
            @endif
        </div>

        <!-- Chat Messages Thread -->
        <div class="flex-1 p-6 overflow-y-auto space-y-4">
            @forelse($messages as $msg)
                @php $isMe = $msg->sender_id === auth()->id(); @endphp
                <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}">
                    <div class="flex items-end gap-2 max-w-lg {{ $isMe ? 'flex-row-reverse' : 'flex-row' }}">
                        <img src="{{ $msg->sender?->avatar_url }}" class="w-7 h-7 rounded-lg object-cover">
                        <div class="p-3.5 rounded-2xl text-xs {{ $isMe ? 'bg-[#005DFF] text-white rounded-br-none shadow-md shadow-blue-500/10' : 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-bl-none border border-gray-200/60 dark:border-gray-700/60' }}">
                            <p class="whitespace-pre-line leading-relaxed">{{ $msg->body }}</p>
                            @if($msg->attachment)
                                <div class="mt-2 pt-2 border-t {{ $isMe ? 'border-blue-400/40' : 'border-gray-200 dark:border-gray-700' }} flex items-center gap-2 font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                    <a href="{{ Storage::url($msg->attachment) }}" target="_blank" class="hover:underline font-bold">
                                        {{ $msg->attachment_name ?? 'Attachment' }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <span class="text-[10px] text-gray-400 mt-1 px-1">{{ $msg->created_at->format('g:i A') }}</span>
                </div>
            @empty
                <div class="text-center py-28 px-4 my-auto">
                    <div class="w-14 h-14 bg-[#eff6ff] dark:bg-blue-950/60 text-[#005DFF] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h4 class="font-bold text-base text-slate-900 dark:text-white font-heading">No Messages Selected</h4>
                    <p class="text-xs text-slate-400 max-w-sm mx-auto mt-1.5 leading-relaxed">Select a client from the sidebar to view their message thread and reply.</p>
                </div>
            @endforelse
        </div>

        <!-- Input Form -->
        @if($activeClient)
            <form wire:submit.prevent="send" class="p-4 border-t border-gray-100 dark:border-gray-800 flex items-center gap-3 bg-white dark:bg-gray-900">
                <input type="text" wire:model="body" placeholder="Type a reply to {{ $activeClient->first_name }}..." class="flex-1 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2.5 px-4 text-xs focus:ring-[#005DFF] focus:border-[#005DFF]">
                <button type="submit" class="btn-primary text-xs py-2.5 px-5 flex items-center gap-1.5">
                    <span>Reply</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
        @endif
    </div>

    <!-- LiveKit / WebRTC Video Call & Screen Share Modal -->
    @if($showVideoCallModal)
        @include('livewire.client.video-call-modal')
    @endif
</div>
