@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Faizal Motor 139 - Custom Lampu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<!-- CSS -->
  <link rel="stylesheet" href="{{ asset('style.css') }}">

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
  <div class="loading-text">Memuat Situs <span>...</span></div>
  <div class="loading-bar"><div class="fill"></div></div>
</div>

<!-- BG DECORATIONS -->
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>
<div class="bg-orb bg-orb-3"></div>

<!-- NAVBAR -->
<div class="navbar">

  <div class="left">
    <img src="{{ asset('img/faizalmotor_logo.png') }}">
    <h1>Faizal Motor 139</h1>
  </div>

  <ul>
    <li><a href="#">Beranda</a></li>
    <li><a href="/kategori">Kategori</a></li>
    <li><a href="#">Kontak</a></li>
  </ul>

</div>

<!-- HERO -->
<section class="hero">
  <div class="hero-content">
    
    <h2>Custom Lampu Motor Premium</h2>
    <p>Tampilan Futuristik • LED • Projector • RGB</p>
    <a href="https://wa.me/6281223466068?text=Halo%20Admin%2C%20saya%20mau%20konsultasi%20custom%20lampu" class="btn">Order Sekarang</a>
  </div>
</section>
<section class="xmax-section">
  <div class="xmax-container">
    <!-- GAMBAR KIRI -->
     
    <div class="xmax-image">
      <div class="xmax-image animate">
      <img src="{{ asset('img/xmax.png') }}" alt="XMAX Custom">
    </div>
  </div>
    <!-- TEXT KANAN -->
    <div class="xmax-text">
      <div class="xmax-text animate">
      <h2>Custom Lampu XMAX</h2>
      
    </div>
      <p>
        Salah satu motor premium yang sering kami tangani adalah Yamaha XMAX.
        Dengan desain besar dan elegan, XMAX sangat cocok untuk custom lampu
        LED, projector, hingga RGB futuristik.
      </p>

      <ul>
        <li>✔ LED Blue Ice & RGB</li>
        <li>✔ Projector Premium</li>
        <li>✔ Desain Futuristik</li>
      </ul>

      <a href="https://wa.me/6281223466068?text=Halo%20min,%20saya%20mau%20custom%20lampu%20XMAX" class="btn">
        Custom Sekarang
      </a>
      </div>
    </div>

  </div>
</section>
<section class="about">
  <div class="about-container">

    <!-- GAMBAR KIRI -->
    <div class="about-image animate">
  <img src="{{ asset('img/bengkel.png') }}">
</div>
    <!-- TEXT KANAN -->
    <div class="about-text">
      <div class="about-text animate">
      <h2>Asal Usul Faizal Motor 139</h2>

      <p>
        Faizal Motor 139 berdiri sejak tahun 2006 dan berawal dari bengkel kecil
        yang fokus pada perbaikan dan aksesoris motor.
      </p>

      <p>
        Seiring berkembangnya tren modifikasi, kami mulai fokus pada custom lampu motor
        dengan berbagai konsep seperti LED, projector, dan RGB.
      </p>

      <p>
        Dengan pengalaman bertahun-tahun, kami telah mengerjakan berbagai jenis motor
        seperti Vario, Aerox, NMAX hingga XMAX.
      </p>

      <p>
        Kami berkomitmen memberikan hasil terbaik dengan desain futuristik dan unik.
      </p>
      </div>
    </div>

  </div>
</section>

<!-- KATEGORI MOTOR -->
<section class="kategori">
  <h2>Pilih Motor Kamu</h2>

  <div class="kategori-grid">
    <div class="kategori-card">
      <img src="https://source.unsplash.com/300x200/?vario">
      <p>Vario</p>
    </div>

    <div class="kategori-card">
      <img src="https://source.unsplash.com/300x200/?aerox">
      <p>Aerox</p>
    </div>

    <div class="kategori-card">
      <img src="https://source.unsplash.com/300x200/?nmax">
      <p>NMAX</p>
    </div>

    <div class="kategori-card">
      <img src="https://source.unsplash.com/300x200/?motorbike">
      <p>Beat</p>
    </div>
  </div>
</section>

<!-- PRODUK -->
<section class="produk">
  <h2>Hasil Custom Lampu</h2>

  <div class="product-grid">
@foreach($products as $p)
<div class="card">
    <!-- BAGIAN YANG BISA DIKLIK -->
    <a href="/product/{{ $p->id }}-{{ \Illuminate\Support\Str::slug($p->name) }}">
        <img src="{{ asset('storage/' . $p->image) }}">
        <h4>{{ $p->name }}</h4>
        <p>{{ $p->description }}</p>
    </a>

    <!-- BUTTON WA (TERPISAH) -->
    <a href="https://wa.me/6281223466068?text={{ rawurlencode(
        "Halo kak, saya mau pesan {$p->name}\n" .
        "Motor: {$p->model->name}\n" .
        "Harga: Rp " . number_format($p->price) . "\n\n" .
        "Apakah masih tersedia?"
    ) }}"
       target="_blank"
       class="block mt-2 bg-green-500 text-white text-center py-2 rounded">
       Pesan via WhatsApp
    </a>

</div>

@endforeach
</div>
</section>

<!-- LOKASI / MAPS -->
<section class="maps-section" style="padding:60px 40px; background:#0f172a;">
  <h2 style="text-align:center; color:#fff; font-size:28px; font-weight:700; margin-bottom:8px;"> Lokasi Kami</h2>
  <p style="text-align:center; color:#7dd3fc; font-size:15px; margin-bottom:32px;">Kunjungi bengkel kami langsung untuk konsultasi custom lampu motor</p>

  <div style="max-width:1200px; margin:0 auto; display:flex; gap:28px; flex-wrap:wrap; align-items:stretch;">

    <!-- MAP -->
    <div style="flex:2; min-width:300px; border-radius:16px; overflow:hidden; box-shadow:0 8px 32px rgba(0,0,0,.3); border:2px solid rgba(56,189,248,.15);">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3960.0!2d107.573471!3d-6.9716874!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1700000000000"
        width="100%" height="350" style="border:0; display:block;"
        allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>

    <!-- INFO -->
    <div style="flex:1; min-width:260px; background:linear-gradient(135deg, rgba(56,189,248,.08), rgba(14,165,233,.05)); border:1px solid rgba(56,189,248,.15); border-radius:16px; padding:28px; display:flex; flex-direction:column; justify-content:center;">
      <div style="margin-bottom:24px;">
        <div style="font-size:13px; font-weight:600; color:#38bdf8; text-transform:uppercase; letter-spacing:1px; margin-bottom:8px;">📍 Alamat</div>
        <p style="color:#e0f2fe; font-size:15px; line-height:1.7;">Faizal Motor 139<br>Jl. Raya Sukamenak Indah 139, Bandung Barat<br>Jawa Barat, Indonesia</p>
      </div>
      <div style="margin-bottom:24px;">
        <div style="font-size:13px; font-weight:600; color:#38bdf8; text-transform:uppercase; letter-spacing:1px; margin-bottom:8px;">🕐 Jam Operasional</div>
        <p style="color:#e0f2fe; font-size:15px; line-height:1.7;">Senin - Sabtu: 08.00 - 17.00<br>Jumat: Libur</p>
      </div>
      <div style="margin-bottom:24px;">
        <div style="font-size:13px; font-weight:600; color:#38bdf8; text-transform:uppercase; letter-spacing:1px; margin-bottom:8px;">📞 Kontak</div>
        <p style="color:#e0f2fe; font-size:15px; line-height:1.7;">WhatsApp Admin1: 0812-2346-6068</p>
        <p style="color:#e0f2fe; font-size:15px; line-height:1.7;">WhatsApp Admin2: 0812-2066-0964</p>
      </div>
      <a href="https://www.google.com/maps/@-6.9716874,107.573471,15z?entry=ttu&g_ep=EgoyMDI2MDQwMS4wIKXMDSoASAFQAw%3D%3D"
         target="_blank"
         style="display:inline-flex; align-items:center; justify-content:center; gap:8px; padding:12px 20px; background:linear-gradient(135deg,#38bdf8,#0284c7); color:#fff; border-radius:12px; text-decoration:none; font-size:14px; font-weight:600; transition:all .3s; text-align:center;">
        🗺️ Buka di Google Maps
      </a>
    </div>

  </div>
</section>

<!-- FOOTER -->
<footer>
  <p>© 2026 Faizal Motor 139</p>
</footer>

<!-- FLOATING WA BUTTON -->
<a href="https://wa.me/6281223466068?text={{ rawurlencode("Halo kak, saya mau tanya tentang custom lampu motor.") }}"
   target="_blank" class="float-wa">
  💬
  <div class="tooltip">Chat Admin Sekarang!</div>
</a>

<!-- SCRIPT NAVBAR AUTO HIDE -->
<script src="{{ asset('script.js') }}"></script>
<script>
  // Loading screen
  window.addEventListener('load', () => {
    setTimeout(() => {
      document.getElementById('loadingScreen').classList.add('hide');
    }, 1200);
  });
</script>

</body>
</html>
