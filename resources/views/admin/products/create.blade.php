@extends('admin.layouts.app')
@section('title', 'Tambah Produk')

@section('content')
<div class="form-card">
  <form method="POST" action="/admin/products" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="motor_model_id">Motor Model</label>
      <select id="motor_model_id" name="motor_model_id" required>
        <option value="">— Pilih Motor —</option>
        @foreach($models as $m)
          <option value="{{ $m->id }}" {{ old('motor_model_id') == $m->id ? 'selected' : '' }}>
            {{ $m->brand->name }} — {{ $m->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="name">Nama Produk</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Custom LED Projector NMAX" required>
    </div>
    <div class="form-group">
      <label for="image">Gambar Produk</label>
      <input type="file" id="image" name="image" accept="image/*" required>
      <div class="help">Format: JPG, PNG, WebP. Max: 2MB</div>
    </div>
    <div class="form-group">
      <label for="description">Deskripsi</label>
      <textarea id="description" name="description" placeholder="Deskripsikan produk ini...">{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
      <label for="price">Harga (Rp)</label>
      <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="Contoh: 350000" required>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">💾 Simpan Produk</button>
      <a href="/admin/products" class="btn btn-outline">← Kembali</a>
    </div>
  </form>
</div>
@endsection