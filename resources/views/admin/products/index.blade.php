@extends('admin.layouts.app')
@section('title', 'Products')

@section('content')
<div class="table-card">
  <div class="table-header">
    <h3>Daftar Produk ({{ $products->total() }})</h3>
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
          <th>Media</th>
          <th>Marketplace</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $p)
        <tr>
          <td><img src="{{ $p->image ? Storage::url($p->image) : asset('placeholder.png') }}" class="thumb" alt="{{ $p->name }}"></td>
          <td>
            <strong>{{ $p->name }}</strong>
            <div class="product-desc-preview">
              {{ Str::limit($p->description, 70) }}
            </div>
          </td>
          <td>
            <span class="badge badge-ice">{{ $p->model->brand->name ?? '-' }}</span>
            <div class="model-name-preview">{{ $p->model->name ?? '-' }}</div>
          </td>
          <td><strong class="price-text">Rp {{ number_format($p->price, 0, ',', '.') }}</strong></td>
          <td>
            <div class="model-name-preview">{{ 1 + count($p->gallery_images ?? []) }} foto</div>
            <div class="product-desc-preview">{{ count($p->gallery_videos ?? []) }} video</div>
          </td>
          <td>
            @php
              $stores = collect([
                'Shopee' => $p->shopee_url,
                'TikTok' => $p->tiktokshop_url,
                'Tokopedia' => $p->tokopedia_url,
              ])->filter();
            @endphp
            @if($stores->isNotEmpty())
              <div class="product-desc-preview">{{ $stores->keys()->join(', ') }}</div>
            @else
              <span class="shopee-empty">-</span>
            @endif
          </td>
          <td class="created-date">{{ $p->created_at->format('d M Y') }}</td>
          <td>
            <div class="btn-group">
              <a href="/admin/products/{{ $p->id }}/edit" class="btn btn-sm btn-edit">Edit</a>
              <form method="POST" action="/admin/products/{{ $p->id }}" onsubmit="return confirm('Hapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8">
            <div class="empty">
              <div class="icon">ðŸ’¡</div>
              <p>Belum ada produk. <a href="/admin/products/create">Tambah sekarang</a></p>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@if($products->hasPages())
  <div class="admin-pagination-wrap">
    {{ $products->onEachSide(1)->links() }}
  </div>
@endif
@endsection
