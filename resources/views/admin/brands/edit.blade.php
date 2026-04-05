@extends('admin.layouts.app')
@section('title', 'Edit Brand')

@section('content')
<div class="form-card">
  <form method="POST" action="/admin/brands/{{ $brand->id }}">
    @csrf @method('PUT')
    <div class="form-group">
      <label for="name">Nama Brand</label>
      <input type="text" id="name" name="name" value="{{ old('name', $brand->name) }}" required>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">💾 Update Brand</button>
      <a href="/admin/brands" class="btn btn-outline">← Kembali</a>
    </div>
  </form>
</div>
@endsection
