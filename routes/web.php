<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//medicament
Route::get('/medicaments', [\App\Http\Controllers\Medicament\MedicamentController::class, 'index'])->name('medicaments.index');
Route::get('/medicaments/create', [\App\Http\Controllers\Medicament\MedicamentController::class, 'create'])->name('medicaments.create');
Route::post('/medicaments', [\App\Http\Controllers\Medicament\MedicamentController::class, 'store'])->name('medicaments.store');
Route::get('/medicaments/{id}/edit', [\App\Http\Controllers\Medicament\MedicamentController::class, 'edit'])->name('medicaments.edit');
Route::put('/medicaments/{id}', [\App\Http\Controllers\Medicament\MedicamentController::class, 'update'])->name('medicaments.update');
Route::delete('/medicaments/{id}', [\App\Http\Controllers\Medicament\MedicamentController::class, 'destroy'])->name('medicaments.destroy');
Route::get('/medicaments/{id}', [\App\Http\Controllers\Medicament\MedicamentController::class, 'show'])->name('medicaments.show');

//commande
Route::get('/commandes', [\App\Http\Controllers\Commande\CommandeController::class, 'index'])->name('commandes.index');
Route::get('/commandes/create', [\App\Http\Controllers\Commande\CommandeController::class, 'create'])->name('commandes.create');
Route::post('/commandes', [\App\Http\Controllers\Commande\CommandeController::class, 'store'])->name('commandes.store');
Route::get('/commandes/{id}/edit', [\App\Http\Controllers\Commande\CommandeController::class, 'edit'])->name('commandes.edit');
Route::put('/commandes/{id}', [\App\Http\Controllers\Commande\CommandeController::class, 'update'])->name('commandes.update');
Route::delete('/commandes/{id}', [\App\Http\Controllers\Commande\CommandeController::class, 'destroy'])->name('commandes.destroy');
Route::get('/commandes/{id}', [\App\Http\Controllers\Commande\CommandeController::class, 'show'])->name('commandes.show');
//category
Route::get('/categories', [\App\Http\Controllers\Category\CategryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [\App\Http\Controllers\Category\CategryController::class, 'create'])->name('categories.create');
Route::post('/categories', [\App\Http\Controllers\Category\CategryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}/edit', [\App\Http\Controllers\Category\CategryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [\App\Http\Controllers\Category\CategryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [\App\Http\Controllers\Category\CategryController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/{id}', [\App\Http\Controllers\Category\CategryController::class, 'show'])->name('categories.show');

require __DIR__.'/auth.php';
