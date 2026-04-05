<?php

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\MotorModelController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\MotorModel;

Route::get('/', function () {
    $products = Product::latest()->take(6)->get();
    return view('welcome', compact('products'));
});

Route::get('/product/{id}-{slug}', function ($id, $slug) {
    $product = Product::findOrFail($id);

    $related = Product::where('motor_model_id', $product->motor_model_id)
        ->where('id', '!=', $product->id)
        ->take(3)
        ->get();

    return view('detail', compact('product', 'related'));
});

Route::get('/kategori', function (Request $request) {
    $brands = Brand::all();
    $models = MotorModel::all();
    
    $products = Product::query();
    
    if ($request->filled('brand')) {
        $products->whereHas('model.brand', function ($q) use ($request) {
            $q->where('name', $request->brand);
        });
    }
    
    if ($request->filled('model')) {
        $products->whereHas('model', function ($q) use ($request) {
            $q->where('name', $request->model);
        });
    }
    
    if ($request->filled('sort')) {
        $direction = $request->sort === 'asc' ? 'asc' : 'desc';
        $products->orderBy('price', $direction);
    }
    
    $products = $products->get();
    
    return view('kategori', compact('brands', 'models', 'products'));
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
});

// DASHBOARD (redirect to admin dashboard)
Route::get('/dashboard', function () {
    return redirect('/admin/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
