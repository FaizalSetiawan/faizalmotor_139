@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Faizal Motor 139 - Bengkel Custom Lampu Motor Bandung</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Faizal Motor 139 melayani custom lampu motor, biled, projector, RGB, sirine, kelistrikan, service, dan sparepart motor di Bandung.">
  <link rel="icon" href="/img/faizalmotor_logo.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="/style.css">
</head>
<body class="has-bottom-nav">

<!-- SITE LOADER -->
<div class="site-loader" id="siteLoader">
  <div class="site-loader__badge"></div>
  <p>MEMUAT HALAMAN...</p>
</div>

<!-- MINIMAL MOBILE HEADER — only logo, hidden on desktop -->
<header class="mobile-brand-header">
  <a href="/">
    <img src="/img/faizalmotor_logo.png" alt="Faizal Motor 139">
    <strong>Faizal Motor 139</strong>
  </a>
</header>

<!-- 1. TOP BAR KECIL (desktop only, hidden mobile via CSS) -->
<div class="topbar-small">
  <div class="topbar-small__info">
    <span>
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
      Jl. Sukamenak Indah 139, Bandung Barat
    </span>
    <span>
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
      Senin–Sabtu 08.00–17.00
    </span>
  </div>
  <div class="topbar-small__contact">
    <span>
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
      WhatsApp: 0812-2346-6068
    </span>
  </div>
</div>

<!-- 2. NAVBAR BARU -->
<nav class="navbar-new">
  <a class="brandmark-new" href="/">
    <img src="/img/faizalmotor_logo.png" alt="Faizal Motor 139">
    <span>
      <strong>Faizal Motor 139</strong>
      <small>Custom Lampu & Sirine</small>
    </span>
  </a>

  <button class="nav-toggle-new" data-nav-toggle aria-expanded="false" aria-label="Toggle navigation">☰</button>

  <div class="navbar-new__menu" data-nav-menu>
    <a href="#beranda" class="is-active">Beranda</a>
    <a href="#layanan">Layanan</a>
    <a href="#katalog">Katalog Produk</a>
    <a href="#sirine">Sirine</a>
    <a href="#lokasi">Lokasi</a>
  </div>

  <div class="navbar-new__actions">
    <a class="btn-chat-admin" href="https://wa.me/6281223466068?text={{ rawurlencode('Halo Faizal Motor 139, saya ingin tanya-tanya custom lampu motor.') }}" target="_blank">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
      Chat Admin
    </a>
  </div>
</nav>

<!-- 3. HERO SECTION BARU -->
<section id="beranda" class="hero-new">
  <video class="hero-new__video" autoplay muted loop playsinline preload="metadata" aria-hidden="true" poster="/img/background.jpg">
    <source src="/img/section_hero_baru_optimized.mp4" type="video/mp4">
  </video>
  <div class="hero-new__overlay"></div>
</section>

<!-- 4. SECTION KATEGORI CEPAT -->
<section id="layanan" class="section-gap-new">
  <div class="section-heading-new center-align reveal">
    <h2>Pilih Kebutuhan Anda</h2>
    <p>Kami menyediakan solusi lengkap kelistrikan dan custom tampilan lampu motor Anda.</p>
  </div>

  <div class="categories-grid reveal">
    <div class="category-card-new custom-lampu">
      <div class="category-card-new__icon">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"></path></svg>
      </div>
      <h3>Custom Lampu</h3>
      <div class="category-card-new__accent-line"></div>
    </div>

    <div class="category-card-new biled">
      <div class="category-card-new__icon">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="12" y1="2" x2="12" y2="4"></line><line x1="12" y1="20" x2="12" y2="22"></line></svg>
      </div>
      <h3>Biled / Projector</h3>
      <div class="category-card-new__accent-line"></div>
    </div>

    <div class="category-card-new sirine">
      <div class="category-card-new__icon">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
      </div>
      <h3>Sirine</h3>
      <div class="category-card-new__accent-line"></div>
    </div>

    <div class="category-card-new kelistrikan">
      <div class="category-card-new__icon">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
      </div>
      <h3>Kelistrikan</h3>
      <div class="category-card-new__accent-line"></div>
    </div>
  </div>
</section>

<!-- 5. SECTION TENTANG BENGKEL -->
<section class="section-gap-new">
  <div class="about-split">
    <div class="about-split__image reveal">
      <img src="/img/depanmotor.jpeg" alt="Tampilan Depan Bengkel Faizal Motor 139">
    </div>

    <div class="about-split__text reveal">
      <h2>Bengkel Custom Lampu Motor di Bandung</h2>
      <p>Faizal Motor 139 adalah bengkel motor yang melayani custom lampu, sirine, kelistrikan, service, dan sparepart. Pelanggan bisa datang langsung ke bengkel untuk konsultasi kebutuhan motor sebelum pemasangan.</p>
      
      <div class="about-points">
        <div class="about-point-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
          Custom lampu motor
        </div>
        <div class="about-point-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
          Sirine dan aksesoris
        </div>
        <div class="about-point-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
          Kelistrikan motor
        </div>
        <div class="about-point-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
          Sparepart dan service
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 6. SECTION PRODUK UNGGULAN -->
<section class="section-gap-new">
  <div class="section-heading-new center-align reveal">
    <h2>Produk dan Layanan Unggulan</h2>
    <p>Lihat opsi pengerjaan terpopuler yang paling banyak diminati oleh pelanggan kami.</p>
  </div>

  <div class="product-grid-new reveal">
    <!-- Card 1 -->
    <div class="product-card-new">
      <div class="product-card-new__image">
        <img src="/img/xmax.png" alt="Custom Lampu XMAX">
      </div>
      <div class="product-card-new__body">
        <span class="product-card-new__category">Yamaha XMAX</span>
        <h3>Custom Lampu XMAX</h3>
        <p class="product-card-new__description">Upgrade projector biled dan lampu alis DRL RGB untuk tampilan XMAX baru yang lebih gagah dan terang.</p>
        <div class="product-card-new__footer">
          <a class="btn-card-tanya" href="https://wa.me/6281223466068?text={{ rawurlencode('Halo Faizal Motor 139, saya mau tanya produk Custom Lampu XMAX.') }}" target="_blank">Tanya Produk</a>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="product-card-new">
      <div class="product-card-new__image">
        <img src="/img/nmax.png" alt="Custom Lampu NMAX">
      </div>
      <div class="product-card-new__body">
        <span class="product-card-new__category">Yamaha NMAX</span>
        <h3>Custom Lampu NMAX</h3>
        <p class="product-card-new__description">Modifikasi lampu utama dengan biled projector premium untuk berkendara malam hari yang lebih aman.</p>
        <div class="product-card-new__footer">
          <a class="btn-card-tanya" href="https://wa.me/6281223466068?text={{ rawurlencode('Halo Faizal Motor 139, saya mau tanya produk Custom Lampu NMAX.') }}" target="_blank">Tanya Produk</a>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="product-card-new">
      <div class="product-card-new__image">
        <img src="/img/biled_proyektor.png" alt="Biled / Projector">
      </div>
      <div class="product-card-new__body">
        <span class="product-card-new__category">Lampu Utama</span>
        <h3>Biled / Projector</h3>
        <p class="product-card-new__description">Pemasangan lensa biled AES, vahid, dan brand terbaik lainnya dengan pengerjaan rapi dan bergaransi.</p>
        <div class="product-card-new__footer">
          <a class="btn-card-tanya" href="https://wa.me/6281223466068?text={{ rawurlencode('Halo Faizal Motor 139, saya mau tanya produk Biled / Projector.') }}" target="_blank">Tanya Produk</a>
        </div>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="product-card-new">
      <div class="product-card-new__image">
        <img src="/img/sirine.jpg" alt="Paket Sirine Motor">
      </div>
      <div class="product-card-new__body">
        <span class="product-card-new__category">Sirine</span>
        <h3>Paket Sirine Motor</h3>
        <p class="product-card-new__description">Paket sirine patwal lengkap dengan saklar PNP (plug-and-play), modul suara whelen, senken, landun.</p>
        <div class="product-card-new__footer">
          <a class="btn-card-tanya" href="https://wa.me/6281223466068?text={{ rawurlencode('Halo Faizal Motor 139, saya mau tanya produk Paket Sirine Motor.') }}" target="_blank">Tanya Produk</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 7. SECTION KATALOG PRODUK -->
<section id="katalog" class="section-gap-new">
  <div class="section-heading-new center-align reveal">
    <h2>Katalog Produk</h2>
    <p>Lihat pilihan produk dan layanan yang tersedia di Faizal Motor 139.</p>
  </div>

  <!-- Filter tabs -->
  <div class="filter-tabs-new reveal">
    <button class="filter-btn-new is-active" onclick="filterCatalog('all', this)">Semua</button>
    <button class="filter-btn-new" onclick="filterCatalog('custom-lampu', this)">Custom Lampu</button>
    <button class="filter-btn-new" onclick="filterCatalog('biled', this)">Biled</button>
    <button class="filter-btn-new" onclick="filterCatalog('rgb', this)">RGB</button>
    <button class="filter-btn-new" onclick="filterCatalog('sirine', this)">Sirine</button>
  </div>

  <div class="product-grid-new reveal">
    <!-- Loop Products from Database -->
    @foreach($products as $product)
      @php
        $cat = 'custom-lampu';
        $nameLower = strtolower($product->name);
        if (str_contains($nameLower, 'biled') || str_contains($nameLower, 'projector')) {
            $cat = 'biled';
        } elseif (str_contains($nameLower, 'rgb') || str_contains($nameLower, 'angel')) {
            $cat = 'rgb';
        } elseif (str_contains($nameLower, 'sirine') || str_contains($nameLower, 'patwal')) {
            $cat = 'sirine';
        }
      @endphp
      <div class="product-card-new catalog-item" data-category="{{ $cat }}">
        <div class="product-card-new__image">
          <img src="{{ $product->image ? Storage::url($product->image) : asset('images/dummy/product-placeholder.jpg') }}" alt="{{ $product->name }}" loading="lazy" decoding="async">
        </div>
        <div class="product-card-new__body">
          <span class="product-card-new__category">{{ $product->model->brand->name ?? 'Custom' }} - {{ $product->model->name ?? 'Universal' }}</span>
          <h3>{{ $product->name }}</h3>
          <p class="product-card-new__description">{{ Str::limit($product->description, 100) }}</p>
          <div class="product-card-new__footer">
            <div class="product-card-new__price-wrap">
              <span class="product-card-new__price">
                @if($product->price > 0)
                  Rp {{ number_format($product->price, 0, ',', '.') }}
                @else
                  Konsultasikan Harga
                @endif
              </span>
              <a class="product-card-new__detail-link" href="/product/{{ $product->id }}-{{ Str::slug($product->name) }}">Detail</a>
            </div>
            <a class="btn-card-whatsapp" href="https://wa.me/6281223466068?text={{ rawurlencode('Halo Faizal Motor 139, saya ingin order: ' . $product->name) }}" target="_blank">
              Order via WhatsApp
            </a>
          </div>
        </div>
      </div>
    @endforeach

    <!-- Loop Sirines from Database -->
    @foreach($sirines as $sirine)
      <div class="product-card-new catalog-item" data-category="sirine">
        <div class="product-card-new__image">
          <img src="{{ $sirine->image ? Storage::url($sirine->image) : asset('images/dummy/product-placeholder.jpg') }}" alt="{{ $sirine->name }}" loading="lazy" decoding="async">
        </div>
        <div class="product-card-new__body">
          <span class="product-card-new__category">Sirine & Klakson</span>
          <h3>{{ $sirine->name }}</h3>
          <p class="product-card-new__description">{{ Str::limit($sirine->description, 100) }}</p>
          <div class="product-card-new__footer">
            <div class="product-card-new__price-wrap">
              <span class="product-card-new__price">
                @if($sirine->price > 0)
                  Rp {{ number_format($sirine->price, 0, ',', '.') }}
                @else
                  Konsultasikan Harga
                @endif
              </span>
              <a class="product-card-new__detail-link" href="/sirine/{{ $sirine->id }}-{{ Str::slug($sirine->name) }}">Detail</a>
            </div>
            <a class="btn-card-whatsapp" href="https://wa.me/6281223466068?text={{ rawurlencode('Halo Faizal Motor 139, saya ingin order sirine: ' . $sirine->name) }}" target="_blank">
              Order via WhatsApp
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>

<!-- 8. SECTION DOKUMENTASI PENGERJAAN -->
<section class="section-gap-new">
  <div class="section-heading-new center-align reveal">
    <h2>Dokumentasi Pengerjaan</h2>
    <p>Foto nyata hasil instalasi langsung di bengkel kami, tanpa polesan render digital.</p>
  </div>

  <div class="gallery-grid-new reveal">
    <div class="gallery-item-new">
      <div class="gallery-item-new__image">
        <img src="/img/perakitan headlamp.jpeg" alt="Yamaha XMAX — Custom Biled">
      </div>
      <div class="gallery-item-new__caption">Perakitan Lampu - XMAX</div>
    </div>

    <div class="gallery-item-new">
      <div class="gallery-item-new__image">
        <img src="/img/NMAX_OLD.png" alt="Yamaha NMAX — Upgrade Lampu">
      </div>
      <div class="gallery-item-new__caption">Yamaha NMAX — Upgrade Lampu</div>
    </div>

    <div class="gallery-item-new">
      <div class="gallery-item-new__image">
        <img src="/images/dummy/portfolio-3.jpg" alt="Yamaha Aerox — RGB Custom">
      </div>
      <div class="gallery-item-new__caption">Yamaha Aerox — RGB Custom</div>
    </div>

    <div class="gallery-item-new">
      <div class="gallery-item-new__image">
        <img src="/img/pemasangan_lampu.jpeg" alt="Honda Vario — Projector LED">
      </div>
      <div class="gallery-item-new__caption">Pemasangan Lampu - XMAX</div>
    </div>

    <div class="gallery-item-new">
      <div class="gallery-item-new__image">
        <img src="/images/dummy/portfolio-5.jpg" alt="Motor Matic — Kelistrikan">
      </div>
      <div class="gallery-item-new__caption">Motor Matic — Kelistrikan</div>
    </div>

    <div class="gallery-item-new">
      <div class="gallery-item-new__image">
        <img src="/images/dummy/portfolio-6.jpg" alt="Custom Lampu Harian">
      </div>
      <div class="gallery-item-new__caption">Custom Lampu Harian</div>
    </div>
  </div>
</section>

<!-- 9. SECTION ALUR PENGERJAAN -->
<section class="section-gap-new">
  <div class="section-heading-new center-align reveal">
    <h2>Alur Pengerjaan</h2>
    <p>Prosedur pengerjaan di Faizal Motor 139 untuk memastikan hasil yang maksimal dan presisi.</p>
  </div>

  <div class="steps-grid-new reveal">
    <div class="step-card-new">
      <div class="step-card-new__num">01</div>
      <h3>Konsultasi kebutuhan</h3>
      <p>Bicarakan kebutuhan lampu atau kelistrikan motor Anda langsung ke admin via WhatsApp atau datang ke lokasi.</p>
    </div>

    <div class="step-card-new">
      <div class="step-card-new__num">02</div>
      <h3>Pilih konsep & produk</h3>
      <p>Pilih jenis biled projector, warna alis RGB, tipe sirine, dan sparepart sesuai dengan konsep modifikasi Anda.</p>
    </div>

    <div class="step-card-new">
      <div class="step-card-new__num">03</div>
      <h3>Proses pemasangan</h3>
      <p>Teknisi kami melakukan instalasi kelistrikan secara teliti, rapi, dan aman tanpa merusak jalur kabel utama.</p>
    </div>

    <div class="step-card-new">
      <div class="step-card-new__num">04</div>
      <h3>Cek hasil & finishing</h3>
      <p>Pengujian fokus cahaya lampu, suara sirine, dan kerapian instalasi secara menyeluruh sebelum diserahkan.</p>
    </div>
  </div>
</section>

<!-- 10. SECTION TESTIMONI -->
<section class="section-gap-new">
  <div class="section-heading-new center-align reveal">
    <h2>Apa Kata Pelanggan?</h2>
    <p>Ulasan jujur dan langsung dari para pengendara yang mempercayakan motornya pada kami.</p>
  </div>

  <div class="testimonials-grid-new reveal">
    <div class="testimonial-card-new">
      <p>Hasil pasang biled di XMAX terang dan potongannya rapi. Dipakai malam jadi lebih nyaman.</p>
      <div class="testimonial-card-new__meta">
        <strong>Asep</strong>
        <span>Yamaha XMAX</span>
      </div>
    </div>

    <div class="testimonial-card-new">
      <p>Custom RGB Aerox hasilnya sesuai request. Konsultasinya juga jelas dari awal.</p>
      <div class="testimonial-card-new__meta">
        <strong>Tyar Febriano</strong>
        <span>Yamaha Aerox</span>
      </div>
    </div>

    <div class="testimonial-card-new">
      <p>Pengerjaan cepat, rapi, dan tidak asal pasang.</p>
      <div class="testimonial-card-new__meta">
        <strong>Rizky</strong>
        <span>Honda Vario</span>
      </div>
    </div>
  </div>
</section>

<!-- 13. FLOATING WHATSAPP -->
<a class="floating-wa-new" href="https://wa.me/6281223466068?text={{ rawurlencode('Halo Faizal Motor 139, saya ingin konsultasi custom lampu motor.') }}" target="_blank">
  <svg width="20" height="20" fill="currentColor" viewBox="0 0 448 512" style="display:inline-block; vertical-align:middle;"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L3 480l117.7-30.9c32.4 17.7 68.9 27 106.2 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
  Chat Admin
</a>

<!-- 12. FOOTER BARU -->
<footer class="footer-new">
  <div class="footer-new__container">
    <div class="footer-new__brand-column">
      <a class="footer-new__logo" href="/">
        <img src="/img/faizalmotor_logo.png" alt="Faizal Motor 139">
        <strong>Faizal Motor 139</strong>
      </a>
      <p class="footer-new__desc">Custom lampu motor, sirine, kelistrikan, service, dan sparepart di Bandung.</p>
    </div>

    <div>
      <h3 class="footer-new__title">Menu Cepat</h3>
      <ul class="footer-new__links">
        <li><a href="/">Beranda</a></li>
        <li><a href="/kategori">Katalog Produk</a></li>
        <li><a href="/sirine">Sirine</a></li>
        <li><a href="/lokasi">Lokasi</a></li>
        <li><a href="/kontak">Kontak</a></li>
      </ul>
    </div>

    <div>
      <h3 class="footer-new__title">Sosial Media</h3>
      <p class="footer-new__desc" style="margin-bottom: 12px;">Ikuti dokumentasi pengerjaan kami di sosial media:</p>
      <div class="footer-new__socials">
        <a class="footer-new__social-link" href="https://www.tokopedia.com/telolet139" target="_blank" rel="noopener noreferrer">
          <img src="/img/tokopedia.png" alt="Tokopedia">
        </a>
        <a class="footer-new__social-link" href="https://www.instagram.com/faizalmotor139/" target="_blank" rel="noopener noreferrer">
          <img src="/img/instagram.png" alt="Instagram">
        </a>
        <a class="footer-new__social-link" href="https://www.youtube.com/@faizalmotor139" target="_blank" rel="noopener noreferrer">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#E63946" style="width: 20px; height: 20px; vertical-align: middle;">
            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
          </svg>
        </a>
        <a class="footer-new__social-link" href="https://shopee.co.id/lelanurmala22" target="_blank" rel="noopener noreferrer">
          <img src="/img/shopee.png" alt="Shopee">
        </a>
        <a class="footer-new__social-link" href="https://web.facebook.com/p/FAIZAL-MOTOR-139-100043234393667/?_rdc=1&_rdr#" target="_blank" rel="noopener noreferrer">
          <img src="/img/facebook.png" alt="Facebook">
        </a>
      </div>
    </div>
  </div>

  <div class="footer-new__copyright">
    <span>&copy; 2026 Faizal Motor 139. Hak Cipta Dilindungi.</span>
  </div>
</footer>

@include('components.bottom-navbar')
<script src="/script.js"></script>
<script>
  // Lazy loading observer untuk gambar produk
  if ('IntersectionObserver' in window) {
    const lazyImgs = document.querySelectorAll('img[loading="lazy"]');
    const imgObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('loaded');
          imgObserver.unobserve(entry.target);
        }
      });
    }, { rootMargin: '50px' });
    lazyImgs.forEach(img => imgObserver.observe(img));
  }
</script>
<script>
  // Client-side category filtering
  function filterCatalog(category, button) {
    // Update active class on filter buttons
    document.querySelectorAll('.filter-btn-new').forEach(btn => {
      btn.classList.remove('is-active');
    });
    button.classList.add('is-active');

    // Filter catalog items
    const items = document.querySelectorAll('.catalog-item');
    items.forEach(item => {
      if (category === 'all') {
        item.style.display = 'flex';
      } else {
        const itemCat = item.getAttribute('data-category');
        if (itemCat === category) {
          item.style.display = 'flex';
        } else {
          item.style.display = 'none';
        }
      }
    });
  }

  // Smooth scroll support
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      const target = document.querySelector(targetId);
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth'
        });
      }
    });
  });
</script>
</body>
</html>
