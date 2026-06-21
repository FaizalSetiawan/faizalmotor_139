<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sirine;
use App\Services\OptimizedMediaService;
use Illuminate\Http\Request;
use Throwable;

class SirineController extends Controller
{
    public function __construct(
        private OptimizedMediaService $mediaService
    ) {
    }

    public function index()
    {
        $sirines = Sirine::query()
            ->select(['id', 'name', 'image', 'gallery_images', 'gallery_videos', 'description', 'price', 'shopee_url', 'tiktokshop_url', 'tokopedia_url', 'created_at'])
            ->latest()
            ->paginate(15);

        return view('admin.sirines.index', compact('sirines'));
    }

    public function create()
    {
        return view('admin.sirines.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        $storedPaths = [];

        try {
            $imagePath = $this->mediaService->storeOptimizedImage($request->file('image'), 'sirines');
            $galleryImages = $this->mediaService->storeOptimizedImages($request->file('gallery_images', []), 'sirines/gallery/images');
            $galleryVideos = $this->mediaService->storeVideos($request->file('gallery_videos', []), 'sirines/gallery/videos');
            $storedPaths = array_merge([$imagePath], $galleryImages, $galleryVideos);

            Sirine::create([
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
                ->with('error', 'Upload sirine gagal diproses. Coba gunakan file yang lebih kecil.');
        }

        return redirect('/admin/sirines')->with('success', 'Sirine berhasil ditambahkan!');
    }

    public function edit(Sirine $sirine)
    {
        return view('admin.sirines.edit', compact('sirine'));
    }

    public function update(Request $request, Sirine $sirine)
    {
        $request->validate($this->rules(false));

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'english_description' => $request->english_description,
            'price' => $request->price,
            'shopee_url' => $request->shopee_url,
            'tiktokshop_url' => $request->tiktokshop_url,
            'tokopedia_url' => $request->tokopedia_url,
        ];

        $oldImage = $sirine->image;
        $oldGalleryImages = $sirine->gallery_images;
        $oldGalleryVideos = $sirine->gallery_videos;
        $storedPaths = [];

        try {
            if ($request->hasFile('image')) {
                $data['image'] = $this->mediaService->storeOptimizedImage($request->file('image'), 'sirines');
                $storedPaths[] = $data['image'];
            }

            if ($request->hasFile('gallery_images')) {
                $data['gallery_images'] = $this->mediaService->storeOptimizedImages($request->file('gallery_images', []), 'sirines/gallery/images');
                $storedPaths = array_merge($storedPaths, $data['gallery_images']);
            }

            if ($request->hasFile('gallery_videos')) {
                $data['gallery_videos'] = $this->mediaService->storeVideos($request->file('gallery_videos', []), 'sirines/gallery/videos');
                $storedPaths = array_merge($storedPaths, $data['gallery_videos']);
            }
        } catch (Throwable $exception) {
            $this->mediaService->deleteFiles($storedPaths);

            return back()
                ->withInput()
                ->with('error', 'Update media sirine gagal diproses. Coba gunakan file yang lebih kecil.');
        }

        $sirine->update($data);

        if (array_key_exists('image', $data) && $oldImage) {
            $this->mediaService->deleteFiles([$oldImage]);
        }

        if (array_key_exists('gallery_images', $data)) {
            $this->mediaService->deleteFiles($oldGalleryImages);
        }

        if (array_key_exists('gallery_videos', $data)) {
            $this->mediaService->deleteFiles($oldGalleryVideos);
        }

        return redirect('/admin/sirines')->with('success', 'Sirine berhasil diupdate!');
    }

    public function destroy(Sirine $sirine)
    {
        if ($sirine->image) {
            $this->mediaService->deleteFiles([$sirine->image]);
        }

        $this->mediaService->deleteFiles($sirine->gallery_images);
        $this->mediaService->deleteFiles($sirine->gallery_videos);

        $sirine->delete();

        return redirect('/admin/sirines')->with('success', 'Sirine berhasil dihapus!');
    }

    private function rules(bool $isCreate = true): array
    {
        return [
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

}
