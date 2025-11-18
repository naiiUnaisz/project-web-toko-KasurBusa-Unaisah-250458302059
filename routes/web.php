<?php

use App\Livewire\Admin\ManageSizes;
use App\Livewire\Admin\ManageBrands;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ManageKategori;
use App\Livewire\Admin\ManageJenisBusa;
use App\Http\Controllers\ProfileController;

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

// Route Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/kategori', ManageKategori::class)->name('categories');
    Route::get('/brands', ManageBrands::class)->name('brands');
    Route::get('/FoamType', ManageJenisBusa::class)->name('foam-types');
    Route::get('/Size', ManageSizes::class)->name('sizes');
});

require __DIR__.'/auth.php';
