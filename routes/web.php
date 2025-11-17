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
    Route::get('/admin/kategori', ManageKategori::class)->name('admin.kategori');
    Route::get('/admin/brands', ManageBrands::class)->name('admin.brand');
    Route::get('/admin/FoamType', ManageJenisBusa::class)->name('admin.FoamType');
    Route::get('/admin/Size', ManageSizes::class)->name('admin.Size');
});

require __DIR__.'/auth.php';
