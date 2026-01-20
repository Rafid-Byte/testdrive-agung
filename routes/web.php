<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Volt;
use App\Http\Controllers\CheckSheetController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PameranInfoController;

// PUBLIC ROUTES
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Get SPV List untuk Sales (Public, bisa diakses tanpa auth)
Route::get('/api/spv-list', [BookingController::class, 'getSPVList'])->name('api.spv.list');

// Booking from welcome page (Only authenticated users, preferably Sales)
Route::post('/booking/store', [BookingController::class, 'store'])
    ->middleware('auth')
    ->name('booking.store');

// PUBLIC: Booking from welcome page (Sales submit booking)
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

// AUTHENTICATION ROUTES
require __DIR__ . '/auth.php';

// DASHBOARD ROUTE - Admin, SPV, & Branch Manager
Route::middleware(['auth', 'role:admin,spv,branch_manager'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // API: Booking management
    Route::prefix('api/bookings')->name('api.bookings.')->group(function () {
        Route::get('/', [BookingController::class, 'index']);
        Route::post('/manual', [BookingController::class, 'storeManual'])->name('manual');

        Route::put('/{id}/status', [BookingController::class, 'updateStatus'])
            ->name('update-status');

        Route::get('/customers', [BookingController::class, 'getCustomerData'])->name('customers');
        Route::get('/staff', [BookingController::class, 'getStaffData'])->name('staff');

        Route::put('/customers/update', [BookingController::class, 'updateCustomer'])
            ->middleware('role:admin,spv')
            ->name('customers.update');
        Route::delete('/customers/delete', [BookingController::class, 'deleteCustomer'])
            ->middleware('role:admin,spv')
            ->name('customers.delete');

        Route::get(
            '/customers/{email}/checksheet-summary',
            [CheckSheetController::class, 'getChecksheetSummaryByEmail']
        )
            ->name('customers.checksheet-summary');
    });
});

// CHECKSHEET ROUTE - Admin & Security only
Route::middleware(['auth', 'role:admin,security'])->group(function () {
    Route::get('/checksheet', [CheckSheetController::class, 'index'])->name('checksheet');

    // Checksheet operations
    Route::get('/checksheet/export', [CheckSheetController::class, 'export'])->name('checksheet.export');
    Route::post('/checksheet/store', [CheckSheetController::class, 'store'])->name('checksheet.store');
    Route::get('/checksheet/{id}', [CheckSheetController::class, 'show'])->name('checksheet.show');
    Route::put('/checksheet/{id}', [CheckSheetController::class, 'update'])->name('checksheet.update');
    Route::delete('/checksheet/{id}', [CheckSheetController::class, 'destroy'])->name('checksheet.destroy');

    // API: Get checksheets
    Route::get('/api/checksheets', [CheckSheetController::class, 'getChecksheets'])->name('api.checksheets');
});

// COMMON AUTHENTICATED ROUTES
Route::middleware(['auth'])->group(function () {
    // Profile settings (all authenticated users)
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    // Notifications (all authenticated users)
    Route::get('/api/notifications', [BookingController::class, 'getNotifications'])->name('api.notifications');
    Route::get('/api/notifications/new', [BookingController::class, 'getNewNotifications'])->name('api.notifications.new');
    Route::post('/api/notifications/{id}/read', [BookingController::class, 'markNotificationRead'])->name('api.notifications.read');
});

Route::get('/api/vehicle-status', [BookingController::class, 'getVehicleStatus'])
    ->name('api.vehicle.status');

Route::put('/pameran/{id}', [BookingController::class, 'updatePameranBooking'])
    ->middleware('role:admin,spv')
    ->name('pameran.update');

// PAMERAN INFO ROUTE - Admin & Security only
Route::middleware(['auth', 'role:admin,security'])->group(function () {
    Route::get('/pameran-info', [PameranInfoController::class, 'index'])->name('pameran-info');
    
    // API: Pameran Info operations
    Route::get('/api/pameran-info', [PameranInfoController::class, 'getPameranBookings'])->name('api.pameran-info');
    Route::get('/api/pameran-info/{id}', [PameranInfoController::class, 'show'])->name('api.pameran-info.show');
    Route::put('/api/pameran-info/{id}/status', [PameranInfoController::class, 'updateStatus'])->name('api.pameran-info.update-status');
});