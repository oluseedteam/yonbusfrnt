<div class="h-[calc(100vh-160px)] flex flex-col md:flex-row gap-6">
    <!-- Accountant Selector Sidebar -->
    <div class="w-full md:w-80 card-box p-4 flex flex-col justify-between flex-shrink-0">
        <div>
            <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading mb-4">Assigned Accountants</h3>
            <div class="space-y-2">
                @foreach($accountants as $acct)
                    <button wire:click="$set('selectedAccountantId', {{ $acct->id }})" 
                            class="w-full text-left p-3 rounded-xl flex items-center gap-3 transition-colors {{ $selectedAccountantId == $acct->id ? 'bg-blue-50 dark:bg-blue-950/50 border border-blue-100 dark:border-blue-900/50' : 'hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <img src="{{ $acct->avatar_url }}" class="w-10 h-10 rounded-xl object-cover">
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-xs text-gray-900 dark:text-white font-heading truncate">{{ $acct->name }}</p>
                            <p class="text-[11px] text-gray-400 truncate">Certified CPA</p>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
        <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-xl text-[11px] text-gray-500">
            💬 Direct messaging with your dedicated tax advisor.
        </div>
    </div>

    <!-- Chat Stream -->
    <div class="flex-1 card-box p-0 flex flex-col h-full overflow-hidden">
        <!-- Chat Header -->
        <div class="p-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-gray-50/50 dark:bg-gray-800/30">
            <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading">
                @if($selectedAccountantId)
                    Chat with {{ $accountants->firstWhere('id', $selectedAccountantId)?->name }}
                @else
                    Messages
                @endif
            </h3>
            <span class="text-[10px] bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 font-semibold px-2 py-0.5 rounded-full">Encrypted & Secure</span>
        </div>

        <!-- Chat Messages Thread -->
        <div class="flex-1 p-6 overflow-y-auto space-y-4">
            @forelse($messages as $msg)
                @php $isMe = $msg->sender_id === auth()->id(); @endphp
                <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}">
                    <div class="flex items-end gap-2 max-w-lg {{ $isMe ? 'flex-row-reverse' : 'flex-row' }}">
                        <img src="{{ $msg->sender?->avatar_url }}" class="w-7 h-7 rounded-lg object-cover">
                        <div class="p-3.5 rounded-2xl text-xs {{ $isMe ? 'bg-[#005DFF] text-white rounded-br-none shadow-md shadow-blue-500/10' : 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-bl-none' }}">
                            <p>{{ $msg->body }}</p>
                            @if($msg->attachment)
                                <div class="mt-2 pt-2 border-t {{ $isMe ? 'border-blue-400/40' : 'border-gray-200 dark:border-gray-700' }} flex items-center gap-2 font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                    <span>{{ $msg->attachment_name ?? 'Attachment' }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <span class="text-[10px] text-gray-400 mt-1 px-1">{{ $msg->created_at->format('g:i A') }}</span>
                </div>
            @empty
                <p class="text-center text-xs text-gray-400 py-12">No messages yet. Send a note to start the conversation!</p>
            @endforelse
        </div>

        <!-- Input Form -->
        <form wire:submit.prevent="send" class="p-4 border-t border-gray-100 dark:border-gray-800 flex items-center gap-3 bg-white dark:bg-gray-900">
            <input type="text" wire:model="body" placeholder="Type your message..." class="flex-1 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2.5 px-4 text-xs focus:ring-[#005DFF]">
            <button type="submit" class="btn-primary text-xs py-2.5 px-5">
                Send
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </form>
    </div>
</div>
