@extends('admin.layouts.app')
@section('title', 'Brands')

@section('content')
<div class="table-card">
  <div class="table-header">
    <h3>Daftar Brand ({{ $brands->count() }})</h3>
    <a href="/admin/brands/create" class="btn btn-primary">+ Tambah Brand</a>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Brand</th>
          <th>Jumlah Model</th>
          <th>Jumlah Produk</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($brands as $i => $brand)
        <tr>
          <td style="color:#94a3b8;">{{ $i + 1 }}</td>
          <td><strong>{{ $brand->name }}</strong></td>
          <td><span class="badge badge-ice">{{ $brand->models_count }} model</span></td>
          <td><span class="badge badge-green">{{ $brand->products_count }} produk</span></td>
          <td>
            <div class="btn-group">
              <a href="/admin/brands/{{ $brand->id }}/edit" class="btn btn-sm btn-edit">✏️ Edit</a>
              <form method="POST" action="/admin/brands/{{ $brand->id }}" onsubmit="return confirm('Hapus brand ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">🗑️ Hapus</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5">
            <div class="empty">
              <div class="icon">🏭</div>
              <p>Belum ada brand. <a href="/admin/brands/create">Tambah sekarang</a></p>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
