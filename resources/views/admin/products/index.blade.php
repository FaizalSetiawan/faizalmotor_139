@extends('admin.layouts.app')
@section('title', 'Products')

@section('content')
<div class="table-card">
  <div class="table-header">
    <h3>Daftar Produk ({{ $products->count() }})</h3>
    <a href="/admin/products/create" class="btn btn-primary">+ Tambah Produk</a>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Nama Produk</th>
          <th>Motor</th>
          <th>Harga</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $p)
        <tr>
          <td><img src="{{ asset('storage/' . $p->image) }}" class="thumb" alt=""></td>
          <td>
            <strong>{{ $p->name }}</strong>
            <div style="font-size:12px; color:#94a3b8; margin-top:2px;">
              {{ Str::limit($p->description, 50) }}
            </div>
          </td>
          <td>
            <span class="badge badge-ice">{{ $p->model->brand->name ?? '-' }}</span>
            <div style="font-size:13px; margin-top:4px;">{{ $p->model->name ?? '-' }}</div>
          </td>
          <td><strong style="color:var(--ice-600);">Rp {{ number_format($p->price, 0, ',', '.') }}</strong></td>
          <td style="color:#94a3b8; font-size:13px;">{{ $p->created_at->format('d M Y') }}</td>
          <td>
            <div class="btn-group">
              <a href="/admin/products/{{ $p->id }}/edit" class="btn btn-sm btn-edit">✏️ Edit</a>
              <form method="POST" action="/admin/products/{{ $p->id }}" onsubmit="return confirm('Hapus produk ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">🗑️ Hapus</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6">
            <div class="empty">
              <div class="icon">💡</div>
              <p>Belum ada produk. <a href="/admin/products/create">Tambah sekarang</a></p>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection