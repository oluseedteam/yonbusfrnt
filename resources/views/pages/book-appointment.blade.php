<x-public-layout>
    <x-slot name="title">Book Online Appointment | YONBUS Tax & Accounting Services Inc.</x-slot>

    <!-- Banner -->
    <section style="background: linear-gradient(135deg, #002B8A 0%, #0045d8 50%, #0052FF 100%); color: #ffffff; padding: 4.5rem 0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
            <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: #ffffff; background: rgba(255,255,255,0.18); padding: 5px 16px; border-radius: 999px; border: 1px solid rgba(255,255,255,0.3); display: inline-block;">Online Scheduling</span>
            <h1 class="font-heading font-extrabold text-3xl sm:text-4xl" style="color: #ffffff;">Schedule Your Tax &amp; Accounting Consultation</h1>
            <p style="color: #dbeafe; font-size: 0.95rem; max-width: 36rem; margin: 0 auto;">Select your service, choose an available time slot, and lock in your session with our certified CPBs.</p>
        </div>
    </section>

    <!-- Booking Component Container -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @livewire('public.booking-system')
        </div>
    </section>
</x-public-layout>
