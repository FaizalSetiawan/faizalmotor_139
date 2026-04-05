<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>{{ $product->name }} - Faizal Motor 139</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Memuat CSS Global (termasuk .navbar, animasi, dsb) terlebih dahulu -->
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <!-- CSS Khusus Detail -->
  <link rel="stylesheet" href="{{ asset('detail/style.css') }}">
</head>
<body>

<!-- LOADING SCREEN -->
<div class="loading-screen" id="loadingScreen">
  <div class="loader-bulb">
    <div class="bulb"></div>
    <div class="base"></div>
    <div class="ray"></div>
    <div class="ray"></div>
    <div class="ray"></div>
    <div class="ray"></div>
    <div class="ray"></div>
  </div>
  <div class="loading-text">Memuat Produk <span>...</span></div>
  <div class="loading-bar"><div class="fill"></div></div>
</div>

<!-- BG DECORATIONS -->
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>
<div class="bg-orb bg-orb-3"></div>

<!-- NAVBAR GLOBAL -->
<div class="navbar" id="navbar">
  <div class="left">
    <a href="/" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
      <img src="{{ asset('img/faizalmotor_logo.png') }}" alt="Logo">
      <h1 style="margin:0;">Faizal Motor 139</h1>
    </a>
  </div>

  <ul>
    <li><a href="/">Beranda</a></li>
    <li><a href="/kategori">Kategori</a></li>
    <li><a href="#">Kontak</a></li>
  </ul>
</div>

<div style="max-width:1200px; margin:20px auto 0; padding:0 50px;">
  <a href="/kategori" class="back-btn">← Kembali ke Kategori</a>
</div>

<div class="detail-wrapper">

    <div class="detail-box fade-up">

        <!-- IMAGE -->
        <div class="detail-left">
            <img src="{{ asset('storage/' . $product->image) }}" class="main-img">
        </div>
    <div class="feature-section">
    <h2>Kenapa Pilih Produk Ini?</h2>

        <!-- INFO -->
        <div class="detail-right">
             <div class="feature-grid">
        <div class="feature-card">💡 Lebih Terang 200%</div>
        <div class="feature-card">🎨 Custom RGB</div>
        <div class="feature-card">⚙️ Plug & Play</div>
        <div class="feature-card">🔥 Desain Futuristik</div>
    </div>
</div>
            <!-- BADGE -->
<div class="badge">🔥 Custom Premium</div>

<h1>{{ $product->name }}</h1>

<p class="motor">Untuk Motor: {{ $product->model->name }}</p>

<div class="price">Rp {{ number_format($product->price) }}</div>
<div class="trust">
    ⭐ 4.9 Rating | 🔧 Dikerjakan Profesional | ⚡ Garansi 1 Bulan
</div>

<div class="divider"></div>

<p class="desc">
    {{ $product->description }}
</p>

<!-- FITUR -->
<ul class="fitur">
    <li>✔ LED Super Cerah (Blue Ice)</li>
    <li>✔ Projector Premium</li>
    <li>✔ Bisa Custom RGB</li>
    <li>✔ Plug & Play (Tanpa Ribet)</li>
</ul>

<!-- KEUNGGULAN -->
<div class="highlight">
     Hasil lebih terang dari standar pabrik  
     Tampilan lebih modern & futuristik  
</div>

<a href="https://wa.me/6281223466068?text={{ rawurlencode(
    "Halo kak, saya mau pesan {$product->name}\n" .
    "Motor: {$product->model->name}\n" .
    "Harga: Rp " . number_format($product->price)
) }}"
target="_blank"
class="btn-wa">
    Order via WhatsApp
</a>
</div>
    </div>

</div>
<h2 class="related-title">Produk Lainnya</h2>

<div class="related-grid">
@foreach($related as $r)
<a href="/product/{{ $r->id }}-{{ \Illuminate\Support\Str::slug($r->name) }}">
    <div class="related-card">
        <img src="{{ asset('storage/' . $r->image) }}">
        <h4>{{ $r->name }}</h4>
    </div>
</a>
@endforeach
</div>
<!-- ANIMASI -->
<script>
    // ANIMASI SCROLL & LOADING SCREEN
    window.addEventListener("load", () => {
      // Sembunyikan Loading Screen
      setTimeout(() => {
        document.getElementById('loadingScreen').classList.add('hide');
      }, 1200);

      // Munculkan kontainer utama
      const el = document.querySelector(".fade-up");
      setTimeout(() => {
        el.classList.add("show");
      }, 1400); // Muncul setelah loading selesai
    });

    // Navbar Auto Hide (mirip global script)
    let prevScroll = window.pageYOffset;
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      const currentScroll = window.pageYOffset;
      if (prevScroll > currentScroll) {
        navbar.style.top = '0';
      } else if (currentScroll > 100) {
        navbar.style.top = '-80px';
      }
      prevScroll = currentScroll;
    });
</script>

<!-- FLOATING WA BUTTON -->
<a href="https://wa.me/6281223466068?text={{ rawurlencode("Halo kak, saya mau tanya tentang custom lampu motor.") }}"
   target="_blank" class="float-wa">
  💬
  <div class="tooltip">Chat Admin Sekarang!</div>
</a>

</body>
</html>