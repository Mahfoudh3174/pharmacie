<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\Category\CategryController;
use App\Http\Controllers\Commande\CommandeController;
use App\Http\Controllers\Medicament\MedicamentController ;
use App\Http\Controllers\Fournisseur\FournisseurController;

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

    // Users management
    Route::resource('users', UserController::class);
});

// Inventory routes
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/inventory/expired', [InventoryController::class, 'expired'])->name('inventory.expired');
Route::get('/inventory/low-stock', [InventoryController::class, 'lowStock'])->name('inventory.low-stock');
Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');

// Orders routes
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

// Reports route
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

// Settings route
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Pharmacy routes
    Route::get('/pharmacy/create', [PharmacyController::class, 'create'])->name('pharmacy.create');
    Route::post('/pharmacy', [PharmacyController::class, 'store'])->name('pharmacy.store');
    Route::get('/pharmacy/edit', [PharmacyController::class, 'edit'])->name('pharmacy.edit');
    Route::put('/pharmacy', [PharmacyController::class, 'update'])->name('pharmacy.update');
    
    // Pharmacy medication management
    Route::get('/pharmacy/medications', [PharmacyController::class, 'medications'])->name('pharmacy.medications');
    Route::get('/pharmacy/medications/{pharmacy}/edit/{medication}', [PharmacyController::class, 'editMedication'])->name('pharmacy.medications.edit');
    Route::put('/pharmacy/medications/{medication}', [PharmacyController::class, 'updateMedication'])->name('pharmacy.medications.update');
    Route::delete('/pharmacy/medications/{medication}', [PharmacyController::class, 'removeMedication'])->name('pharmacy.medications.destroy');
 
    Route::middleware(['auth'])->group(function () {
        Route::resource('medications', MedicationController::class);
    });
});


require __DIR__.'/auth.php';
