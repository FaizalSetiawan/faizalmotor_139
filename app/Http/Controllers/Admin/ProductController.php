<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MotorModel;
use App\Models\Product;
use App\Services\OptimizedMediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Throwable;

class ProductController extends Controller
{
    public function __construct(
        private OptimizedMediaService $mediaService
    ) {
    }

    public function index()
    {
        $products = Product::query()
            ->select(['id', 'motor_model_id', 'name', 'image', 'gallery_images', 'gallery_videos', 'description', 'price', 'shopee_url', 'tiktokshop_url', 'tokopedia_url', 'created_at'])
            ->with(['model:id,brand_id,name', 'model.brand:id,name'])
            ->latest()
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $models = $this->cachedModels();

        return view('admin.products.create', compact('models'));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        $storedPaths = [];

        try {
            $imagePath = $this->mediaService->storeOptimizedImage($request->file('image'), 'products');
            $galleryImages = $this->mediaService->storeOptimizedImages($request->file('gallery_images', []), 'products/gallery/images');
            $galleryVideos = $this->mediaService->storeVideos($request->file('gallery_videos', []), 'products/gallery/videos');
            $storedPaths = array_merge([$imagePath], $galleryImages, $galleryVideos);

            Product::create([
                'motor_model_id' => $request->motor_model_id,
                'name' => $request->name,
                'image' => $imagePath,
                'gallery_images' => $galleryImages,
                'gallery_videos' => $galleryVideos,
                'description' => $request->description,
                'english_description' => $request->english_description,
                'price' => $request->price,
                'shopee_url' => $request->shopee_url,
                'tiktokshop_url' => $request->tiktokshop_url,
                'tokopedia_url' => $request->tokopedia_url,
            ]);
        } catch (Throwable $exception) {
            $this->mediaService->deleteFiles($storedPaths);

            return back()
                ->withInput()
                ->with('error', 'Upload produk gagal diproses. Coba gunakan file yang lebih kecil.');
        }

        return redirect('/admin/products')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $models = $this->cachedModels();

        return view('admin.products.edit', compact('product', 'models'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate($this->rules(false));

        $data = [
            'motor_model_id' => $request->motor_model_id,
            'name' => $request->name,
            'description' => $request->description,
            'english_description' => $request->english_description,
            'price' => $request->price,
            'shopee_url' => $request->shopee_url,
            'tiktokshop_url' => $request->tiktokshop_url,
            'tokopedia_url' => $request->tokopedia_url,
        ];

        $oldImage = $product->image;
        $oldGalleryImages = $product->gallery_images;
        $oldGalleryVideos = $product->gallery_videos;
        $storedPaths = [];

        try {
            if ($request->hasFile('image')) {
                $data['image'] = $this->mediaService->storeOptimizedImage($request->file('image'), 'products');
                $storedPaths[] = $data['image'];
            }

            if ($request->hasFile('gallery_images')) {
                $data['gallery_images'] = $this->mediaService->storeOptimizedImages($request->file('gallery_images', []), 'products/gallery/images');
                $storedPaths = array_merge($storedPaths, $data['gallery_images']);
            }

            if ($request->hasFile('gallery_videos')) {
                $data['gallery_videos'] = $this->mediaService->storeVideos($request->file('gallery_videos', []), 'products/gallery/videos');
                $storedPaths = array_merge($storedPaths, $data['gallery_videos']);
            }
        } catch (Throwable $exception) {
            $this->mediaService->deleteFiles($storedPaths);

            return back()
                ->withInput()
                ->with('error', 'Update media produk gagal diproses. Coba gunakan file yang lebih kecil.');
        }

        $product->update($data);

        if (array_key_exists('image', $data) && $oldImage) {
            $this->mediaService->deleteFiles([$oldImage]);
        }

        if (array_key_exists('gallery_images', $data)) {
            $this->mediaService->deleteFiles($oldGalleryImages);
        }

        if (array_key_exists('gallery_videos', $data)) {
            $this->mediaService->deleteFiles($oldGalleryVideos);
        }

        return redirect('/admin/products')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            $this->mediaService->deleteFiles([$product->image]);
        }

        $this->mediaService->deleteFiles($product->gallery_images);
        $this->mediaService->deleteFiles($product->gallery_videos);

        $product->delete();

        return redirect('/admin/products')->with('success', 'Produk berhasil dihapus!');
    }

    private function rules(bool $isCreate = true): array
    {
        return [
            'motor_model_id' => 'required|exists:motor_models,id',
            'name' => 'required|string|max:255',
            'image' => ($isCreate ? 'required' : 'nullable') . '|image|max:'.OptimizedMediaService::MAIN_IMAGE_MAX_KB,
            'gallery_images' => 'nullable|array|max:'.OptimizedMediaService::MAX_GALLERY_IMAGES,
            'gallery_images.*' => 'nullable|image|max:'.OptimizedMediaService::GALLERY_IMAGE_MAX_KB,
            'gallery_videos' => 'nullable|array|max:'.OptimizedMediaService::MAX_GALLERY_VIDEOS,
            'gallery_videos.*' => 'nullable|mimetypes:video/mp4,video/webm,video/quicktime|max:'.OptimizedMediaService::VIDEO_MAX_KB,
            'description' => 'required|string',
            'english_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'shopee_url' => 'nullable|url|max:2048',
            'tiktokshop_url' => 'nullable|url|max:2048',
            'tokopedia_url' => 'nullable|url|max:2048',
        ];
    }

    private function cachedModels()
    {
        $version = \App\Support\CacheVersion::get(\App\Support\CacheVersion::MODELS);

        return Cache::remember(
            'admin:product-models:v'.$version,
            now()->addHours(6),
            fn () => MotorModel::query()
                ->select(['id', 'brand_id', 'name'])
                ->with('brand:id,name')
                ->orderBy('name')
                ->get()
        );
    }
}
