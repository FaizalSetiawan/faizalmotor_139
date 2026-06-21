@extends('admin.layouts.app')
@section('title', 'Tambah Sirine')

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

  .media-preview-empty {
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
  <form method="POST" action="/admin/sirines" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="name">Nama Sirine</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Sirine Polisi 12V" required>
    </div>
    <div class="form-group">
      <label for="image">Foto Utama Sirine</label>
      <input type="file" id="image" name="image" accept="image/*" required>
      <div class="help">Format: JPG, PNG, WebP. Maksimal 2MB. Gambar akan otomatis dikompres ke WebP agar upload lebih cepat.</div>
      <div class="preview-wrap">
        <img id="imagePreview" src="" alt="Preview gambar sirine" class="preview-image">
      </div>
    </div>
    <div class="form-group">
      <label for="gallery_images">Foto Tambahan</label>
      <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
      <div class="help">Maksimal 8 foto tambahan, masing-masing 2MB. Preview dibatasi agar browser admin tetap ringan.</div>
      <div id="galleryImagesPreview" class="media-preview-grid"></div>
      <p id="galleryImagesEmpty" class="media-preview-empty">Belum ada foto tambahan yang dipilih.</p>
    </div>
    <div class="form-group">
      <label for="gallery_videos">Video Sirine</label>
      <input type="file" id="gallery_videos" name="gallery_videos[]" accept="video/mp4,video/webm,video/quicktime" multiple>
      <div class="help">Opsional. Maksimal 2 video, masing-masing 20MB, agar tidak membuat hosting shared lambat atau timeout.</div>
      <ul id="galleryVideosPreview" class="file-list"></ul>
      <p id="galleryVideosEmpty" class="media-preview-empty">Belum ada video yang dipilih.</p>
    </div>
    <div class="form-group">
      <label for="description">Deskripsi</label>
      <textarea id="description" name="description" placeholder="Deskripsikan sirine ini dengan poin atau baris baru...">{{ old('description') }}</textarea>
      <div class="help">Deskripsi yang panjang akan ditampilkan lebih rapi di halaman detail.</div>
    </div>
    <div class="form-group">
      <label for="english_description">Deskripsi English</label>
      <textarea id="english_description" name="english_description" placeholder="Describe this siren in English...">{{ old('english_description') }}</textarea>
      <div class="help">Opsional, tapi isi jika Anda ingin halaman English menampilkan deskripsi yang benar.</div>
    </div>
    <div class="form-group">
      <label for="price">Harga (Rp)</label>
      <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="Contoh: 350000" required>
    </div>
    <div class="form-group">
      <label for="shopee_url">Link Shopee</label>
      <input type="url" id="shopee_url" name="shopee_url" value="{{ old('shopee_url') }}" placeholder="https://shopee.co.id/...">
    </div>
    <div class="form-group">
      <label for="tiktokshop_url">Link TikTok Shop</label>
      <input type="url" id="tiktokshop_url" name="tiktokshop_url" value="{{ old('tiktokshop_url') }}" placeholder="https://www.tiktok.com/...">
    </div>
    <div class="form-group">
      <label for="tokopedia_url">Link Tokopedia</label>
      <input type="url" id="tokopedia_url" name="tokopedia_url" value="{{ old('tokopedia_url') }}" placeholder="https://www.tokopedia.com/...">
      <div class="help">Semua link marketplace bersifat opsional.</div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Simpan Sirine</button>
      <a href="/admin/sirines" class="btn btn-outline">Kembali</a>
    </div>
  </form>
</div>
<script>
  const createImageInput = document.getElementById('image');
  const createPreview = document.getElementById('imagePreview');
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
        item.textContent = 'Video ' + (index + 1) + ': ' + file.name + ' (' + formatBytes(file.size) + ')';
        list.appendChild(item);
      });
    });
  }

  if (createImageInput && createPreview) {
    createImageInput.addEventListener('change', function (event) {
      const [file] = event.target.files;
      if (!file) {
        createPreview.classList.remove('is-visible');
        createPreview.src = '';
        return;
      }

      createPreview.src = URL.createObjectURL(file);
      createPreview.classList.add('is-visible');
    });
  }

  renderImagePreview('gallery_images', 'galleryImagesPreview', 'galleryImagesEmpty', 'Foto');
  renderVideoList('gallery_videos', 'galleryVideosPreview', 'galleryVideosEmpty');
</script>
@endsection
