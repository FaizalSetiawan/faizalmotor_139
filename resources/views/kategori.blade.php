@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <title>{{ $tab === 'sirine' ? __('site.sirine.title') : __('site.category.title') }}</title>
  <meta name="description" content="{{ $tab === 'sirine' ? __('site.sirine.meta') : __('site.category.meta') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/img/faizalmotor_logo.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/category.css">
  <style>
    /* ===================================================
       CATALOG UNIFIED — Extra styles for tab switcher
       and mobile-only brand header
    =================================================== */

    /* Hide old navbar completely on mobile — fix bug */
    @media (max-width: 768px) {
      .navbar { display: none !important; }
    }

    /* Mobile-brand-header: hidden on desktop, shown on mobile */
    .mobile-brand-header {
      display: none;
    }
    @media (max-width: 768px) {
      .mobile-brand-header {
        display: flex;
        position: sticky;
        top: 0;
        z-index: 500;
        background: #fff;
        border-bottom: 1px solid #D9D9D9;
        align-items: center;
        padding: 10px 16px;
        height: 52px;
        box-shadow: 0 1px 8px rgba(0,0,0,.06);
      }
      .mobile-brand-header a {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
      }
      .mobile-brand-header img {
        height: 32px;
        width: auto;
        object-fit: contain;
      }
      .mobile-brand-header strong {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 17px;
        font-weight: 700;
        color: #0B0B0B;
        text-transform: uppercase;
      }
    }

    /* ===== TAB SWITCHER ===== */
    .catalog-tabs {
      display: flex;
      background: #fff;
      border-bottom: 2px solid #D9D9D9;
      position: sticky;
      top: 52px; /* below mobile header */
      z-index: 400;
      overflow-x: auto;
      scrollbar-width: none;
    }
    @media (min-width: 768px) {
      .catalog-tabs {
        top: 0; /* desktop: no mobile header above */
        border-bottom: 2px solid #D9D9D9;
      }
    }
    .catalog-tabs::-webkit-scrollbar { display: none; }

    .catalog-tab {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 14px 20px;
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 15px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #737373;
      text-decoration: none;
      border-bottom: 3px solid transparent;
      margin-bottom: -2px;
      white-space: nowrap;
      transition: color 0.2s, border-color 0.2s;
      -webkit-tap-highlight-color: transparent;
    }
    .catalog-tab.is-active {
      color: #0B0B0B;
      border-bottom-color: #E63946;
    }
    .catalog-tab svg {
      flex-shrink: 0;
    }
    .catalog-tab__count {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 20px;
      height: 20px;
      padding: 0 5px;
      border-radius: 99px;
      background: #f1f5f9;
      color: #737373;
      font-size: 11px;
      font-weight: 700;
      font-family: 'Inter', system-ui, sans-serif;
    }
    .catalog-tab.is-active .catalog-tab__count {
      background: rgba(230,57,70,0.1);
      color: #E63946;
    }

    /* ===== PAGE HEADER (compact) ===== */
    .page-header {
      padding: 18px 16px 14px;
      background: #fff;
      border-bottom: 1px solid #D9D9D9;
    }
    .page-header h1 {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 22px;
      font-weight: 700;
      text-transform: uppercase;
      color: #0B0B0B;
    }
    @media (min-width: 768px) {
      .page-header { padding: 24px 24px 18px; }
      .page-header h1 { font-size: 28px; }
    }

    /* ===== PRODUCT CARD — unified style ===== */
    .product-card {
      background: #fff;
      border-radius: 12px;
      border: 1px solid #D9D9D9;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      box-shadow: 0 2px 8px rgba(0,0,0,0.06);
      transition: box-shadow 0.2s, transform 0.2s;
    }
    .product-card:hover {
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
      transform: translateY(-2px);
    }
    .card-link, .main-link {
      text-decoration: none;
      color: inherit;
      display: flex;
      flex-direction: column;
      flex: 1;
    }
    .image-wrapper {
      aspect-ratio: 1;
      overflow: hidden;
      background: #f0f7fb;
    }
    .image-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }
    .product-card:hover .image-wrapper img {
      transform: scale(1.04);
    }
    .card-body {
      padding: 12px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }
    .tag, .motor-tag {
      display: inline-flex;
      padding: 3px 8px;
      border-radius: 99px;
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 10px;
      font-weight: 600;
      align-self: flex-start;
      margin-bottom: 6px;
    }
    .tag { background: #eff6ff; color: #0369a1; }
    .motor-tag { background: rgba(230,57,70,0.08); color: #E63946; }

    .product-card h3 {
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 14px;
      font-weight: 600;
      color: #0B0B0B;
      line-height: 1.4;
      margin-bottom: 6px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      min-height: 40px;
    }
    .price {
      margin-top: auto;
      padding-top: 8px;
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 16px;
      font-weight: 700;
      color: #E63946;
    }

    /* Sirine card additions */
    .description {
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 12px;
      color: #737373;
      line-height: 1.5;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      margin-bottom: 8px;
      min-height: 36px;
    }
    .card-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 8px;
      margin-top: auto;
    }
    .btn-detail {
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 11px;
      font-weight: 600;
      color: #5CBDEB;
      background: rgba(92,189,235,0.1);
      padding: 4px 10px;
      border-radius: 99px;
      white-space: nowrap;
    }
    .btn-wa {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      width: 100%;
      padding: 10px 12px;
      background: #25D366;
      color: #fff;
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      border-radius: 0 0 12px 12px;
      min-height: 44px;
      transition: opacity 0.2s;
      -webkit-tap-highlight-color: transparent;
    }
    .btn-wa:active { opacity: 0.85; }

    /* Store links */
    .store-links {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      padding: 10px 12px 12px;
      border-top: 1px solid #f1f5f9;
    }
    .btn-store-card {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 5px 10px;
      border-radius: 99px;
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 11px;
      font-weight: 600;
      text-decoration: none;
      background: #f8fafc;
      color: #0B0B0B;
      border: 1px solid #e2e8f0;
      transition: background 0.2s;
    }
    .btn-store-card:active { background: #e2e8f0; }
    .btn-store-card .shopee-icon img { width: 14px; height: 14px; object-fit: contain; }

    /* Product grid */
    .product-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 12px;
    }
    @media (min-width: 560px) {
      .product-grid { grid-template-columns: repeat(3, 1fr); gap: 14px; }
    }
    @media (min-width: 768px) {
      .product-grid { grid-template-columns: repeat(3, 1fr); gap: 16px; }
    }
    @media (min-width: 1024px) {
      .product-grid { grid-template-columns: repeat(4, 1fr); gap: 18px; }
    }

    /* Products section */
    .products-section {
      max-width: 1280px;
      margin: 0 auto;
      padding: 20px 16px 40px;
    }
    @media (min-width: 768px) {
      .products-section { padding: 24px 24px 60px; }
    }

    /* Filter section */
    .filter-section {
      background: #fff;
      border-bottom: 1px solid #D9D9D9;
      padding: 14px 16px;
    }
    @media (min-width: 768px) {
      .filter-section { padding: 18px 24px; }
    }
    .filter-inline { max-width: 1280px; margin: 0 auto; }
    .filter-group { margin-bottom: 12px; }
    .filter-group:last-child { margin-bottom: 0; }
    .filter-group label {
      display: block;
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 11px;
      font-weight: 600;
      color: #737373;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 8px;
    }
    .chip-row {
      display: flex;
      flex-wrap: nowrap;
      gap: 6px;
      overflow-x: auto;
      padding-bottom: 4px;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
    }
    .chip-row::-webkit-scrollbar { display: none; }
    .chip {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 6px 14px;
      border-radius: 99px;
      text-decoration: none;
      background: #f1f5f9;
      color: #737373;
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 12px;
      font-weight: 500;
      border: 1px solid transparent;
      cursor: pointer;
      user-select: none;
      transition: 0.2s;
      white-space: nowrap;
      flex-shrink: 0;
      -webkit-tap-highlight-color: transparent;
    }
    .chip:hover { background: #e2e8f0; color: #0B0B0B; }
    .chip.active { background: #0B0B0B; color: #fff; }
    .selectbox {
      width: 100%;
      max-width: 240px;
      border: 1px solid #D9D9D9;
      border-radius: 8px;
      background: #f8fafc;
      padding: 9px 12px;
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 13px;
      font-weight: 500;
      color: #0B0B0B;
      outline: none;
      cursor: pointer;
    }
    .selectbox:focus { border-color: #5CBDEB; }
    .btn-reset {
      display: inline-block;
      text-decoration: none;
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 12px;
      font-weight: 600;
      color: #E63946;
      background: rgba(230,57,70,0.07);
      padding: 7px 14px;
      border-radius: 99px;
      margin-top: 6px;
      transition: 0.2s;
    }
    .btn-reset:hover { background: #E63946; color: #fff; }

    /* Empty state */
    .empty-state {
      background: #fff;
      border-radius: 12px;
      border: 1px solid #D9D9D9;
      padding: 40px 20px;
      text-align: center;
    }
    .empty-state h3 {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 22px;
      text-transform: uppercase;
      color: #0B0B0B;
      margin-bottom: 8px;
    }
    .empty-state p {
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 14px;
      color: #737373;
      margin-bottom: 20px;
    }
    .empty-actions {
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
    }
    .empty-actions a {
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 8px;
      color: #fff;
      font-family: 'Inter', system-ui, sans-serif;
      font-weight: 600;
      font-size: 13px;
      background: #0B0B0B;
      transition: 0.2s;
    }
    .empty-actions a:hover { opacity: 0.85; }

    /* Pagination */
    .pagination-wrap {
      display: flex;
      justify-content: center;
      margin-top: 28px;
    }
    .pagination-wrap nav > div:first-child { display: none; }
    .pagination-wrap nav > div:last-child {
      display: flex;
      align-items: center;
      gap: 4px;
    }
    .pagination-wrap a,
    .pagination-wrap span {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 36px;
      height: 36px;
      padding: 0 8px;
      border-radius: 8px;
      border: 1px solid #D9D9D9;
      background: #fff;
      color: #0B0B0B;
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.2s;
    }
    .pagination-wrap a:hover { background: #0B0B0B; color: #fff; border-color: #0B0B0B; }
    .pagination-wrap span[aria-current="page"] { background: #0B0B0B; color: #fff; border-color: #0B0B0B; }

    /* Footer */
    .footer {
      background: #0B0B0B;
      color: #fff;
      text-align: center;
      padding: 18px 16px 90px; /* extra bottom for mobile navbar */
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 13px;
      margin-top: 32px;
    }
    @media (min-width: 768px) {
      .footer { padding: 22px 24px; }
    }

    /* Desktop navbar */
    @media (min-width: 768px) {
      .navbar {
        display: flex !important;
        position: sticky;
        top: 0;
        z-index: 500;
        background: #fff;
        border-bottom: 1px solid #D9D9D9;
        box-shadow: 0 1px 8px rgba(0,0,0,.06);
        padding: 14px 24px;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
      }
      .navbar .left { display: flex; align-items: center; gap: 10px; }
      .navbar .left img { width: 38px; height: 38px; object-fit: contain; }
      .navbar .left h1 {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 18px;
        font-weight: 700;
        text-transform: uppercase;
        color: #0B0B0B;
      }
      .navbar ul {
        display: flex;
        list-style: none;
        gap: 20px;
        align-items: center;
      }
      .navbar ul a {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        color: #737373;
        transition: color 0.2s;
      }
      .navbar ul a:hover,
      .navbar ul a.active { color: #E63946; }
      .locale-switch {
        display: flex !important;
        gap: 4px;
      }
      .locale-switch a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 28px;
        padding: 0 8px;
        border-radius: 4px;
        border: 1px solid #D9D9D9;
        background: #fff;
        font-family: 'Inter', system-ui, sans-serif;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
        color: #0B0B0B;
        transition: 0.2s;
      }
      .locale-switch a.active {
        background: #0B0B0B;
        color: #fff;
        border-color: #0B0B0B;
      }
      .nav-toggle { display: none !important; }

      /* Tab bar: below desktop navbar, not sticky-top-0 */
      .catalog-tabs { top: 57px; }
    }

    /* Results bar */
    .results-bar {
      background: #F4F4F4;
      padding: 10px 16px;
      border-bottom: 1px solid #D9D9D9;
    }
    .results-bar p {
      font-family: 'Inter', system-ui, sans-serif;
      font-size: 13px;
      color: #737373;
      max-width: 1280px;
      margin: 0 auto;
    }
    @media (min-width: 768px) {
      .results-bar { padding: 10px 24px; }
    }

    /* Body padding for bottom navbar */
    @media (max-width: 768px) {
      body { padding-bottom: 76px; }
    }
  </style>
</head>
<body class="has-bottom-nav">

  {{-- MINIMAL MOBILE HEADER (hidden on desktop) --}}
  <header class="mobile-brand-header">
    <a href="/">
      <img src="{{ asset('img/faizalmotor_logo.png') }}" alt="{{ __('site.brand') }}">
      <strong>{{ __('site.brand') }}</strong>
    </a>
  </header>

  {{-- DESKTOP NAVBAR (hidden on mobile via CSS) --}}
  <div class="navbar">
    <div class="left">
      <img src="{{ asset('img/faizalmotor_logo.png') }}" alt="{{ __('site.brand') }}">
      <h1>{{ __('site.brand') }}</h1>
    </div>
    <ul data-nav-menu>
      <li><a href="/">{{ __('site.nav.home') }}</a></li>
      <li><a href="/kategori" class="{{ $tab === 'lampu' ? 'active' : '' }}">{{ __('site.nav.category') }}</a></li>
      <li><a href="/kategori?tab=sirine" class="{{ $tab === 'sirine' ? 'active' : '' }}">{{ __('site.nav.sirine') }}</a></li>
      <li><a href="/lokasi">Lokasi</a></li>
      <li><a href="/kontak">{{ __('site.nav.contact') }}</a></li>
      <li class="locale-switch">
        <a href="{{ route('locale.switch', 'id') }}" class="{{ app()->getLocale() === 'id' ? 'active' : '' }}">ID</a>
        <a href="{{ route('locale.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
      </li>
    </ul>
  </div>

  {{-- TAB SWITCHER --}}
  <div class="catalog-tabs" role="tablist" aria-label="Jenis Produk">
    <a href="/kategori?tab=lampu"
       class="catalog-tab {{ $tab === 'lampu' ? 'is-active' : '' }}"
       role="tab" aria-selected="{{ $tab === 'lampu' ? 'true' : 'false' }}"
       id="tab-lampu">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
      </svg>
      Lampu Motor
      @if($tab === 'lampu' && $products instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <span class="catalog-tab__count">{{ $products->total() }}</span>
      @endif
    </a>
    <a href="/kategori?tab=sirine"
       class="catalog-tab {{ $tab === 'sirine' ? 'is-active' : '' }}"
       role="tab" aria-selected="{{ $tab === 'sirine' ? 'true' : 'false' }}"
       id="tab-sirine">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
      </svg>
      Sirine & Klakson
      @if($tab === 'sirine' && $sirines instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <span class="catalog-tab__count">{{ $sirines->total() }}</span>
      @endif
    </a>
  </div>

  {{-- PAGE HEADER --}}
  <div class="page-header">
    <h1>
      @if($tab === 'sirine')
        {{ __('site.sirine.heading') }}
      @else
        {{ __('site.category.heading') }}
      @endif
    </h1>
  </div>

  {{-- ============================================================
       TAB: LAMPU MOTOR
  ============================================================ --}}
  @if($tab === 'lampu')

    {{-- Filter section --}}
    <div class="filter-section">
      <div class="filter-inline">
        {{-- Brand filter --}}
        <div class="filter-group">
          <label>{{ __('site.category.brand') }}</label>
          <div class="chip-row">
            <a class="chip {{ !request('brand') ? 'active' : '' }}" href="/kategori?tab=lampu">Semua</a>
            @foreach($brands as $brand)
              <a class="chip {{ request('brand') === $brand->name ? 'active' : '' }}"
                 href="{{ url('/kategori') }}?tab=lampu&brand={{ urlencode($brand->name) }}">{{ $brand->name }}</a>
            @endforeach
          </div>
        </div>

        @if(request('brand') && count($modelFamilies) > 0)
        <div class="filter-group">
          <label>{{ __('site.category.variant') }}</label>
          <div class="chip-row">
            <a class="chip {{ !$selectedFamily ? 'active' : '' }}" onclick="applyFamily('')">Semua</a>
            @foreach($modelFamilies as $family)
              <a class="chip {{ $selectedFamily === $family['family'] ? 'active' : '' }}"
                 onclick="applyFamily('{{ addslashes($family['family']) }}')">{{ $family['family'] }}</a>
            @endforeach
          </div>
        </div>
        @endif

        @if($models->isNotEmpty())
        <div class="filter-group">
          <label>{{ __('site.category.generation') }}</label>
          <div class="chip-row">
            <a class="chip {{ !request('model') ? 'active' : '' }}" onclick="applyGeneration('')">Semua</a>
            @foreach($models as $model)
              <a class="chip {{ request('model') === $model->name ? 'active' : '' }}"
                 onclick="applyGeneration('{{ addslashes($model->name) }}')">
                {{ $model->generation_name ?? $model->name }}
              </a>
            @endforeach
          </div>
        </div>
        @endif

        <div class="filter-group">
          <label>{{ __('site.category.sort_price') }}</label>
          <select class="selectbox" onchange="applySort(this.value)">
            <option value="">{{ __('site.category.best') }}</option>
            <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>{{ __('site.category.cheapest') }}</option>
            <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>{{ __('site.category.expensive') }}</option>
          </select>
        </div>

        @if(request('brand') || request('family') || request('model') || request('sort'))
          <a class="btn-reset" href="/kategori?tab=lampu">{{ __('site.category.reset') }}</a>
        @endif
      </div>
    </div>

    {{-- Results --}}
    @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->total() > 0)
      <div class="results-bar">
        <p>Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk lampu motor</p>
      </div>
    @endif

    {{-- Product grid --}}
    <section class="products-section">
      @if(!$products instanceof \Illuminate\Pagination\LengthAwarePaginator || $products->isEmpty())
        <div class="empty-state">
          <h3>{{ __('site.category.empty_title') }}</h3>
          <p>{{ __('site.category.empty_text') }}</p>
          <div class="empty-actions">
            <a href="/kategori?tab=lampu">{{ __('site.category.all_products') }}</a>
          </div>
        </div>
      @else
        <div class="product-grid">
          @foreach($products as $product)
            <article class="product-card">
              <a class="card-link" href="/product/{{ $product->id }}-{{ Str::slug($product->name) }}">
                <div class="image-wrapper">
                  <img src="{{ $product->image ? Storage::url($product->image) : asset('placeholder.png') }}" alt="{{ $product->name }}" loading="lazy" decoding="async">
                </div>
                <div class="card-body">
                  <span class="tag">{{ $product->model->brand->name ?? '-' }}</span>
                  <h3>{{ $product->name }}</h3>
                  <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
              </a>
            </article>
          @endforeach
        </div>

        @if($products->hasPages())
          <div class="pagination-wrap">{{ $products->onEachSide(1)->links() }}</div>
        @endif
      @endif
    </section>

  @endif

  {{-- ============================================================
       TAB: SIRINE & KLAKSON
  ============================================================ --}}
  @if($tab === 'sirine')

    @if($sirines instanceof \Illuminate\Pagination\LengthAwarePaginator && $sirines->total() > 0)
      <div class="results-bar">
        <p>Menampilkan {{ $sirines->count() }} dari {{ $sirines->total() }} produk sirine & klakson</p>
      </div>
    @endif

    <section class="products-section">
      @if(!$sirines instanceof \Illuminate\Pagination\LengthAwarePaginator || $sirines->isEmpty())
        <div class="empty-state">
          <h3>{{ __('site.sirine.empty_title') }}</h3>
          <p>{{ __('site.sirine.empty_text') }}</p>
          <div class="empty-actions">
            <a href="/kontak">{{ __('site.sirine.contact_us') }}</a>
            <a href="https://wa.me/6281223466068?text={{ rawurlencode('Halo Faizal Motor 139, saya mau tanya produk sirine.') }}" target="_blank" style="background:#25D366;">Chat WA</a>
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
                  <span class="motor-tag">Sirine</span>
                  <h3>{{ $sirine->name }}</h3>
                  <p class="description">{{ $sirine->description }}</p>
                  <div class="card-footer">
                    <span class="price">Rp {{ number_format($sirine->price, 0, ',', '.') }}</span>
                    <span class="btn-detail">Detail →</span>
                  </div>
                </div>
              </a>
              <a class="btn-wa"
                 href="https://wa.me/6281223466068?text={{ rawurlencode('Halo admin, saya tertarik dengan '.$sirine->name.' (Rp '.number_format($sirine->price, 0, ',', '.').')') }}"
                 target="_blank">
                <svg width="15" height="15" viewBox="0 0 448 512" fill="currentColor">
                  <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L3 480l117.7-30.9c32.4 17.7 68.9 27 106.2 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                </svg>
                Order WhatsApp
              </a>
              @php
                $stores = collect([
                  ['label' => 'Shopee', 'url' => $sirine->shopee_url, 'class' => 'store-shopee', 'icon' => asset('img/shopee.png')],
                  ['label' => 'TikTok', 'url' => $sirine->tiktokshop_url, 'class' => 'store-tiktok', 'icon' => asset('img/tiktok.png')],
                  ['label' => 'Tokopedia', 'url' => $sirine->tokopedia_url, 'class' => 'store-tokopedia', 'icon' => asset('img/tokopedia.png')],
                ])->filter(fn ($s) => filled($s['url']));
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

  @endif

  <footer class="footer">
    <p>&copy; 2026 {{ __('site.brand') }}</p>
  </footer>

  @include('components.bottom-navbar')

  <script src="/script.js"></script>
  <script>
    function currentParams() {
      const p = new URLSearchParams(window.location.search);
      // Preserve tab param
      if (!p.has('tab')) p.set('tab', 'lampu');
      return p;
    }
    function applyFamily(value) {
      const params = currentParams();
      value ? params.set('family', value) : params.delete('family');
      params.delete('model');
      window.location.href = '/kategori?' + params.toString();
    }
    function applyGeneration(value) {
      const params = currentParams();
      value ? params.set('model', value) : params.delete('model');
      window.location.href = '/kategori?' + params.toString();
    }
    function applySort(value) {
      const params = currentParams();
      value ? params.set('sort', value) : params.delete('sort');
      window.location.href = '/kategori?' + params.toString();
    }
  </script>
</body>
</html>
