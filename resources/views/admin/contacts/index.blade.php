@extends('admin.layouts.app')

@section('title', 'Pesan Kontak')

@section('content')
<div style="background:var(--card-bg); padding:24px; border-radius:16px; box-shadow:var(--shadow);">
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <div>
      <h2 style="font-size:18px; margin-bottom:4px;">Riwayat Pesan Pengaduan</h2>
      <p style="color:var(--text-muted); font-size:14px;">Daftar keluhan dan pertanyaan dari customer website.</p>
    </div>
  </div>

  <div style="overflow-x:auto;">
    <table class="table">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Topik/Pesan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($contacts as $contact)
        <tr>
          <td style="white-space:nowrap;">{{ $contact->created_at->format('d M Y, H:i') }}</td>
          <td>
            <strong>{{ $contact->nama }}</strong><br>
            <span style="font-size:12px; color:var(--text-muted);">{{ $contact->telepon ?? '-' }}</span>
          </td>
          <td>{{ $contact->email }}</td>
          <td style="max-width:300px;">
            <p style="margin:0; text-overflow:ellipsis; overflow:hidden; white-space:nowrap; cursor:help;" title="{{ $contact->pesan }}">
              {{ $contact->pesan }}
            </p>
          </td>
          <td>
            <div style="display:flex; gap:8px;">
              <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan kontak ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" style="text-align:center; padding:24px; color:var(--text-muted);">
            Belum ada pesan kontak yang disubmit.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  
  <div style="margin-top:20px;">
    {{ $contacts->links() }}
  </div>
</div>
@endsection
