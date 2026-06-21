@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <title>{{ __('site.sirine.title') }}</title>
  <meta name="description" content="{{ __('site.sirine.meta') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/img/faizalmotor_logo.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/category.css">
</head>
<body class="has-bottom-nav">
  {{-- Minimal mobile header --}}
  <header class="mobile-brand-header">
    <a href="/">
      <img src="{{ asset('img/faizalmotor_logo.png') }}" alt="{{ __('site.brand') }}">
      <strong>{{ __('site.brand') }}</strong>
    </a>
  </header>

  <div class="navbar">
    <div class="left">
      <img src="{{ asset('img/faizalmotor_logo.png') }}" alt="{{ __('site.brand') }}">
      <h1>{{ __('site.brand') }}</h1>
    </div>
    <button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-label="Toggle navigation">☰</button>
    <ul data-nav-menu>
      <li><a href="/">{{ __('site.nav.home') }}</a></li>
      <li><a href="/kategori">{{ __('site.nav.category') }}</a></li>
      <li><a href="/sirine" class="active">{{ __('site.nav.sirine') }}</a></li>
      <li><a href="/kontak">{{ __('site.nav.contact') }}</a></li>
      <li class="locale-switch">
        <a href="{{ route('locale.switch', 'id') }}" class="{{ app()->getLocale() === 'id' ? 'active' : '' }}">{{ __('site.language.id') }}</a>
        <a href="{{ route('locale.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">{{ __('site.language.en') }}</a>
      </li>
    </ul>
  </div>

  <section class="page-hero">
    <h1>{{ __('site.sirine.heading') }}</h1>
  </section>

  <div class="results-bar">
    <p>{{ __('site.sirine.results', ['count' => $sirines->total()]) }}</p>
  </div>

  <section class="products-section">
    @if($sirines->isEmpty())
      <div class="empty-state">
        <h3>{{ __('site.sirine.empty_title') }}</h3>
        <p>{{ __('site.sirine.empty_text') }}</p>
        <div class="empty-actions">
          <a href="/kontak">{{ __('site.sirine.contact_us') }}</a>
          <a href="https://wa.me/6281223466068?text={{ rawurlencode(app()->getLocale() === 'en' ? 'Hello admin, I want to ask about siren products.' : 'Halo admin, saya mau tanya produk sirine.') }}" target="_blank">{{ __('site.common.ask_admin') }}</a>
        </div>
      </div>
    @else
      <div class="product-grid">
        @foreach($sirines as $sirine)
          <article class="product-card">
            <a class="main-link" href="/sirine/{{ $sirine->id }}-{{ Str::slug($sirine->name) }}">
              <div class="image-wrapper">
                <img src="{{ $sirine->image ? Storage::url($sirine->image) : asset('placeholder.png') }}" alt="{{ $sirine->name }}" loading="lazy" decoding="async">
              </div>
              <div class="card-body">
                <span class="motor-tag">{{ __('site.common.additional_product') }}</span>
                <h3>{{ $sirine->name }}</h3>
                <p class="description">{{ Str::limit($sirine->description, 130) }}</p>
                <div class="card-footer">
                  <div class="price">Rp {{ number_format($sirine->price, 0, ',', '.') }}</div>
                  <span class="btn-detail">{{ __('site.common.view_detail') }}</span>
                </div>
              </div>
            </a>
            <a class="btn-wa" href="https://wa.me/6281223466068?text={{ rawurlencode((app()->getLocale() === 'en' ? 'Hello admin, I am interested in ' : 'Halo admin, saya tertarik dengan ').$sirine->name.'\nPrice: Rp '.number_format($sirine->price, 0, ',', '.')) }}" target="_blank">{{ __('site.detail.order_whatsapp') }}</a>
            @php
              $stores = collect([
                ['label' => 'Shopee', 'url' => $sirine->shopee_url, 'class' => 'store-shopee', 'icon' => asset('img/shopee.png')],
                ['label' => 'TikTok Shop', 'url' => $sirine->tiktokshop_url, 'class' => 'store-tiktok', 'icon' => asset('img/tiktok.png')],
                ['label' => 'Tokopedia', 'url' => $sirine->tokopedia_url, 'class' => 'store-tokopedia', 'icon' => asset('img/tokopedia.png')],
              ])->filter(fn ($store) => filled($store['url']));
            @endphp
            @if($stores->isNotEmpty())
              <div class="store-links">
                @foreach($stores as $store)
                  <a class="btn-store-card {{ $store['class'] }}" href="{{ $store['url'] }}" target="_blank" rel="noopener noreferrer">
                    <span class="shopee-icon"><img src="{{ $store['icon'] }}" alt="{{ $store['label'] }}"></span>
                    <span>{{ $store['label'] }}</span>
                  </a>
                @endforeach
              </div>
            @endif
          </article>
        @endforeach
      </div>

      @if($sirines->hasPages())
        <div class="pagination-wrap">{{ $sirines->onEachSide(1)->links() }}</div>
      @endif
    @endif
  </section>

  <footer class="footer">
    <p>&copy; 2026 {{ __('site.brand') }}</p>
  </footer>

  @include('components.bottom-navbar')

  <script src="/script.js"></script>
</body>
</html>
