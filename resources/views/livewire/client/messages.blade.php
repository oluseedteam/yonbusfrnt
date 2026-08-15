<div class="h-[calc(100vh-160px)] flex flex-col md:flex-row gap-6" wire:poll.5s>
    <!-- Admin Support Selector Sidebar -->
    <div class="w-full md:w-80 card-box p-4 flex flex-col justify-between flex-shrink-0">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading">Support & Management</h3>
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-200">
                    Official Admin
                </span>
            </div>
            
            <div class="space-y-2">
                @forelse($admins as $admin)
                    <button wire:click="selectAdmin({{ $admin->id }})" 
                            class="w-full text-left p-3 rounded-xl flex items-center gap-3 transition-all {{ $selectedAdminId == $admin->id ? 'bg-blue-50 dark:bg-blue-950/50 border border-blue-200 dark:border-blue-800 shadow-sm' : 'hover:bg-gray-50 dark:hover:bg-gray-800 border border-transparent' }}">
                        <div class="relative">
                            <img src="{{ $admin->avatar_url }}" class="w-10 h-10 rounded-xl object-cover">
                            <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-[#005DFF] border-2 border-white dark:border-gray-900 rounded-full"></span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-xs text-gray-900 dark:text-white font-heading truncate">{{ $admin->name }}</p>
                            </div>
                            <p class="text-[11px] text-blue-600 dark:text-blue-400 font-medium truncate">YONBUS Support Team</p>
                        </div>
                    </button>
                @empty
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-xl text-xs text-gray-500">
                        YONBUS Support Admin
                    </div>
                @endforelse
            </div>
        </div>
        
        <div class="p-3.5 bg-gradient-to-r from-blue-900/10 to-indigo-900/10 dark:from-blue-950/40 dark:to-indigo-950/40 border border-blue-200/50 dark:border-blue-900/40 rounded-xl text-[11px] text-gray-600 dark:text-gray-300">
            <div class="flex items-center gap-2 font-bold text-blue-700 dark:text-blue-400 mb-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                Direct Admin Channel
            </div>
            All client messages are sent directly to the YONBUS Admin team for immediate response.
        </div>
    </div>

    <!-- Chat Stream -->
    <div class="flex-1 card-box p-0 flex flex-col h-full overflow-hidden">
        <!-- Chat Header -->
        <div class="p-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-gray-50/50 dark:bg-gray-800/30">
            <div class="flex items-center gap-3">
                @php $activeAdmin = $admins->firstWhere('id', $selectedAdminId); @endphp
                <div class="relative">
                    <img src="{{ $activeAdmin?->avatar_url ?? 'https://ui-avatars.com/api/?name=Admin+Support&background=005DFF&color=fff' }}" class="w-9 h-9 rounded-xl object-cover">
                    <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald-500 border-2 border-white dark:border-gray-900 rounded-full"></span>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-gray-900 dark:text-white font-heading">
                        {{ $activeAdmin?->name ?? 'YONBUS Admin Support' }}
                    </h3>
                    <p class="text-[10px] text-[#005DFF] dark:text-[#005DFF] font-semibold flex items-center gap-1">
                        <span class="w-1.5 h-1.5 bg-[#005DFF] rounded-full animate-pulse"></span>
                        Active Support • Direct Admin Line
                    </p>
                </div>
            </div>

            <!-- Action Controls: Encrypted badge & Video Call Button -->
            <div class="flex items-center gap-2">
                <span class="hidden sm:inline-flex text-[10px] bg-blue-50 text-[#005DFF] dark:bg-blue-950/60 dark:text-blue-400 font-semibold px-2.5 py-1 rounded-full items-center gap-1 border border-blue-100 dark:border-blue-900">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    256-Bit Encrypted
                </span>

                <!-- LiveKit / WebRTC Video Call & Screen Share Trigger -->
                <button wire:click="startVideoCall" 
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 rounded-lg shadow-sm transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    <span>Video & Screen Share</span>
                </button>
            </div>
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
                <div class="text-center py-16 px-4">
                    <div class="w-12 h-12 bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h4 class="font-bold text-sm text-gray-800 dark:text-gray-200">Start a Conversation with Admin</h4>
                    <p class="text-xs text-gray-400 max-w-sm mx-auto mt-1">Send a message below. Your inquiries, tax documents, and consultation requests are sent straight to the YONBUS Admin team.</p>
                </div>
            @endforelse
        </div>

        <!-- Input Form or Appointment Requirement Notice -->
        @if(!$hasAppointment)
            <div class="p-6 border-t border-gray-100 dark:border-gray-800 bg-amber-50/60 dark:bg-amber-950/30 text-center space-y-3">
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h4 class="font-bold text-sm text-gray-900 dark:text-white font-heading">Book an Appointment First</h4>
                <p class="text-xs text-gray-600 dark:text-gray-400 max-w-md mx-auto">
                    You have not booked an appointment yet. To start messaging our admin team, please schedule your consultation appointment first.
                </p>
                <div class="pt-1">
                    <a href="{{ route('client.appointments') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#005DFF] hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Book Appointment First</span>
                    </a>
                </div>
            </div>
        @else
            <form wire:submit.prevent="send" class="p-4 border-t border-gray-100 dark:border-gray-800 flex items-center gap-3 bg-white dark:bg-gray-900">
                <input type="text" wire:model="body" placeholder="Type your message to YONBUS Admin..." class="flex-1 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl py-2.5 px-4 text-xs focus:ring-[#005DFF] focus:border-[#005DFF]">
                <button type="submit" class="btn-primary text-xs py-2.5 px-5 flex items-center gap-1.5">
                    <span>Send</span>
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
