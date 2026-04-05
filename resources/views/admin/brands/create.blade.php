@extends('admin.layouts.app')
@section('title', 'Tambah Brand')

@section('content')
<div class="form-card">
  <form method="POST" action="/admin/brands">
    @csrf
    <div class="form-group">
      <label for="name">Nama Brand</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Honda, Yamaha" required>
      <div class="help">Masukkan nama brand motor seperti Honda, Yamaha, Suzuki, dll.</div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">💾 Simpan Brand</button>
      <a href="/admin/brands" class="btn btn-outline">← Kembali</a>
    </div>
  </form>
</div>
@endsection
