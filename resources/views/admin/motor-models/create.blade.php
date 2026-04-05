@extends('admin.layouts.app')
@section('title', 'Tambah Motor Model')

@section('content')
<div class="form-card">
  <form method="POST" action="/admin/motor-models">
    @csrf
    <div class="form-group">
      <label for="brand_id">Brand</label>
      <select id="brand_id" name="brand_id" required>
        <option value="">— Pilih Brand —</option>
        @foreach($brands as $brand)
          <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
            {{ $brand->name }}
          </option>
        @endforeach
      </select>
      <div class="help">Pilih brand motor untuk model ini</div>
    </div>
    <div class="form-group">
      <label for="name">Nama Model</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Vario 125, NMAX 155" required>
      <div class="help">Masukkan nama model motor</div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">💾 Simpan Model</button>
      <a href="/admin/motor-models" class="btn btn-outline">← Kembali</a>
    </div>
  </form>
</div>
@endsection
