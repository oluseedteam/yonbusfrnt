<x-public-layout>
    <x-slot name="title">Book Online Appointment | YONBUS Tax & Accounting Services Inc.</x-slot>

    <!-- Banner -->
    <section class="bg-gradient-to-r from-slate-900 via-[#002B8A] to-[#005DFF] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-3.5 py-1.5 rounded-full border border-white/20">Online Scheduling</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold font-heading">Schedule Your Tax & Accounting Consultation</h1>
            <p class="text-blue-100 text-sm max-w-xl mx-auto">Select your service, choose an available time slot, and lock in your session with our certified CPAs.</p>
        </div>
    </section>

    <!-- Booking Component Container -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @livewire('public.booking-system')
        </div>
    </section>
</x-public-layout>
