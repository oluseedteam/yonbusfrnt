@if(config('services.microsoft_bookings.url'))
    <div {{ $attributes->class(['mb-6 p-4 rounded-xl border border-blue-200 dark:border-blue-900 bg-blue-50 dark:bg-blue-950/40 text-sm text-slate-700 dark:text-slate-300']) }}>
        <p>New appointments are scheduled through Microsoft Bookings and do not automatically appear in this portal. The records below are appointments booked in this portal.</p>
        <p class="mt-2">For a Microsoft booking, use the instructions in the confirmation email or contact YONBUS to make changes.</p>
        <a href="{{ config('services.microsoft_bookings.url') }}" class="inline-block mt-3 font-bold text-blue-700 dark:text-blue-300 underline">Schedule online</a>
    </div>
@endif
