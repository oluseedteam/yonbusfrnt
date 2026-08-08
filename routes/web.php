<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Client\DashboardController as ClientDashboard;
use App\Http\Controllers\Client\DocumentController as ClientDocument;
use App\Http\Controllers\Accountant\DashboardController as AccountantDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use Illuminate\Support\Facades\Route;

// ─── PUBLIC MARKETING ROUTES ─────────────────────────────────────
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/blog', [PublicController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [PublicController::class, 'blogPost'])->name('blog.show');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitContact'])->middleware('throttle:10,1')->name('contact.submit');
Route::get('/book-appointment', [PublicController::class, 'bookAppointment'])->name('book-appointment');
Route::get('/privacy-policy', [PublicController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PublicController::class, 'terms'])->name('terms');

// Auth routes (Breeze)
require __DIR__.'/auth.php';

// Post-login redirect based on role
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    return match ($role) {
        'admin', 'superadmin', 'subadmin' => redirect()->route('admin.dashboard'),
        'accountant'          => redirect()->route('accountant.dashboard'),
        default               => redirect()->route('client.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// ─── CLIENT PORTAL ──────────────────────────────────────────────
Route::prefix('client')->name('client.')->middleware(['auth', 'verified', 'role:client'])->group(function () {
    Route::get('/dashboard', ClientDashboard::class)->name('dashboard');
    Route::get('/appointments', \App\Livewire\Client\AppointmentManager::class)->name('appointments');
    Route::get('/documents', \App\Livewire\Client\DocumentManager::class)->name('documents');
    Route::get('/tax-returns', \App\Livewire\Client\TaxReturnTracker::class)->name('tax-returns');
    Route::get('/invoices', \App\Livewire\Client\InvoiceManager::class)->name('invoices');
    Route::get('/messages', \App\Livewire\Client\Messages::class)->name('messages');
    Route::get('/reports', \App\Livewire\Client\Reports::class)->name('reports');
    Route::get('/profile', \App\Livewire\Client\Profile::class)->name('profile');
    Route::get('/settings', \App\Livewire\Client\Settings::class)->name('settings');
});

// ─── ACCOUNTANT PORTAL ──────────────────────────────────────────
Route::prefix('accountant')->name('accountant.')->middleware(['auth', 'verified', 'role:accountant'])->group(function () {
    Route::get('/dashboard', AccountantDashboard::class)->name('dashboard');
    Route::get('/clients', \App\Livewire\Accountant\ClientList::class)->name('clients');
    Route::get('/appointments', \App\Livewire\Accountant\AppointmentManager::class)->name('appointments');
    Route::get('/documents', \App\Livewire\Accountant\DocumentManager::class)->name('documents');
    Route::get('/tax-returns', \App\Livewire\Accountant\TaxReturnManager::class)->name('tax-returns');
    Route::get('/invoices', \App\Livewire\Accountant\InvoiceManager::class)->name('invoices');
    Route::get('/messages', \App\Livewire\Accountant\Messages::class)->name('messages');
    Route::get('/reports', \App\Livewire\Accountant\Reports::class)->name('reports');
});

// ─── ADMIN PORTAL ───────────────────────────────────────────────
Route::get('/admin/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'createAdmin'])->name('admin.login');
Route::get('/admin/register', [\App\Http\Controllers\Auth\AdminRegisterController::class, 'create'])->name('admin.register');
Route::post('/admin/register', [\App\Http\Controllers\Auth\AdminRegisterController::class, 'store'])->middleware('throttle:5,1')->name('admin.register.store');

Route::get('/admin', function () {
    if (auth()->check()) {
        if (in_array(auth()->user()->role, ['admin', 'superadmin', 'subadmin'])) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('dashboard');
    }
    return redirect()->route('admin.login');
})->name('admin');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'role:admin,superadmin,subadmin'])->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/users', \App\Livewire\Admin\UserManager::class)->name('users');
    Route::get('/services', \App\Livewire\Admin\ServiceManager::class)->name('services');
    Route::get('/appointments', \App\Livewire\Admin\AppointmentManager::class)->name('appointments');
    Route::get('/invoices', \App\Livewire\Admin\InvoiceManager::class)->name('invoices');
    Route::get('/blogs', \App\Livewire\Admin\BlogManager::class)->name('blogs');
    Route::get('/reports', \App\Livewire\Admin\ReportManager::class)->name('reports');
    Route::get('/activity-logs', \App\Livewire\Admin\ActivityLogs::class)->name('activity-logs');
    Route::get('/settings', \App\Livewire\Admin\Settings::class)->name('settings');
});

// Document download
Route::get('/documents/{document}/download', [ClientDocument::class, 'download'])
    ->middleware(['auth'])->name('documents.download');
