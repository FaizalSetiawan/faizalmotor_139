<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\MotorModel;
use Illuminate\Http\Request;

class MotorModelController extends Controller
{
    public function index()
    {
        $models = MotorModel::with('brand')->withCount('products')->get();

        return view('admin.motor-models.index', compact('models'));
    }

    public function create()
    {
        $brands = Brand::all();

        return view('admin.motor-models.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
        ]);

        MotorModel::create([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
        ]);

        return redirect('/admin/motor-models')->with('success', 'Motor model berhasil ditambahkan!');
    }

    public function edit(MotorModel $motorModel)
    {
        $brands = Brand::all();
        $model = $motorModel;

        return view('admin.motor-models.edit', compact('model', 'brands'));
    }

    public function update(Request $request, MotorModel $motorModel)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
        ]);

        $motorModel->update([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
        ]);

        return redirect('/admin/motor-models')->with('success', 'Motor model berhasil diupdate!');
    }

    public function destroy(MotorModel $motorModel)
    {
        $motorModel->delete();

        return redirect('/admin/motor-models')->with('success', 'Motor model berhasil dihapus!');
    }
}
