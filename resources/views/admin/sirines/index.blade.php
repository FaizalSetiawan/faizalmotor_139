@extends('admin.layouts.app')
@section('title', 'Sirine')

@section('content')
<div class="table-card">
  <div class="table-header">
    <h3>Daftar Sirine ({{ $sirines->total() }})</h3>
    <a href="/admin/sirines/create" class="btn btn-primary">+ Tambah Sirine</a>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Nama Sirine</th>
          <th>Harga</th>
          <th>Media</th>
          <th>Marketplace</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($sirines as $sirine)
        <tr>
          <td><img src="{{ $sirine->image ? Storage::url($sirine->image) : asset('placeholder.png') }}" class="thumb" alt="{{ $sirine->name }}"></td>
          <td>
            <strong>{{ $sirine->name }}</strong>
            <div class="product-desc-preview">
              {{ Str::limit($sirine->description, 70) }}
            </div>
          </td>
          <td><strong class="price-text">Rp {{ number_format($sirine->price, 0, ',', '.') }}</strong></td>
          <td>
            <div class="model-name-preview">{{ 1 + count($sirine->gallery_images ?? []) }} foto</div>
            <div class="product-desc-preview">{{ count($sirine->gallery_videos ?? []) }} video</div>
          </td>
          <td>
            @php
              $stores = collect([
                'Shopee' => $sirine->shopee_url,
                'TikTok' => $sirine->tiktokshop_url,
                'Tokopedia' => $sirine->tokopedia_url,
              ])->filter();
            @endphp
            @if($stores->isNotEmpty())
              <div class="product-desc-preview">{{ $stores->keys()->join(', ') }}</div>
            @else
              <span class="shopee-empty">-</span>
            @endif
          </td>
          <td class="created-date">{{ $sirine->created_at->format('d M Y') }}</td>
          <td>
            <div class="btn-group">
              <a href="/admin/sirines/{{ $sirine->id }}/edit" class="btn btn-sm btn-edit">Edit</a>
              <form method="POST" action="/admin/sirines/{{ $sirine->id }}" onsubmit="return confirm('Hapus sirine ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7">
            <div class="empty">
              <div class="icon">🔊</div>
              <p>Belum ada sirine. <a href="/admin/sirines/create">Tambah sekarang</a></p>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@if($sirines->hasPages())
  <div class="admin-pagination-wrap">
    {{ $sirines->onEachSide(1)->links() }}
  </div>
@endif
@endsection
