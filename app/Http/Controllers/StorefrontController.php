<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\MotorModel;
use App\Models\Product;
use App\Models\Sirine;
use App\Support\CacheVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StorefrontController extends Controller
{
    public function home()
    {
        $version = CacheVersion::get(CacheVersion::HOME);
        $locale = app()->getLocale();

        $products = Cache::remember(
            'home:products:'.$locale.':v'.$version,
            now()->addMinutes(30),
            fn () => Product::query()
                ->select(['id', 'motor_model_id', 'name', 'image', 'description', 'price', 'shopee_url', 'tiktokshop_url', 'tokopedia_url', 'created_at'])
                ->with(['model:id,brand_id,name', 'model.brand:id,name'])
                ->latest()
                ->take(6)
                ->get()
        );

        $sirines = Cache::remember(
            'home:sirines:'.$locale.':v'.$version,
            now()->addMinutes(30),
            fn () => Sirine::query()
                ->select(['id', 'name', 'image', 'description', 'price', 'shopee_url', 'tiktokshop_url', 'tokopedia_url', 'created_at'])
                ->latest()
                ->take(6)
                ->get()
        );

        return view('welcome', compact('products', 'sirines'));
    }

    public function productDetail(int $id, string $slug)
    {
        $product = Product::with('model.brand')->findOrFail($id);

        $related = Product::with('model.brand')
            ->where('motor_model_id', $product->motor_model_id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('detail', compact('product', 'related'));
    }

    public function category(Request $request)
    {
        $catalogVersion = CacheVersion::get(CacheVersion::CATALOG);
        $modelsVersion  = CacheVersion::get(CacheVersion::MODELS);
        $sirinesVersion = CacheVersion::get(CacheVersion::SIRENS);

        // --- Tab: 'lampu' (default) | 'sirine' ---
        $tab = $request->query('tab', 'lampu');

        $brands = Cache::remember(
            'catalog:brands:v'.$modelsVersion,
            now()->addHours(6),
            fn () => Brand::query()->select(['id', 'name'])->orderBy('name')->get()
        );

        $brand        = null;
        $models       = collect();
        $modelFamilies = collect();
        $selectedFamily = $request->query('family');

        if ($tab === 'lampu' && $request->filled('brand')) {
            $brand = Brand::where('name', $request->brand)->first();

            if ($brand) {
                $models = Cache::remember(
                    'catalog:brand-models:'.$brand->id.':v'.$modelsVersion,
                    now()->addHours(6),
                    fn () => MotorModel::query()
                        ->select(['id', 'brand_id', 'name'])
                        ->where('brand_id', $brand->id)
                        ->orderBy('name')
                        ->get()
                );

                $selectedModel = $models->firstWhere('name', $request->query('model'));
                if (! $selectedFamily && $selectedModel) {
                    $selectedFamily = $selectedModel->family_name;
                }

                $modelFamilies = $models
                    ->groupBy(fn (MotorModel $model) => $model->family_name)
                    ->map(function ($group, $family) {
                        return [
                            'family' => $family,
                            'models' => $group->sortBy('name')->values(),
                        ];
                    })
                    ->sortKeys()
                    ->values();
            }
        }

        $familyModels = $selectedFamily
            ? $models->filter(fn (MotorModel $model) => $model->family_name === $selectedFamily)->values()
            : collect();

        // --- Products (Lampu Motor) ---
        $products = collect();
        if ($tab === 'lampu') {
            $productQuery = Product::query()
                ->select(['id', 'motor_model_id', 'name', 'image', 'description', 'price', 'shopee_url', 'tiktokshop_url', 'tokopedia_url', 'created_at'])
                ->with(['model:id,brand_id,name', 'model.brand:id,name']);

            if ($brand) {
                $productQuery->whereHas('model.brand', fn ($q) => $q->whereKey($brand->id));
            }

            if ($selectedFamily) {
                $familyIds = $familyModels->pluck('id');
                if ($familyIds->isNotEmpty()) {
                    $productQuery->whereIn('motor_model_id', $familyIds);
                }
            }

            if ($request->filled('model')) {
                $productQuery->whereHas('model', fn ($q) => $q->where('name', $request->model));
            }

            $direction = $request->sort === 'asc' ? 'asc' : ($request->sort === 'desc' ? 'desc' : null);
            $direction ? $productQuery->orderBy('price', $direction) : $productQuery->latest();

            $products = Cache::remember(
                'catalog:products:'.md5(json_encode([
                    'brand'  => $request->query('brand'),
                    'family' => $selectedFamily,
                    'model'  => $request->query('model'),
                    'sort'   => $request->query('sort'),
                    'page'   => $request->query('page', 1),
                    'locale' => app()->getLocale(),
                ])).':v'.$catalogVersion,
                now()->addMinutes(15),
                fn () => $productQuery->paginate(12)->withQueryString()
            );
        }

        // --- Sirines ---
        $sirines = collect();
        if ($tab === 'sirine') {
            $page = $request->integer('page', 1);
            $sirines = Cache::remember(
                'sirines:catalog:'.$page.':'.app()->getLocale().':v'.$sirinesVersion,
                now()->addMinutes(15),
                fn () => Sirine::query()
                    ->select(['id', 'name', 'image', 'description', 'price', 'shopee_url', 'tiktokshop_url', 'tokopedia_url', 'created_at'])
                    ->latest()
                    ->paginate(12)
                    ->withQueryString()
            );
        }

        return view('kategori', [
            'brands'         => $brands,
            'models'         => $familyModels,
            'modelFamilies'  => $modelFamilies,
            'products'       => $products,
            'sirines'        => $sirines,
            'selectedFamily' => $selectedFamily,
            'tab'            => $tab,
        ]);
    }

    public function sirines()
    {
        $version = CacheVersion::get(CacheVersion::SIRENS);
        $page = request()->integer('page', 1);

        $sirines = Cache::remember(
            'sirines:list:'.$page.':'.app()->getLocale().':v'.$version,
            now()->addMinutes(15),
            fn () => Sirine::query()
                ->select(['id', 'name', 'image', 'description', 'price', 'shopee_url', 'tiktokshop_url', 'tokopedia_url', 'created_at'])
                ->latest()
                ->paginate(9)
        );

        return view('sirine', compact('sirines'));
    }

    public function sirineDetail(int $id, string $slug)
    {
        $sirine = Sirine::findOrFail($id);

        $related = Sirine::where('id', '!=', $sirine->id)
            ->latest()
            ->take(3)
            ->get();

        return view('sirine-detail', compact('sirine', 'related'));
    }

    public function lokasi()
    {
        return view('lokasi');
    }
}
