<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\AppointmentController;
use App\Http\Controllers\Api\v1\DocumentController;
use App\Http\Controllers\Api\v1\ReportController;

/*
|--------------------------------------------------------------------------
| API Routes — Version 1
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    // Public Auth
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login',    [AuthController::class, 'login']);

    // Authenticated Routes (Sanctum)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/auth/user',  [AuthController::class, 'user']);
        Route::post('/auth/logout', [AuthController::class, 'logout']);

        // Appointments
        Route::get('/appointments',          [AppointmentController::class, 'index']);
        Route::post('/appointments',         [AppointmentController::class, 'store']);
        Route::get('/appointments/{id}',     [AppointmentController::class, 'show']);
        Route::post('/appointments/{id}/cancel', [AppointmentController::class, 'cancel']);

        // Documents
        Route::get('/documents',         [DocumentController::class, 'index']);
        Route::post('/documents',        [DocumentController::class, 'store']);
        Route::delete('/documents/{id}', [DocumentController::class, 'destroy']);

        // Reports
        Route::get('/reports/dashboard',    [ReportController::class, 'dashboard']);
        Route::get('/reports/appointments', [ReportController::class, 'appointments']);
        Route::get('/reports/revenue',      [ReportController::class, 'revenue']);
    });
});
