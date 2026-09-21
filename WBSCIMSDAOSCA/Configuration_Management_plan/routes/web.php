<?php
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SeniorCitizenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class,'showLogin'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('login.store');
});
Route::middleware('auth')->group(function () {
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::resource('senior-citizens',SeniorCitizenController::class);
    Route::get('/senior-citizens/{seniorCitizen}/qr',[SeniorCitizenController::class,'qr'])->name('senior-citizens.qr');
    Route::get('/verify/{qrToken}',[SeniorCitizenController::class,'verify'])->name('senior-citizens.verify');
    Route::get('/qr-scanner', fn()=>view('senior-citizens.scanner'))->name('senior-citizens.scanner');

    Route::resource('benefits',BenefitController::class)->except(['show']);
    Route::post('/benefits/{benefit}/claim',[BenefitController::class,'claim'])->name('benefits.claim');

    Route::get('/reports',[ReportController::class,'index'])->name('reports.index');
    Route::get('/reports/senior-citizens.csv',[ReportController::class,'seniorCitizensCsv'])->name('reports.senior-citizens.csv');
    Route::get('/analytics',[AnalyticsController::class,'index'])->name('analytics.index');

    Route::middleware('role:admin')->group(function () {
        Route::resource('users',UserController::class)->only(['index','create','store','destroy']);
        Route::get('/audit-logs',[AuditLogController::class,'index'])->name('audit-logs.index');
    });
});
