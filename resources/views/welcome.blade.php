<x-public-layout>
    <x-slot name="title">Professional Tax & Accounting Services | YONBUS Tax & Accounting Services Inc.</x-slot>

    <!-- 1. Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-b from-slate-900 via-[#002B8A] to-[#005DFF] text-white pt-16 pb-24 lg:pt-24 lg:pb-32">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-semibold uppercase tracking-wider text-blue-200">
                        <span class="w-2 h-2 rounded-full bg-[#00A3FF] animate-pulse"></span>
                        <span>CRA Registered & Certified CPAs</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold font-heading tracking-tight text-white leading-tight">
                        Professional Tax & Accounting Services for Individuals and Businesses
                    </h1>

                    <p class="text-lg sm:text-xl text-blue-100/90 max-w-2xl font-light leading-relaxed mx-auto lg:mx-0">
                        Empower your financial future with Canada's trusted tax strategies, seamless bookkeeping, corporate audit defense, and automated payroll systems.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-4 pt-4">
                        <a href="{{ route('book-appointment') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-xl text-base font-bold text-slate-900 bg-white hover:bg-slate-100 shadow-2xl shadow-blue-900/50 transition-all transform hover:-translate-y-0.5">
                            Book Appointment
                            <svg class="w-5 h-5 ml-2 text-[#005DFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>

                        <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-xl text-base font-bold text-white bg-white/10 hover:bg-white/20 border border-white/30 backdrop-blur-md transition-all">
                            Get Started
                        </a>
                    </div>

                    <!-- Trust Stats -->
                    <div class="pt-8 border-t border-white/15 grid grid-cols-3 gap-6 text-center lg:text-left">
                        <div>
                            <div class="font-heading text-3xl font-extrabold text-white">99.8%</div>
                            <div class="text-xs text-blue-200 mt-1">Filing Accuracy</div>
                        </div>
                        <div>
                            <div class="font-heading text-3xl font-extrabold text-white">$12M+</div>
                            <div class="text-xs text-blue-200 mt-1">Tax Savings Found</div>
                        </div>
                        <div>
                            <div class="font-heading text-3xl font-extrabold text-white">1,500+</div>
                            <div class="text-xs text-blue-200 mt-1">Active Clients</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Graphic Card: Financial & Money Image -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-white/20 group">
                        <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1200&q=80" alt="YONBUS Financial & Tax Management" class="w-full h-[450px] object-cover transform group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-900/40 to-transparent flex flex-col justify-between p-8">
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/20 backdrop-blur-md text-white border border-white/30">
                                    💰 Corporate Tax & Financial Advisory
                                </span>
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-500/80 text-white backdrop-blur-md shadow-md">
                                    CRA Certified
                                </span>
                            </div>

                            <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-5 border border-white/20 space-y-3 shadow-xl">
                                <div class="flex items-center justify-between text-xs text-blue-100">
                                    <span>YONBUS Accounting Portal</span>
                                    <span class="font-bold text-emerald-400">● Live Synchronization</span>
                                </div>
                                <div class="text-white font-extrabold text-lg font-heading">
                                    $4,850,000+ Corporate Taxes Prepared
                                </div>
                                <div class="grid grid-cols-2 gap-2 pt-1 text-xs">
                                    <div class="bg-white/10 rounded-lg p-2 text-center text-blue-100">
                                        <div class="font-bold text-white text-sm">100%</div>
                                        <div>Audit Protection</div>
                                    </div>
                                    <div class="bg-white/10 rounded-lg p-2 text-center text-blue-100">
                                        <div class="font-bold text-white text-sm">24 Hours</div>
                                        <div>Doc Turnaround</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Services Overview (All 9 Categories) -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <span class="text-xs font-bold text-[#005DFF] uppercase tracking-widest bg-blue-50 px-3.5 py-1.5 rounded-full border border-blue-200">Our Expertise</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading">Comprehensive Tax & Accounting Solutions</h2>
                <p class="text-slate-600 text-base sm:text-lg">From personal tax returns to complex corporate restructuring and CRA audit representation, our accredited advisors deliver reliable outcomes.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-[#005DFF] group-hover:bg-[#005DFF] group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold font-heading text-slate-900 group-hover:text-[#005DFF] transition-colors">{{ $service->name }}</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $service->description }}</p>
                        </div>
                        <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs font-semibold">
                            <span class="text-slate-500">Duration: {{ $service->duration }} mins</span>
                            <a href="{{ route('book-appointment') }}?service={{ $service->id }}" class="text-[#005DFF] hover:text-[#002B8A] inline-flex items-center">
                                Book Now
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 3. Why Choose YONBUS -->
    <section class="py-24 bg-white border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-6 space-y-6">
                    <span class="text-xs font-bold text-[#005DFF] uppercase tracking-widest bg-blue-50 px-3.5 py-1.5 rounded-full border border-blue-200">Why YONBUS</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading leading-tight">Built on Precision, Transparency, and Dedicated Professionalism</h2>
                    <p class="text-slate-600 text-base leading-relaxed">
                        We don't just file taxes; we establish long-term financial clarity for your business. Our dedicated team of CPAs combines cutting-edge portal technology with deep Canadian tax code mastery.
                    </p>

                    <div class="space-y-4 pt-2">
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-[#005DFF] flex items-center justify-center shrink-0 mt-1 font-bold">1</div>
                            <div>
                                <h4 class="font-bold text-slate-900 font-heading">Dedicated CPA & Accountant Assignment</h4>
                                <p class="text-slate-600 text-sm">Direct access to your assigned tax specialist through integrated client messaging.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-[#005DFF] flex items-center justify-center shrink-0 mt-1 font-bold">2</div>
                            <div>
                                <h4 class="font-bold text-slate-900 font-heading">24/7 Secure Document Management</h4>
                                <p class="text-slate-600 text-sm">Upload tax slips, receipts, and payroll records securely from any desktop or mobile device.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-[#005DFF] flex items-center justify-center shrink-0 mt-1 font-bold">3</div>
                            <div>
                                <h4 class="font-bold text-slate-900 font-heading">Complete Audit & CRA Protection</h4>
                                <p class="text-slate-600 text-sm">Proactive audit defense and direct correspondence handling with tax authorities.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 bg-slate-900 text-white rounded-3xl p-8 sm:p-12 shadow-2xl relative">
                    <div class="space-y-6">
                        <h3 class="text-2xl font-bold font-heading text-white">Client Portal Advantage</h3>
                        <p class="text-slate-300 text-sm">Manage all corporate filings, message accountants, download reports, and view invoice history in one place.</p>
                        
                        <div class="bg-slate-800/80 rounded-2xl p-6 border border-slate-700 space-y-4">
                            <div class="flex justify-between items-center text-xs text-slate-400">
                                <span>Status Tracker</span>
                                <span class="text-emerald-400 font-bold">Completed</span>
                            </div>
                            <div class="text-lg font-bold text-white">2023 Federal Corporate Return (T2)</div>
                            <div class="w-full bg-slate-700 h-2 rounded-full overflow-hidden">
                                <div class="bg-[#005DFF] h-full w-full"></div>
                            </div>
                            <div class="flex justify-between text-xs text-slate-400">
                                <span>Submitted to CRA</span>
                                <span>Notice of Assessment Ready</span>
                            </div>
                        </div>

                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center w-full py-3.5 rounded-xl font-semibold bg-[#005DFF] hover:bg-[#002B8A] text-white transition">
                            Access Client Portal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Appointment Booking CTA -->
    <section class="py-20 bg-gradient-to-r from-[#002B8A] via-[#005DFF] to-[#00A3FF] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
            <h2 class="text-3xl sm:text-5xl font-extrabold font-heading tracking-tight">Ready to Optimize Your Tax & Business Accounting?</h2>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto font-light">Book an online consultation with our senior tax accountants today and get your finances on track.</p>
            <div>
                <a href="{{ route('book-appointment') }}" class="inline-flex items-center justify-center px-10 py-4 rounded-xl text-lg font-bold text-[#002B8A] bg-white hover:bg-slate-100 shadow-2xl transition transform hover:-translate-y-0.5">
                    Schedule Your Consultation
                </a>
            </div>
        </div>
    </section>

    <!-- 5. Featured Blog Posts (Replacing Pricing Section) -->
    <section class="py-24 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div class="space-y-3">
                    <span class="text-xs font-bold text-[#005DFF] uppercase tracking-widest bg-blue-50 px-3.5 py-1.5 rounded-full border border-blue-200">Insights & Resources</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading">Featured Articles, Tax Tips & Accounting Guides</h2>
                    <p class="text-slate-600 text-sm sm:text-base max-w-2xl">Stay updated with Canadian tax updates, business registration tips, and accounting strategies written by expert CPAs.</p>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="{{ route('blog') }}" class="inline-flex items-center text-sm font-bold text-[#005DFF] hover:text-[#002B8A] transition">
                        View All Articles
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredBlogs as $blog)
                    <article class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            @if($blog->featured_image)
                                <div class="h-48 overflow-hidden relative">
                                    <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <span class="absolute top-4 left-4 bg-[#005DFF] text-white text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-md">
                                        {{ $blog->category->name }}
                                    </span>
                                </div>
                            @endif
                            <div class="p-6 space-y-3">
                                <div class="text-xs text-slate-400 font-medium">Published {{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Recently' }}</div>
                                <h3 class="font-heading font-bold text-lg text-slate-900 group-hover:text-[#005DFF] transition-colors leading-snug">
                                    <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                </h3>
                                <p class="text-slate-600 text-sm line-clamp-3 leading-relaxed">{{ $blog->excerpt }}</p>
                            </div>
                        </div>
                        <div class="px-6 pb-6 pt-2">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="text-xs font-bold text-[#005DFF] group-hover:text-[#002B8A] inline-flex items-center">
                                Read Full Guide
                                <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 6. Testimonials -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <span class="text-xs font-bold text-[#005DFF] uppercase tracking-widest bg-blue-50 px-3.5 py-1.5 rounded-full border border-blue-200">Client Reviews</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading">Trusted by Entrepreneurs & Individuals</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-200 space-y-4">
                    <div class="flex text-amber-400">★★★★★</div>
                    <p class="text-slate-700 text-sm leading-relaxed">"YONBUS transformed our corporate tax preparation. Sarah and her team identified key capital cost allowances that saved us over $15,000 this tax year."</p>
                    <div class="pt-4 border-t border-slate-200">
                        <div class="font-bold text-slate-900 text-sm">Robert Wilson</div>
                        <div class="text-xs text-slate-500">CEO, Wilson Tech Ltd</div>
                    </div>
                </div>

                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-200 space-y-4">
                    <div class="flex text-amber-400">★★★★★</div>
                    <p class="text-slate-700 text-sm leading-relaxed">"The online booking system and client portal make uploading monthly bookkeeping documents effortless. I always know where my filings stand."</p>
                    <div class="pt-4 border-t border-slate-200">
                        <div class="font-bold text-slate-900 text-sm">Jane Smith</div>
                        <div class="text-xs text-slate-500">Founder, Smith & Co. Retail</div>
                    </div>
                </div>

                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-200 space-y-4">
                    <div class="flex text-amber-400">★★★★★</div>
                    <p class="text-slate-700 text-sm leading-relaxed">"When the CRA sent an audit audit review notice, YONBUS represented us directly and resolved the inquiry within 10 days. Outstanding professional service!"</p>
                    <div class="pt-4 border-t border-slate-200">
                        <div class="font-bold text-slate-900 text-sm">John Doe</div>
                        <div class="text-xs text-slate-500">Managing Principal, Doe Enterprises</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Contact Section -->
    <section class="py-20 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-5 space-y-6">
                    <span class="text-xs font-bold text-[#00A3FF] uppercase tracking-widest bg-blue-900/50 px-3.5 py-1.5 rounded-full border border-blue-700">Get in Touch</span>
                    <h2 class="text-3xl font-extrabold font-heading text-white">Have a Specific Tax or Accounting Question?</h2>
                    <p class="text-slate-300 text-sm leading-relaxed">Send us a direct message or stop by our Toronto office. Our team responds within one business day.</p>
                    
                    <div class="space-y-4 text-sm text-slate-300 pt-4">
                        <p class="flex items-center"><strong class="w-24 text-white">Office:</strong> 100 Financial Plaza, Toronto, ON</p>
                        <p class="flex items-center"><strong class="w-24 text-white">Phone:</strong> +1 (800) 555-YONBUS</p>
                        <p class="flex items-center"><strong class="w-24 text-white">Email:</strong> info@yonbus.com</p>
                        <p class="flex items-center"><strong class="w-24 text-white">Hours:</strong> Mon - Fri: 8:30 AM - 6:00 PM EST</p>
                    </div>
                </div>

                <div class="lg:col-span-7 bg-white text-slate-900 rounded-3xl p-8 shadow-2xl">
                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Your Name</label>
                                <input type="text" name="name" required class="w-full rounded-xl border-slate-300 focus:border-[#005DFF] focus:ring-[#005DFF] text-sm" placeholder="John Doe">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Email Address</label>
                                <input type="email" name="email" required class="w-full rounded-xl border-slate-300 focus:border-[#005DFF] focus:ring-[#005DFF] text-sm" placeholder="john@example.com">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Phone Number</label>
                                <input type="text" name="phone" class="w-full rounded-xl border-slate-300 focus:border-[#005DFF] focus:ring-[#005DFF] text-sm" placeholder="+1 (555) 000-0000">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Subject</label>
                                <input type="text" name="subject" required class="w-full rounded-xl border-slate-300 focus:border-[#005DFF] focus:ring-[#005DFF] text-sm" placeholder="Corporate Tax Inquiry">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Message</label>
                            <textarea name="message" rows="4" required class="w-full rounded-xl border-slate-300 focus:border-[#005DFF] focus:ring-[#005DFF] text-sm" placeholder="How can our accounting team assist you?"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-[#005DFF] hover:bg-[#002B8A] text-white font-bold rounded-xl shadow-lg transition">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
