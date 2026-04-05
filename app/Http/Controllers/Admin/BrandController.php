<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount(['models', 'models as products_count' => function ($q) {
            // This doesn't work directly, let's use a different approach
        }])->get();

        // Get brands with model count and product count
        $brands = Brand::withCount('models')->get();

        // Add products_count manually
        $brands->each(function ($brand) {
            $brand->products_count = $brand->models->sum(function ($model) {
                return $model->products()->count();
            });
        });

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
        ]);

        Brand::create(['name' => $request->name]);

        return redirect('/admin/brands')->with('success', 'Brand berhasil ditambahkan!');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
        ]);

        $brand->update(['name' => $request->name]);

        return redirect('/admin/brands')->with('success', 'Brand berhasil diupdate!');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect('/admin/brands')->with('success', 'Brand berhasil dihapus!');
    }
}
