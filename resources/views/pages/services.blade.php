<x-public-layout>
    <x-slot name="title">Services | YONBUS Tax & Accounting Services Inc.</x-slot>

    <!-- Header Banner -->
    <section class="bg-gradient-to-r from-slate-900 via-[#002B8A] to-[#005DFF] text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-200 bg-white/10 px-3.5 py-1.5 rounded-full border border-white/20">Our Services</span>
            <h1 class="text-4xl sm:text-5xl font-extrabold font-heading">Complete Tax & Financial Solutions</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto font-light">Explore our 9 specialized practice categories tailored for Canadian businesses and individuals.</p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-[#005DFF] font-bold text-xl">
                                💼
                            </div>
                            <h2 class="text-2xl font-bold font-heading text-slate-900">{{ $service->name }}</h2>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $service->description }}</p>
                        </div>
                        <div class="pt-6 mt-6 border-t border-slate-100 space-y-4">
                            <div class="flex items-center justify-between text-xs font-semibold text-slate-500">
                                <span>Estimated Time: {{ $service->duration }} mins</span>
                                <span class="text-slate-900 font-bold text-base">${{ number_format($service->price, 2) }}</span>
                            </div>
                            <a href="{{ route('book-appointment') }}?service={{ $service->id }}" class="w-full inline-flex items-center justify-center py-3 rounded-xl bg-[#005DFF] hover:bg-[#002B8A] text-white font-bold text-sm shadow-md transition">
                                Book Consultation
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-public-layout>
