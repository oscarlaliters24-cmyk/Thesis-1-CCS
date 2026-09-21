<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SeniorCitizenController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // All authenticated users may view senior records; only administrators may modify them.
    Route::get('/seniors', [SeniorCitizenController::class, 'index'])->name('seniors.index');
    Route::middleware(RoleMiddleware::class . ':admin')->group(function () {
        Route::get('/seniors/create', [SeniorCitizenController::class, 'create'])->name('seniors.create');
        Route::post('/seniors', [SeniorCitizenController::class, 'store'])->name('seniors.store');
        Route::get('/seniors/{senior}/edit', [SeniorCitizenController::class, 'edit'])->name('seniors.edit');
        Route::put('/seniors/{senior}', [SeniorCitizenController::class, 'update'])->name('seniors.update');
        Route::delete('/seniors/{senior}', [SeniorCitizenController::class, 'destroy'])->name('seniors.destroy');

        Route::get('/benefits/create', [BenefitController::class, 'create'])->name('benefits.create');
        Route::post('/benefits', [BenefitController::class, 'store'])->name('benefits.store');
    });

    Route::get('/seniors/{senior}', [SeniorCitizenController::class, 'show'])->name('seniors.show');

    Route::get('/benefits', [BenefitController::class, 'index'])->name('benefits.index');

    Route::get('/qr', [VerificationController::class, 'index'])->name('qr.index');
    Route::post('/qr/verify', [VerificationController::class, 'verify'])->name('qr.verify');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/seniors', [ReportController::class, 'seniors'])->name('reports.seniors');
    Route::get('/reports/benefits', [ReportController::class, 'benefits'])->name('reports.benefits');
});

require __DIR__.'/auth.php';
