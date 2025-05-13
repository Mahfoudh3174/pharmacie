<?php

use App\Http\Controllers\Category\CategryController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Commande\CommandeController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\Fournisseur\FournisseurController;
use App\Http\Controllers\Medicament\MedicamentController ;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Medicaments routes
    Route::get('/medicaments', [MedicamentController::class, 'index'])->name('medicament.index');
    Route::get('/medicament/create', [MedicamentController::class, 'create'])->name('medicament.create');
    Route::post('/medicament', [MedicamentController::class, 'store'])->name('medicament.store');
    Route::get('/medicament/{id}', [MedicamentController::class, 'show'])->name('medicament.show');
    Route::get('/medicament/{id}/edit', [MedicamentController::class, 'edit'])->name('medicament.edit');
    Route::patch('/medicament/{id}', [MedicamentController::class, 'update'])->name('medicament.update');
    Route::delete('/medicament/{id}', [MedicamentController::class, 'destroy'])->name('medicament.destroy');
    
    
    // Categories routes
    Route::get('/categories', [CategryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}', [CategryController::class, 'show'])->name('category.show');
    Route::get('/category/{id}/edit', [CategryController::class, 'edit'])->name('category.edit');
    Route::patch('/category/{id}', [CategryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategryController::class, 'destroy'])->name('category.destroy');
    
    // Commandes routes
    Route::resource('commandes', CommandeController::class);
    
    // Fournisseurs routes
    Route::resource('fournisseurs',FournisseurController::class);
    
    // Factures routes
    Route::resource('factures', FactureController::class);
    
    // Users management
    Route::resource('users', UserController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
