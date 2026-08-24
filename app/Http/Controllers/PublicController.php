<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Service;
use App\Models\CommunicationLog;
use App\Services\GoogleReviewService;
use App\Services\PracticeAreaService;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home(GoogleReviewService $reviewService)
    {
        $services = Service::where('is_active', true)->take(9)->get();
        $featuredBlogs = Blog::with('category', 'author')
            ->where('is_published', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        $googleReviews = $reviewService->getReviews();

        return view('welcome', compact('services', 'featuredBlogs', 'googleReviews'));
    }

    public function about(GoogleReviewService $reviewService)
    {
        $googleReviews = $reviewService->getReviews();
        return view('pages.about', compact('googleReviews'));
    }

    public function services(PracticeAreaService $practiceAreaService)
    {
        $services = Service::where('is_active', true)->get();
        $servicesList = $practiceAreaService->getAll();
        return view('pages.services', compact('services', 'servicesList'));
    }

    public function serviceDetail($slug, PracticeAreaService $practiceAreaService)
    {
        $service = $practiceAreaService->findBySlug($slug);

        if (!$service) {
            abort(404);
        }

        $allServices = $practiceAreaService->getAll();
        $otherServices = $practiceAreaService->getOtherServices($slug);

        return view('pages.service-single', compact('service', 'allServices', 'otherServices'));
    }

    public function team()
    {
        return view('pages.team');
    }

    public function blog(Request $request)
    {
        $categories = BlogCategory::withCount('blogs')->get();
        $query = Blog::with('category', 'author')->where('is_published', true);

        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $blogs = $query->orderBy('published_at', 'desc')->paginate(6);
        return view('pages.blog', compact('blogs', 'categories'));
    }

    public function blogPost($slug)
    {
        $blog = Blog::with('category', 'author')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        $relatedBlogs = Blog::where('blog_category_id', $blog->blog_category_id)
            ->where('id', '!=', $blog->id)
            ->take(3)
            ->get();

        return view('pages.blog-single', compact('blog', 'relatedBlogs'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        CommunicationLog::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $validated['phone'] ?? null,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'channel' => 'contact_form',
        ]);

        return back()->with('success', 'Thank you for reaching out! A YONBUS representative will contact you shortly.');
    }

    public function bookAppointment()
    {
        return view('pages.book-appointment');
    }

    public function careers()
    {
        return view('pages.careers');
    }

    public function submitCareer(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:50',
            'position'   => 'required|string|max:255',
            'experience' => 'required|string|max:100',
            'message'    => 'required|string|max:3000',
            'resume'     => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('career-applications', 'public');
        }

        CommunicationLog::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $validated['phone'] ?? null,
            'subject' => 'Career Application: ' . $validated['position'] . ' (' . $validated['experience'] . ')',
            'message' => $validated['message'] . ($resumePath ? "\n\n[Resume: " . $resumePath . "]" : ''),
            'channel' => 'career_application',
        ]);

        return back()->with('success', 'Thank you for applying! Our HR team will review your application and be in touch within 5 business days.');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }
}
