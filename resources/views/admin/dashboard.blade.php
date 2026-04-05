@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon ice">🏭</div>
    <div class="stat-info">
      <h4>Total Brands</h4>
      <div class="num">{{ $brandsCount }}</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon green">🏍️</div>
    <div class="stat-info">
      <h4>Motor Models</h4>
      <div class="num">{{ $modelsCount }}</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon amber">💡</div>
    <div class="stat-info">
      <h4>Total Products</h4>
      <div class="num">{{ $productsCount }}</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon purple">👥</div>
    <div class="stat-info">
      <h4>Users</h4>
      <div class="num">{{ $usersCount }}</div>
    </div>
  </div>
</div>

<!-- RECENT PRODUCTS -->
<div class="table-card">
  <div class="table-header">
    <h3>Produk Terbaru</h3>
    <a href="/admin/products" class="btn btn-sm btn-outline">Lihat Semua →</a>
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
        </tr>
      </thead>
      <tbody>
        @forelse($recentProducts as $p)
        <tr>
          <td><img src="{{ asset('storage/' . $p->image) }}" class="thumb" alt=""></td>
          <td><strong>{{ $p->name }}</strong></td>
          <td>
            <span class="badge badge-ice">{{ $p->model->brand->name ?? '-' }}</span>
            {{ $p->model->name ?? '-' }}
          </td>
          <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
          <td style="color:#94a3b8; font-size:13px;">{{ $p->created_at->format('d M Y') }}</td>
        </tr>
        @empty
        <tr><td colspan="5" class="empty"><p>Belum ada produk</p></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
