<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Client\DashboardController as ClientDashboard;
use App\Http\Controllers\Client\AppointmentController as ClientAppointment;
use App\Http\Controllers\Client\DocumentController as ClientDocument;
use App\Http\Controllers\Accountant\DashboardController as AccountantDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use Illuminate\Support\Facades\Route;

// Public landing page
Route::get('/', function () {
    return view('welcome');
});

// Auth routes (Breeze)
require __DIR__.'/auth.php';

// Post-login redirect based on role
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    return match ($role) {
        'admin'      => redirect()->route('admin.dashboard'),
        'accountant' => redirect()->route('accountant.dashboard'),
        default      => redirect()->route('client.dashboard'),
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
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/users', \App\Livewire\Admin\UserManager::class)->name('users');
    Route::get('/services', \App\Livewire\Admin\ServiceManager::class)->name('services');
    Route::get('/appointments', \App\Livewire\Admin\AppointmentManager::class)->name('appointments');
    Route::get('/invoices', \App\Livewire\Admin\InvoiceManager::class)->name('invoices');
    Route::get('/activity-logs', \App\Livewire\Admin\ActivityLogs::class)->name('activity-logs');
    Route::get('/settings', \App\Livewire\Admin\Settings::class)->name('settings');
});

// Document download
Route::get('/documents/{document}/download', [ClientDocument::class, 'download'])
    ->middleware(['auth'])->name('documents.download');
