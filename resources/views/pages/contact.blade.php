<x-public-layout>
    <x-slot name="title">Contact Us | YONBUS Tax & Accounting Services Inc.</x-slot>

    <!-- Header Banner -->
    <section class="bg-gradient-to-r from-slate-900 via-[#002B8A] to-[#005DFF] text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-3.5 py-1.5 rounded-full border border-white/20">Contact YONBUS</span>
            <h1 class="text-4xl sm:text-5xl font-extrabold font-heading">We're Here to Help Your Business Succeed</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto font-light">Reach out to our Toronto office or submit your inquiry online.</p>
        </div>
    </section>

    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-2xl text-center font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-5 space-y-8 bg-white p-8 sm:p-10 rounded-3xl border border-slate-200 shadow-sm">
                    <h2 class="text-2xl font-bold font-heading text-slate-900">Head Office</h2>
                    
                    <div class="space-y-6 text-sm text-slate-600">
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#005DFF] flex items-center justify-center font-bold text-lg shrink-0">📍</div>
                            <div>
                                <h4 class="font-bold text-slate-900">Address</h4>
                                <p>100 Financial Plaza, Suite 800<br>Toronto, ON M5H 2N2, Canada</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#005DFF] flex items-center justify-center font-bold text-lg shrink-0">📞</div>
                            <div>
                                <h4 class="font-bold text-slate-900">Phone</h4>
                                <p>+1 (800) 555-YONBUS<br>+1 (416) 555-0199</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#005DFF] flex items-center justify-center font-bold text-lg shrink-0">✉️</div>
                            <div>
                                <h4 class="font-bold text-slate-900">Email</h4>
                                <p>info@yonbus.com<br>support@yonbus.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 bg-white p-8 sm:p-10 rounded-3xl border border-slate-200 shadow-sm">
                    <h2 class="text-2xl font-bold font-heading text-slate-900 mb-6">Send Us a Direct Message</h2>
                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Your Name *</label>
                                <input type="text" name="name" required class="w-full rounded-xl border-slate-300 text-sm focus:ring-[#005DFF]" placeholder="John Doe">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Email Address *</label>
                                <input type="email" name="email" required class="w-full rounded-xl border-slate-300 text-sm focus:ring-[#005DFF]" placeholder="john@example.com">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Phone Number</label>
                                <input type="text" name="phone" class="w-full rounded-xl border-slate-300 text-sm focus:ring-[#005DFF]" placeholder="+1 (555) 000-0000">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Subject *</label>
                                <input type="text" name="subject" required class="w-full rounded-xl border-slate-300 text-sm focus:ring-[#005DFF]" placeholder="Corporate Tax Inquiry">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Message *</label>
                            <textarea name="message" rows="5" required class="w-full rounded-xl border-slate-300 text-sm focus:ring-[#005DFF]" placeholder="How can our accounting team assist you?"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-[#005DFF] hover:bg-[#002B8A] text-white font-bold rounded-xl shadow-lg transition">
                            Submit Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
