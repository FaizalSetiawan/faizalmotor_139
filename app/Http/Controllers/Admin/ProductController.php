<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\MotorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('model.brand')->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $models = MotorModel::with('brand')->get();

        return view('admin.products.create', compact('models'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'motor_model_id' => 'required|exists:motor_models,id',
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $image = $request->file('image')->store('products', 'public');

        Product::create([
            'motor_model_id' => $request->motor_model_id,
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect('/admin/products')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $models = MotorModel::with('brand')->get();

        return view('admin.products.edit', compact('product', 'models'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'motor_model_id' => 'required|exists:motor_models,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $data = [
            'motor_model_id' => $request->motor_model_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect('/admin/products')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect('/admin/products')->with('success', 'Produk berhasil dihapus!');
    }
}