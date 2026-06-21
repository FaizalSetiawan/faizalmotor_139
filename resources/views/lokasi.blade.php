<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <title>Lokasi Bengkel — Faizal Motor 139</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Lokasi bengkel Faizal Motor 139 — Jl. Sukamenak Indah 139, Bandung Barat. Custom lampu motor, sirine, kelistrikan.">
  <link rel="icon" href="/img/faizalmotor_logo.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="/style.css">
  <style>
    /* ===== LOKASI PAGE SPECIFIC STYLES ===== */
    .lokasi-page {
      min-height: 100vh;
      background: #F4F4F4;
      padding-bottom: 150px;
    }

    /* Mobile header minimal */
    .mobile-header-only {
      position: sticky;
      top: 0;
      z-index: 500;
      background: #fff;
      border-bottom: 1px solid #D9D9D9;
      display: flex;
      align-items: center;
      padding: 10px 16px;
      height: 56px;
      box-shadow: 0 1px 8px rgba(0,0,0,0.06);
    }

    .mobile-header-only .brand-link {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    .mobile-header-only img {
      height: 36px;
      width: auto;
      object-fit: contain;
    }

    .mobile-header-only strong {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 18px;
      font-weight: 700;
      color: #0B0B0B;
      text-transform: uppercase;
    }

    /* Lokasi hero */
    .lokasi-hero {
      background: #0B0B0B;
      color: #fff;
      padding: 28px 20px 24px;
      border-bottom: 2px solid #E63946;
    }

    .lokasi-hero h1 {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 28px;
      font-weight: 700;
      text-transform: uppercase;
      color: #fff;
      margin-bottom: 6px;
    }

    .lokasi-hero p {
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 14px;
      color: rgba(255,255,255,0.7);
    }

    /* Lokasi content */
    .lokasi-content {
      max-width: 760px;
      margin: 0 auto;
      padding: 24px 16px;
    }

    /* Info cards */
    .lokasi-info-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 12px;
      margin-bottom: 24px;
    }

    .lokasi-info-card {
      background: #fff;
      border: 1px solid #D9D9D9;
      border-radius: 12px;
      padding: 18px 20px;
      display: flex;
      align-items: flex-start;
      gap: 16px;
    }

    .lokasi-info-card__icon {
      width: 44px;
      height: 44px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .lokasi-info-card__icon--red { background: rgba(230,57,70,0.1); color: #E63946; }
    .lokasi-info-card__icon--green { background: rgba(37,211,102,0.1); color: #25D366; }
    .lokasi-info-card__icon--blue { background: rgba(92,189,235,0.1); color: #5CBDEB; }

    .lokasi-info-card__text strong {
      display: block;
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 13px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #737373;
      margin-bottom: 4px;
    }

    .lokasi-info-card__text p,
    .lokasi-info-card__text span {
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 15px;
      color: #0B0B0B;
      line-height: 1.6;
    }

    /* Maps embed */
    .lokasi-map {
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid #D9D9D9;
      height: 300px;
      margin-bottom: 24px;
    }

    .lokasi-map iframe {
      width: 100%;
      height: 100%;
      border: 0;
      display: block;
    }

    /* Action buttons */
    .lokasi-actions {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    .lokasi-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 14px 16px;
      border-radius: 12px;
      text-decoration: none;
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 15px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      min-height: 50px;
      transition: opacity 0.2s ease, transform 0.2s ease;
      -webkit-tap-highlight-color: transparent;
    }

    .lokasi-btn:active {
      transform: scale(0.97);
      opacity: 0.9;
    }

    .lokasi-btn--maps {
      background: #0B0B0B;
      color: #fff;
    }

    .lokasi-btn--wa {
      background: #25D366;
      color: #fff;
    }

    .lokasi-btn svg {
      width: 20px;
      height: 20px;
      flex-shrink: 0;
    }

    /* Section title */
    .lokasi-section-title {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 18px;
      font-weight: 700;
      text-transform: uppercase;
      color: #0B0B0B;
      margin-bottom: 14px;
      padding-bottom: 8px;
      border-bottom: 2px solid #E63946;
      display: inline-block;
    }

    /* Desktop layout */
    @media (min-width: 640px) {
      .lokasi-info-grid {
        grid-template-columns: 1fr 1fr;
      }

      .lokasi-map {
        height: 420px;
      }

      .lokasi-hero h1 {
        font-size: 36px;
      }
    }

    @media (min-width: 768px) {
      .mobile-header-only {
        /* Di desktop tampilkan topbar yang lebih penuh */
        height: 70px;
        padding: 12px 40px;
      }
      .mobile-header-only strong {
        font-size: 20px;
      }
      .mobile-header-only img {
        height: 44px;
      }
      .lokasi-hero {
        padding: 40px 40px 36px;
      }
    }
  </style>
</head>
<body class="has-bottom-nav">

{{-- Minimal header (desktop & mobile) --}}
<header class="mobile-header-only">
  <a href="/" class="brand-link">
    <img src="/img/faizalmotor_logo.png" alt="Faizal Motor 139">
    <strong>Faizal Motor 139</strong>
  </a>
</header>

<div class="lokasi-page">

  {{-- Hero --}}
  <div class="lokasi-hero">
    <h1>Lokasi Bengkel</h1>
    <p>Kunjungi kami untuk konsultasi, pemasangan, dan pembelian langsung.</p>
  </div>

  <div class="lokasi-content">

    {{-- Info Section --}}
    <h2 class="lokasi-section-title">Informasi Bengkel</h2>

    <div class="lokasi-info-grid">
      <div class="lokasi-info-card">
        <div class="lokasi-info-card__icon lokasi-info-card__icon--red">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
          </svg>
        </div>
        <div class="lokasi-info-card__text">
          <strong>Alamat</strong>
          <p>Jl. Raya Sukamenak Indah 139<br>Bandung Barat, Jawa Barat</p>
        </div>
      </div>

      <div class="lokasi-info-card">
        <div class="lokasi-info-card__icon lokasi-info-card__icon--blue">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
          </svg>
        </div>
        <div class="lokasi-info-card__text">
          <strong>Jam Operasional</strong>
          <p>Senin – Sabtu<br>08.00 – 17.00 WIB<br><span style="color:#737373; font-size:13px;">Minggu Libur</span></p>
        </div>
      </div>

      <div class="lokasi-info-card">
        <div class="lokasi-info-card__icon lokasi-info-card__icon--green">
          <svg width="22" height="22" viewBox="0 0 448 512" fill="currentColor">
            <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L3 480l117.7-30.9c32.4 17.7 68.9 27 106.2 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
          </svg>
        </div>
        <div class="lokasi-info-card__text">
          <strong>WhatsApp</strong>
          <p>0812-2346-6068<br>0812-2066-0964</p>
        </div>
      </div>
    </div>

    {{-- Map --}}
    <h2 class="lokasi-section-title" style="margin-top: 8px;">Google Maps</h2>
    <div class="lokasi-map">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15841.134594326553!2d107.5653166!3d-6.9716657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e927b0089af7%3A0xc0932d015425d37!2sFAIZAL%20MOTOR%20139!5e0!3m2!1sen!2sid!4v1712869153073!5m2!1sen!2sid"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi Faizal Motor 139">
      </iframe>
    </div>

    {{-- Actions --}}
    <div class="lokasi-actions">
      <a class="lokasi-btn lokasi-btn--maps"
         href="https://maps.app.goo.gl/FADzU5N2YnUaPjWp9"
         target="_blank" rel="noopener noreferrer">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
        </svg>
        Google Maps
      </a>
      <a class="lokasi-btn lokasi-btn--wa"
         href="https://wa.me/6281223466068?text={{ rawurlencode('Halo Faizal Motor 139, saya ingin berkunjung ke bengkel.') }}"
         target="_blank" rel="noopener noreferrer">
        <svg viewBox="0 0 448 512" fill="currentColor">
          <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L3 480l117.7-30.9c32.4 17.7 68.9 27 106.2 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
        </svg>
        Chat WA
      </a>
    </div>

  </div>
</div>

<footer class="site-footer" style="padding-bottom: 90px;">
  <p>&copy; 2026 Faizal Motor 139</p>
</footer>

@include('components.bottom-navbar')
<script src="/script.js"></script>
</body>
</html>
