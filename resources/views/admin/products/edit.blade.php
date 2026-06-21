@extends('admin.layouts.app')
@section('title', 'Edit Produk')

@section('content')
<style>
  .media-preview-grid {
    margin-top: 14px;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 12px;
  }

  .media-preview-card {
    border: 1px solid #dbe7f1;
    border-radius: 16px;
    overflow: hidden;
    background: #f8fbfe;
  }

  .media-preview-card img,
  .media-preview-card video {
    width: 100%;
    height: 120px;
    object-fit: cover;
    display: block;
    background: #e2e8f0;
  }

  .media-preview-card span {
    display: block;
    padding: 8px 10px;
    font-size: 12px;
    font-weight: 600;
    color: #334155;
    text-align: center;
  }

  .media-preview-empty,
  .media-preview-label {
    margin-top: 12px;
    font-size: 13px;
    color: #64748b;
  }

  .file-list {
    margin-top: 12px;
    padding-left: 18px;
    color: #475569;
    font-size: 13px;
  }

  .file-list li + li {
    margin-top: 6px;
  }
</style>

<div class="form-card">
  <form method="POST" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="motor_model_id">Motor Model</label>
      <select id="motor_model_id" name="motor_model_id" required>
        <option value="">- Pilih Motor -</option>
        @foreach($models as $m)
          <option value="{{ $m->id }}" {{ old('motor_model_id', $product->motor_model_id) == $m->id ? 'selected' : '' }}>
            {{ $m->brand->name }} - {{ $m->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="name">Nama Produk</label>
      <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
    </div>
    <div class="form-group">
      <label>Foto Utama Saat Ini</label>
      <div class="current-image-wrap">
        <img id="imagePreview" src="{{ $product->image ? Storage::url($product->image) : asset('placeholder.png') }}" class="preview-image is-visible" alt="{{ $product->name }}">
      </div>
      <label for="image">Ganti Foto Utama (opsional)</label>
      <input type="file" id="image" name="image" accept="image/*">
      <div class="help">Kosongkan jika tidak ingin mengganti foto utama. Jika diganti, gambar akan dikompres ke WebP maksimal 2MB.</div>
    </div>
    <div class="form-group">
      <label>Foto Tambahan Tersimpan</label>
      @if(!empty($product->gallery_images))
        <div class="media-preview-grid">
          @foreach($product->gallery_images as $image)
            <div class="media-preview-card">
              <img src="{{ Storage::url($image) }}" alt="Foto tambahan {{ $loop->iteration }}">
              <span>Foto {{ $loop->iteration }}</span>
            </div>
          @endforeach
        </div>
      @else
        <p class="media-preview-empty">Belum ada foto tambahan tersimpan.</p>
      @endif
      <label for="gallery_images" class="media-preview-label">Ganti Foto Tambahan (opsional)</label>
      <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
      <div class="help">Upload ulang jika ingin mengganti seluruh foto tambahan. Maksimal 8 foto, masing-masing 2MB.</div>
      <div id="galleryImagesPreview" class="media-preview-grid"></div>
      <p id="galleryImagesEmpty" class="media-preview-empty">Belum ada foto tambahan baru yang dipilih.</p>
    </div>
    <div class="form-group">
      <label>Video Tersimpan</label>
      @if(!empty($product->gallery_videos))
        <div class="media-preview-grid">
          @foreach($product->gallery_videos as $video)
            <div class="media-preview-card">
              <video src="{{ Storage::url($video) }}" controls muted></video>
              <span>Video {{ $loop->iteration }}</span>
            </div>
          @endforeach
        </div>
      @else
        <p class="media-preview-empty">Belum ada video tersimpan.</p>
      @endif
      <label for="gallery_videos" class="media-preview-label">Ganti Video Produk (opsional)</label>
      <input type="file" id="gallery_videos" name="gallery_videos[]" accept="video/mp4,video/webm,video/quicktime" multiple>
      <div class="help">Upload ulang jika ingin mengganti seluruh video. Maksimal 2 video, masing-masing 20MB.</div>
      <ul id="galleryVideosPreview" class="file-list"></ul>
      <p id="galleryVideosEmpty" class="media-preview-empty">Belum ada video baru yang dipilih.</p>
    </div>
    <div class="form-group">
      <label for="description">Deskripsi</label>
      <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
      <div class="help">Deskripsi panjang akan otomatis dirapikan di halaman detail.</div>
    </div>
    <div class="form-group">
      <label for="english_description">Deskripsi English</label>
      <textarea id="english_description" name="english_description">{{ old('english_description', $product->english_description) }}</textarea>
      <div class="help">Isi agar user yang memilih English melihat deskripsi produk yang sesuai.</div>
    </div>
    <div class="form-group">
      <label for="price">Harga (Rp)</label>
      <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required>
    </div>
    <div class="form-group">
      <label for="shopee_url">Link Shopee</label>
      <input type="url" id="shopee_url" name="shopee_url" value="{{ old('shopee_url', $product->shopee_url) }}" placeholder="https://shopee.co.id/...">
    </div>
    <div class="form-group">
      <label for="tiktokshop_url">Link TikTok Shop</label>
      <input type="url" id="tiktokshop_url" name="tiktokshop_url" value="{{ old('tiktokshop_url', $product->tiktokshop_url) }}" placeholder="https://www.tiktok.com/...">
    </div>
    <div class="form-group">
      <label for="tokopedia_url">Link Tokopedia</label>
      <input type="url" id="tokopedia_url" name="tokopedia_url" value="{{ old('tokopedia_url', $product->tokopedia_url) }}" placeholder="https://www.tokopedia.com/...">
      <div class="help">Kosongkan link yang tidak dipakai.</div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Update Produk</button>
      <a href="/admin/products" class="btn btn-outline">Kembali</a>
    </div>
  </form>
</div>
<script>
  const editImageInput = document.getElementById('image');
  const editPreview = document.getElementById('imagePreview');
  const maxPreviewItems = 4;

  function formatBytes(bytes) {
    if (!bytes) return '0 KB';
    const units = ['B', 'KB', 'MB', 'GB'];
    const power = Math.min(Math.floor(Math.log(bytes) / Math.log(1024)), units.length - 1);
    const value = bytes / Math.pow(1024, power);

    return value.toFixed(power === 0 ? 0 : 1) + ' ' + units[power];
  }

  function renderImagePreview(inputId, gridId, emptyId, labelPrefix) {
    const input = document.getElementById(inputId);
    const grid = document.getElementById(gridId);
    const empty = document.getElementById(emptyId);

    if (!input || !grid || !empty) return;

    input.addEventListener('change', function (event) {
      grid.innerHTML = '';
      const files = Array.from(event.target.files || []);
      empty.style.display = files.length ? 'none' : 'block';

      files.slice(0, maxPreviewItems).forEach(function (file, index) {
        const card = document.createElement('div');
        card.className = 'media-preview-card';
        const url = URL.createObjectURL(file);
        const media = document.createElement('img');
        media.src = url;
        media.alt = file.name;
        card.appendChild(media);

        const label = document.createElement('span');
        label.textContent = labelPrefix + ' ' + (index + 1);
        card.appendChild(label);
        grid.appendChild(card);
      });

      if (files.length > maxPreviewItems) {
        const info = document.createElement('p');
        info.className = 'media-preview-empty';
        info.textContent = '+' + (files.length - maxPreviewItems) + ' file lain dipilih, tapi preview dibatasi supaya form tetap cepat.';
        grid.appendChild(info);
      }
    });
  }

  function renderVideoList(inputId, listId, emptyId) {
    const input = document.getElementById(inputId);
    const list = document.getElementById(listId);
    const empty = document.getElementById(emptyId);

    if (!input || !list || !empty) return;

    input.addEventListener('change', function (event) {
      list.innerHTML = '';
      const files = Array.from(event.target.files || []);
      empty.style.display = files.length ? 'none' : 'block';

      files.forEach(function (file, index) {
        const item = document.createElement('li');
        item.textContent = 'Video Baru ' + (index + 1) + ': ' + file.name + ' (' + formatBytes(file.size) + ')';
        list.appendChild(item);
      });
    });
  }

  if (editImageInput && editPreview) {
    editImageInput.addEventListener('change', function (event) {
      const [file] = event.target.files;
      if (!file) {
        editPreview.src = '{{ $product->image ? Storage::url($product->image) : asset('placeholder.png') }}';
        return;
      }

      editPreview.src = URL.createObjectURL(file);
    });
  }

  renderImagePreview('gallery_images', 'galleryImagesPreview', 'galleryImagesEmpty', 'Foto Baru');
  renderVideoList('gallery_videos', 'galleryVideosPreview', 'galleryVideosEmpty');
</script>
@endsection
