<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\PromotionController as AdminPromotionController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Site\ActivityController as SiteActivityController;
use App\Http\Controllers\Site\ReservationController;
use App\Models\Activity;
use App\Models\Reservation;
use App\Models\Promotion;

// Página principal
Route::get('/', [SiteActivityController::class, 'welcome'])->name('welcome');

// Búsqueda y detalle de actividades
Route::get('/activities/search', [SiteActivityController::class, 'search'])->name('activities.search');
Route::get('/activities/{activity}', [SiteActivityController::class, 'show'])->name('activities.show');

// Enviar reserva
Route::middleware(['auth'])->group(function () {
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
});
// Ver reservas del usuario
Route::middleware('auth')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Redirección al dashboard según el rol
Route::get('/dashboard', function () {
    return Auth::check() && Auth::user()->is_admin
        ? redirect()->route('admin.dashboard')
        : redirect()->route('welcome');
})->middleware(['auth'])->name('dashboard');

// Panel de administrador
Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard', [
                'totalActivities' => Activity::count(),
                'totalReservations' => Reservation::count(),
                'mostPopular' => Activity::orderByDesc('popularity')->first(),
                'activePromotions' => Promotion::where('active', true)->count(),
            ]);
        })->name('dashboard');

        Route::resource('activities', AdminActivityController::class);
        Route::resource('promotions', AdminPromotionController::class);
Route::resource('reservations', AdminReservationController::class);
    });

require __DIR__ . '/auth.php';
