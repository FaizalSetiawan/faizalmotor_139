<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\MotorModelController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SirineController;
use App\Http\Controllers\ContactController;

Route::get('/locale/{locale}', LocaleController::class)->name('locale.switch');

Route::middleware(\App\Http\Middleware\SetLocale::class)->group(function () {
    Route::get('/', [StorefrontController::class, 'home']);

    Route::get('/product/{id}-{slug}', [StorefrontController::class, 'productDetail']);

    Route::get('/kategori', [StorefrontController::class, 'category']);

    Route::get('/sirine', fn () => redirect('/kategori?tab=sirine', 301));

    Route::get('/sirine/{id}-{slug}', [StorefrontController::class, 'sirineDetail']);

    Route::get('/lokasi', [StorefrontController::class, 'lokasi'])->name('lokasi');

    // KONTAK
    Route::get('/kontak', [ContactController::class, 'create'])->name('kontak.create');
    Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');
});

// ADMIN
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Brands
    Route::get('/brands', [BrandController::class, 'index'])->name('admin.brands.index');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('admin.brands.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('admin.brands.store');
    Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('admin.brands.edit');
    Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('admin.brands.update');
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('admin.brands.destroy');

    // Motor Models
    Route::get('/motor-models', [MotorModelController::class, 'index'])->name('admin.motor-models.index');
    Route::get('/motor-models/create', [MotorModelController::class, 'create'])->name('admin.motor-models.create');
    Route::post('/motor-models', [MotorModelController::class, 'store'])->name('admin.motor-models.store');
    Route::get('/motor-models/{motorModel}/edit', [MotorModelController::class, 'edit'])->name('admin.motor-models.edit');
    Route::put('/motor-models/{motorModel}', [MotorModelController::class, 'update'])->name('admin.motor-models.update');
    Route::delete('/motor-models/{motorModel}', [MotorModelController::class, 'destroy'])->name('admin.motor-models.destroy');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Sirines
    Route::get('/sirines', [SirineController::class, 'index'])->name('admin.sirines.index');
    Route::get('/sirines/create', [SirineController::class, 'create'])->name('admin.sirines.create');
    Route::post('/sirines', [SirineController::class, 'store'])->name('admin.sirines.store');
    Route::get('/sirines/{sirine}/edit', [SirineController::class, 'edit'])->name('admin.sirines.edit');
    Route::put('/sirines/{sirine}', [SirineController::class, 'update'])->name('admin.sirines.update');
    Route::delete('/sirines/{sirine}', [SirineController::class, 'destroy'])->name('admin.sirines.destroy');

    // Contacts
    Route::get('/contacts', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('admin.contacts.index');
    Route::delete('/contacts/{contact}', [\App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('admin.contacts.destroy');
});

// DASHBOARD (redirect to admin dashboard)
Route::redirect('/dashboard', '/admin/dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
