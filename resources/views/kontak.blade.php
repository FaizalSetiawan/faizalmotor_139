<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <title>{{ __('site.contact.title') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/img/faizalmotor_logo.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/style.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <style>
    .contact-page{padding:120px 40px 80px;max-width:1300px;margin:0 auto;display:grid;grid-template-columns:1fr 1.2fr;gap:60px;align-items:flex-start}
    .contact-info h1{font-size:32px;color:var(--navy);margin-bottom:24px}.contact-info>p{color:var(--muted);line-height:1.8;margin-bottom:40px}.store-details{display:grid;gap:30px}.store-item{display:flex;gap:16px;align-items:flex-start}
    .store-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--sky),var(--sky-dark));color:#fff;font-weight:bold;flex-shrink:0;font-size:20px}
    .store-icon.email{background:linear-gradient(135deg,#f59e0b,#d97706)}.store-icon.wa{background:linear-gradient(135deg,#10b981,#059669)}.store-icon.office{background:linear-gradient(135deg,#ef4444,#dc2626)}.store-icon.hours{background:linear-gradient(135deg,#ec4899,#db2777)}
    .store-item strong{display:block;color:var(--navy);margin-bottom:4px;font-size:16px}.store-item span{color:var(--muted);line-height:1.6;font-size:14px}.form-wrapper{background:#fff;border-radius:24px;padding:40px;box-shadow:var(--shadow)}
    .form-wrapper h2{font-size:28px;color:var(--navy);margin-bottom:30px;padding-bottom:16px;border-bottom:2px solid var(--line);display:flex;align-items:center}.form-wrapper h2::after{content:"";display:block;height:4px;width:60px;background:var(--sky);margin-left:16px;border-radius:4px}
    .form-row{display:grid;grid-template-columns:1fr 2.5fr;gap:16px;align-items:center;margin-bottom:24px}.form-row.align-top{align-items:flex-start}.form-label{font-weight:600;color:var(--navy);font-size:14px}.form-label .req{color:#ef4444;margin-right:4px}
    .form-control{width:100%;padding:14px 16px;border:1px solid var(--line);border-radius:12px;font-family:'Poppins',sans-serif;font-size:14px;color:var(--navy);outline:none;transition:border-color .2s,box-shadow .2s}.form-control:focus{border-color:var(--sky);box-shadow:0 0 0 3px rgba(56,189,248,.15)}textarea.form-control{min-height:120px;resize:vertical}
    .btn-submit{background:linear-gradient(135deg,var(--sky),var(--sky-dark));color:#fff;border:none;padding:16px 32px;font-weight:600;font-size:16px;border-radius:12px;cursor:pointer;transition:transform .2s,box-shadow .2s;width:100%;margin-top:10px}.btn-submit:hover{transform:translateY(-2px);box-shadow:0 10px 20px rgba(2,132,199,.2)}
    .alert-success{background:#ecfdf5;border:1px solid #10b981;color:#065f46;padding:16px;border-radius:12px;margin-bottom:24px;font-weight:500}
    @media (max-width:900px){.contact-page{grid-template-columns:1fr;padding-top:100px}.form-row{grid-template-columns:1fr;gap:8px}}
  </style>
</head>
<body class="has-bottom-nav">
<header class="site-shell">
  <nav class="topbar is-scrolled" id="topbar">
    <a class="brandmark" href="/"><img src="/img/faizalmotor_logo.png" alt="{{ __('site.brand') }}"><span><strong>{{ __('site.brand') }}</strong><small>{{ __('site.tagline') }}</small></span></a>
    <button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false">☰</button>
    <div class="topbar__links" data-nav-menu>
      <a href="/">{{ __('site.nav.home') }}</a>
      <a href="/kategori">{{ __('site.nav.category') }}</a>
      <a href="/sirine">{{ __('site.nav.sirine') }}</a>
      <a href="/kontak" class="is-active">{{ __('site.nav.contact') }}</a>
      <div class="locale-switch">
        <a href="{{ route('locale.switch', 'id') }}" class="{{ app()->getLocale() === 'id' ? 'is-active' : '' }}">{{ __('site.language.id') }}</a>
        <a href="{{ route('locale.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'is-active' : '' }}">{{ __('site.language.en') }}</a>
      </div>
    </div>
  </nav>
</header>

<main>
  <section class="contact-page">
    <div class="contact-info">
      <h1>{{ __('site.contact.heading') }}</h1>
      <p>{{ __('site.contact.intro') }}</p>
      <div style="margin-bottom: 40px;">
        <h3 style="color: var(--navy); margin-bottom: 6px;">{{ __('site.brand') }}</h3>
        <p style="color: var(--muted); font-size: 15px;">{{ __('site.contact.subtitle') }}</p>
      </div>
      <div class="store-details">
        <div class="store-item"><div class="store-icon email" style="background: transparent; box-shadow: none;"><svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></div><div><strong>{{ __('site.contact.email') }}</strong><span>fizaltempat@gmail.com</span></div></div>
        <div class="store-item"><div class="store-icon wa" style="background: transparent; box-shadow: none;"><svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></div><div><strong>{{ __('site.contact.phone') }}</strong><span>0812-2346-6068<br>0812-2066-0964</span></div></div>
        <div class="store-item"><div class="store-icon office" style="background: transparent; box-shadow: none;"><svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></div><div><strong>{{ __('site.contact.workshop') }}</strong><span>Jl. Raya Sukamenak Indah 139<br>Bandung Barat, Jawa Barat<br>Indonesia</span></div></div>
        <div class="store-item"><div class="store-icon hours" style="background: transparent; box-shadow: none;"><svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></div><div><strong>{{ __('site.contact.hours') }}</strong><span>{{ __('site.contact.hours_value') }}</span></div></div>
      </div>
      <div style="margin-top: 50px;">
        <p style="color: var(--muted);">{{ __('site.contact.form_note') }}</p>
        <div style="margin-top: 18px;"><a href="/sirine" class="btn btn-secondary" style="text-decoration:none;">{{ __('site.contact.view_sirens') }}</a></div>
      </div>
    </div>

    <div class="form-wrapper">
      <h2>{{ __('site.contact.form_title') }}</h2>
      @if (session('success'))<div class="alert-success">{{ session('success') }}</div>@endif
      <form action="{{ route('kontak.store') }}" method="POST">
        @csrf
        <div class="form-row"><label class="form-label"><span class="req">*</span> {{ __('site.contact.name') }}</label><input type="text" name="nama" class="form-control" required value="{{ old('nama') }}"></div>
        <div class="form-row"><label class="form-label">{{ __('site.contact.company') }}</label><input type="text" name="perusahaan" class="form-control" value="{{ old('perusahaan') }}"></div>
        <div class="form-row"><label class="form-label"><span class="req">*</span> {{ __('site.contact.email') }}</label><input type="email" name="email" class="form-control" required value="{{ old('email') }}"></div>
        <div class="form-row align-top"><label class="form-label" style="margin-top:14px;"><span class="req">*</span> {{ __('site.contact.address') }}</label><textarea name="alamat" class="form-control" required style="min-height: 80px;">{{ old('alamat') }}</textarea></div>
        <div class="form-row"><label class="form-label">{{ __('site.contact.phone') }}</label><input type="tel" name="telepon" class="form-control" value="{{ old('telepon') }}"></div>
        <div class="form-row"><label class="form-label">{{ __('site.contact.city') }}</label><input type="text" name="kota" class="form-control" value="{{ old('kota') }}"></div>
        <div class="form-row"><label class="form-label"><span class="req">*</span> {{ __('site.contact.country') }}</label><select name="negara" class="form-control" required><option value="Indonesia" {{ old('negara') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option><option value="Malaysia" {{ old('negara') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option><option value="Singapura" {{ old('negara') == 'Singapura' ? 'selected' : '' }}>Singapura</option><option value="Lainnya" {{ old('negara') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option></select></div>
        <div class="form-row align-top"><label class="form-label" style="margin-top:14px;"><span class="req">*</span> {{ __('site.contact.message') }}</label><textarea name="pesan" class="form-control" required placeholder="{{ __('site.contact.message_placeholder') }}">{{ old('pesan') }}</textarea></div>
        <div class="form-row" style="margin-top:8px;"><div></div><div><div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY', '') }}"></div>@error('g-recaptcha-response')<div style="color:#ef4444; font-size:13px; margin-top:8px; font-weight:500;">{{ $message }}</div>@enderror @error('captcha')<div style="color:#ef4444; font-size:13px; margin-top:8px; font-weight:500;">{{ $message }}</div>@enderror</div></div>
        <div class="form-row" style="margin-top:16px;"><div></div><button type="submit" class="btn-submit">{{ __('site.contact.submit') }}</button></div>
      </form>
    </div>
  </section>
</main>

<footer class="site-footer" style="background:var(--navy); color:#fff; text-align:center; padding:22px; margin-top: 40px; padding-bottom: 80px;"><p>&copy; {{ date('Y') }} {{ __('site.brand') }}</p></footer>
@include('components.bottom-navbar')
<script src="/script.js"></script>
</body>
</html>
