@extends('admin.layouts.app')
@section('title', 'Motor Models')

@section('content')
<div class="table-card">
  <div class="table-header">
    <h3>Daftar Motor Model ({{ $models->count() }})</h3>
    <a href="/admin/motor-models/create" class="btn btn-primary">+ Tambah Model</a>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Model</th>
          <th>Brand</th>
          <th>Jumlah Produk</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($models as $i => $model)
        <tr>
          <td style="color:#94a3b8;">{{ $i + 1 }}</td>
          <td><strong>{{ $model->name }}</strong></td>
          <td><span class="badge badge-ice">{{ $model->brand->name ?? '-' }}</span></td>
          <td><span class="badge badge-green">{{ $model->products_count }} produk</span></td>
          <td>
            <div class="btn-group">
              <a href="/admin/motor-models/{{ $model->id }}/edit" class="btn btn-sm btn-edit">✏️ Edit</a>
              <form method="POST" action="/admin/motor-models/{{ $model->id }}" onsubmit="return confirm('Hapus model ini?')">
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
              <div class="icon">🏍️</div>
              <p>Belum ada model motor. <a href="/admin/motor-models/create">Tambah sekarang</a></p>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
