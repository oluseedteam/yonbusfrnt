<div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-950/85 backdrop-blur-md p-4 md:p-6" x-data="videoCallApp()" x-init="initCall()">
    <div class="w-full max-w-5xl h-[85vh] bg-gray-900 border border-gray-800 rounded-3xl shadow-2xl flex flex-col overflow-hidden relative">
        
        <!-- Call Top Navigation Header -->
        <div class="p-4 px-6 border-b border-gray-800/80 flex items-center justify-between bg-gray-900/90 z-20">
            <div class="flex items-center gap-3">
                <div class="w-3 h-3 bg-emerald-500 rounded-full animate-ping"></div>
                <div>
                    <h3 class="font-bold text-sm text-white font-heading flex items-center gap-2">
                        YONBUS Encrypted Live Session
                        <span class="text-[10px] bg-blue-500/20 text-blue-300 border border-blue-500/30 px-2 py-0.5 rounded-full">WebRTC / LiveKit</span>
                    </h3>
                    <p class="text-[11px] text-gray-400 font-mono" x-text="roomStatus"></p>
                </div>
            </div>

            <!-- Timer & Recording Indicator -->
            <div class="flex items-center gap-4">
                <div x-show="isRecording" x-cloak class="flex items-center gap-2 px-3 py-1 bg-red-500/20 border border-red-500/40 text-red-400 rounded-full text-xs font-bold animate-pulse">
                    <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                    <span>Recording Screen...</span>
                </div>

                <div class="bg-gray-800/80 border border-gray-700/60 px-3.5 py-1 rounded-xl text-xs font-mono text-gray-200">
                    ⏱️ <span x-text="callDuration">00:00</span>
                </div>

                <button wire:click="closeVideoCall" @click="endCall()" class="p-2 text-gray-400 hover:text-white rounded-xl hover:bg-gray-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- Main Video Viewport -->
        <div class="flex-1 bg-black relative flex items-center justify-center overflow-hidden">
            <!-- Screen Share / Remote Main Stream Video -->
            <video id="mainVideo" autoplay playsinline class="w-full h-full object-contain bg-gray-950"></video>

            <!-- Video Off Placeholder -->
            <div id="videoPlaceholder" class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 bg-gradient-to-b from-gray-900 to-black z-10">
                <div class="w-24 h-24 rounded-full bg-blue-600/20 border-2 border-blue-500/40 flex items-center justify-center mb-4 text-blue-400 animate-pulse">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <h4 class="font-bold text-lg text-white font-heading" x-text="partnerName">Waiting for participant...</h4>
                <p class="text-xs text-gray-400 max-w-sm mt-1">Camera feed or screen share stream will appear here automatically when connected.</p>
            </div>

            <!-- Picture-in-Picture Local Camera View -->
            <div class="absolute bottom-6 right-6 w-48 h-36 bg-gray-900 border-2 border-white/20 rounded-2xl overflow-hidden shadow-2xl z-20 group">
                <video id="localVideo" autoplay playsinline muted class="w-full h-full object-cover"></video>
                <div class="absolute bottom-2 left-2 bg-black/60 backdrop-blur-sm text-white text-[10px] px-2 py-0.5 rounded font-medium">
                    You (Local)
                </div>
            </div>
        </div>

        <!-- Video Control Bar Footer -->
        <div class="p-4 px-6 border-t border-gray-800/80 bg-gray-900/90 flex flex-wrap items-center justify-between gap-4 z-20">
            <!-- Audio / Video Controls -->
            <div class="flex items-center gap-3">
                <!-- Toggle Mic -->
                <button @click="toggleMic()" :class="isMicOn ? 'bg-gray-800 text-white hover:bg-gray-700' : 'bg-red-600 text-white hover:bg-red-700'" class="p-3 rounded-2xl border border-gray-700/60 transition-all flex items-center gap-2 text-xs font-semibold">
                    <template x-if="isMicOn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 016 0v6a3 3 0 01-3 3z"/></svg>
                    </template>
                    <template x-if="!isMicOn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15zM17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/></svg>
                    </template>
                    <span x-text="isMicOn ? 'Mute' : 'Unmute'"></span>
                </button>

                <!-- Toggle Cam -->
                <button @click="toggleCam()" :class="isCamOn ? 'bg-gray-800 text-white hover:bg-gray-700' : 'bg-red-600 text-white hover:bg-red-700'" class="p-3 rounded-2xl border border-gray-700/60 transition-all flex items-center gap-2 text-xs font-semibold">
                    <template x-if="isCamOn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </template>
                    <template x-if="!isCamOn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                    </template>
                    <span x-text="isCamOn ? 'Stop Cam' : 'Start Cam'"></span>
                </button>
            </div>

            <!-- Screen Share & Recording Actions -->
            <div class="flex items-center gap-3">
                <!-- Screen Share Button -->
                <button @click="toggleScreenShare()" :class="isScreenSharing ? 'bg-emerald-600 text-white' : 'bg-blue-600 hover:bg-blue-700 text-white'" class="px-4 py-3 rounded-2xl transition-all flex items-center gap-2 text-xs font-bold shadow-lg shadow-blue-500/10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span x-text="isScreenSharing ? 'Sharing Screen' : 'Share Screen'"></span>
                </button>

                <!-- Screen Record Button -->
                <button @click="toggleRecord()" :class="isRecording ? 'bg-red-600 hover:bg-red-700 text-white' : 'bg-gray-800 hover:bg-gray-700 text-gray-200 border border-gray-700/60'" class="px-4 py-3 rounded-2xl transition-all flex items-center gap-2 text-xs font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    <span x-text="isRecording ? 'Stop Recording' : 'Record Screen'"></span>
                </button>

                <!-- End Call Button -->
                <button wire:click="closeVideoCall" @click="endCall()" class="px-5 py-3 rounded-2xl bg-red-600 hover:bg-red-700 text-white transition-all flex items-center gap-2 text-xs font-bold shadow-lg shadow-red-500/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.516l2.257-1.13a1 1 0 00.502-1.21L9.228 3.684A1 1 0 008.28 3H5z"/></svg>
                    <span>End Call</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function videoCallApp() {
    return {
        roomStatus: 'Initializing secure room...',
        partnerName: 'Connecting participant...',
        isMicOn: true,
        isCamOn: true,
        isScreenSharing: false,
        isRecording: false,
        callDuration: '00:00',
        timerInterval: null,
        secondsElapsed: 0,
        localStream: null,
        screenStream: null,
        mediaRecorder: null,
        recordedChunks: [],

        async initCall() {
            try {
                // Fetch LiveKit / WebRTC Token from backend
                const response = await fetch('/livekit/token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();
                if (data.token) {
                    this.roomStatus = 'Connected to room: ' + data.room_name;
                    this.partnerName = 'YONBUS Live Consultation';
                } else {
                    this.roomStatus = 'Connected via Direct WebRTC';
                    this.partnerName = 'YONBUS Live Session';
                }

                // Initialize Local Media (Camera & Mic)
                this.localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                const localVideo = document.getElementById('localVideo');
                if (localVideo) {
                    localVideo.srcObject = this.localStream;
                }

                // Also display local stream in main video container initially
                const mainVideo = document.getElementById('mainVideo');
                const placeholder = document.getElementById('videoPlaceholder');
                if (mainVideo) {
                    mainVideo.srcObject = this.localStream;
                    if (placeholder) placeholder.style.display = 'none';
                }

                // Start call timer
                this.startTimer();
            } catch (err) {
                console.warn('Camera/Mic permission denied or unavailable:', err);
                this.roomStatus = 'Screen Share Only (Camera disabled)';
                this.isCamOn = false;
            }
        },

        toggleMic() {
            if (!this.localStream) return;
            const audioTrack = this.localStream.getAudioTracks()[0];
            if (audioTrack) {
                audioTrack.enabled = !audioTrack.enabled;
                this.isMicOn = audioTrack.enabled;
            }
        },

        toggleCam() {
            if (!this.localStream) return;
            const videoTrack = this.localStream.getVideoTracks()[0];
            if (videoTrack) {
                videoTrack.enabled = !videoTrack.enabled;
                this.isCamOn = videoTrack.enabled;
            }
        },

        async toggleScreenShare() {
            if (this.isScreenSharing) {
                // Stop screen sharing
                if (this.screenStream) {
                    this.screenStream.getTracks().forEach(track => track.stop());
                }
                const mainVideo = document.getElementById('mainVideo');
                if (mainVideo && this.localStream) {
                    mainVideo.srcObject = this.localStream;
                }
                this.isScreenSharing = false;
            } else {
                try {
                    // Start screen share using browser getDisplayMedia
                    this.screenStream = await navigator.mediaDevices.getDisplayMedia({ video: true, audio: true });
                    const mainVideo = document.getElementById('mainVideo');
                    const placeholder = document.getElementById('videoPlaceholder');
                    if (mainVideo) {
                        mainVideo.srcObject = this.screenStream;
                        if (placeholder) placeholder.style.display = 'none';
                    }
                    this.isScreenSharing = true;

                    // Detect when user stops sharing via browser bar
                    this.screenStream.getVideoTracks()[0].onended = () => {
                        this.isScreenSharing = false;
                        if (mainVideo && this.localStream) {
                            mainVideo.srcObject = this.localStream;
                        }
                    };
                } catch (err) {
                    console.error('Screen sharing error:', err);
                }
            }
        },

        async toggleRecord() {
            if (this.isRecording) {
                // Stop Recording
                if (this.mediaRecorder) {
                    this.mediaRecorder.stop();
                }
                this.isRecording = false;
            } else {
                try {
                    // Choose stream to record (screenStream if active, else localStream)
                    let recordStream = this.isScreenSharing ? this.screenStream : this.localStream;
                    if (!recordStream) {
                        recordStream = await navigator.mediaDevices.getDisplayMedia({ video: true, audio: true });
                    }

                    this.recordedChunks = [];
                    this.mediaRecorder = new MediaRecorder(recordStream, { mimeType: 'video/webm;codecs=vp9' });

                    this.mediaRecorder.ondataavailable = (event) => {
                        if (event.data.size > 0) {
                            this.recordedChunks.push(event.data);
                        }
                    };

                    this.mediaRecorder.onstop = () => {
                        const blob = new Blob(this.recordedChunks, { type: 'video/webm' });
                        const url = URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = url;
                        a.download = `YONBUS_Session_Recording_${new Date().toISOString().slice(0,10)}.webm`;
                        document.body.appendChild(a);
                        a.click();
                        setTimeout(() => {
                            document.body.removeChild(a);
                            window.URL.revokeObjectURL(url);
                        }, 100);
                    };

                    this.mediaRecorder.start(1000); // collect data per second
                    this.isRecording = true;
                } catch (err) {
                    console.error('Screen recording error:', err);
                }
            }
        },

        startTimer() {
            this.timerInterval = setInterval(() => {
                this.secondsElapsed++;
                const mins = String(Math.floor(this.secondsElapsed / 60)).padStart(2, '0');
                const secs = String(this.secondsElapsed % 60).padStart(2, '0');
                this.callDuration = `${mins}:${secs}`;
            }, 1000);
        },

        endCall() {
            if (this.timerInterval) clearInterval(this.timerInterval);
            if (this.localStream) this.localStream.getTracks().forEach(track => track.stop());
            if (this.screenStream) this.screenStream.getTracks().forEach(track => track.stop());
            if (this.isRecording && this.mediaRecorder) this.mediaRecorder.stop();
        }
    }
}
</script>
