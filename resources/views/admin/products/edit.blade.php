@extends('admin.layouts.app')
@section('title', 'Edit Produk')

@section('content')
<div class="form-card">
  <form method="POST" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="form-group">
      <label for="motor_model_id">Motor Model</label>
      <select id="motor_model_id" name="motor_model_id" required>
        <option value="">— Pilih Motor —</option>
        @foreach($models as $m)
          <option value="{{ $m->id }}" {{ old('motor_model_id', $product->motor_model_id) == $m->id ? 'selected' : '' }}>
            {{ $m->brand->name }} — {{ $m->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="name">Nama Produk</label>
      <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
    </div>
    <div class="form-group">
      <label>Gambar Saat Ini</label>
      <div style="margin-bottom:8px;">
        <img src="{{ asset('storage/' . $product->image) }}" style="height:80px; border-radius:10px; border:2px solid #e2e8f0;">
      </div>
      <label for="image">Ganti Gambar (opsional)</label>
      <input type="file" id="image" name="image" accept="image/*">
      <div class="help">Kosongkan jika tidak ingin mengganti gambar</div>
    </div>
    <div class="form-group">
      <label for="description">Deskripsi</label>
      <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
    </div>
    <div class="form-group">
      <label for="price">Harga (Rp)</label>
      <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">💾 Update Produk</button>
      <a href="/admin/products" class="btn btn-outline">← Kembali</a>
    </div>
  </form>
</div>
@endsection
