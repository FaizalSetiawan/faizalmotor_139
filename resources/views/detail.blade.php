@php
  $galleryImages = collect(array_merge([$product->image], $product->gallery_images ?? []))->filter()->unique()->map(fn ($path) => ['type' => 'image', 'src' => Storage::url($path)])->values();
  $galleryVideos = collect($product->gallery_videos ?? [])->filter()->map(fn ($path) => ['type' => 'video', 'src' => Storage::url($path)])->values();
  $mediaItems = $galleryImages->concat($galleryVideos)->values();
  $activeDescription = app()->getLocale() === 'en' && filled($product->english_description)
      ? $product->english_description
      : $product->description;
  $formattedDescription = preg_replace('/\s+(\d+\.)/', "\n$1", $activeDescription);
  $formattedDescription = preg_replace('/\s*-\s*/', "\n- ", $formattedDescription);
  $whatsappIcon = asset('img/whatsapp.png');
  $shopeeIcon = asset('img/shopee.png');
  $tiktokIcon = asset('img/tiktok.png');
  $tokopediaIcon = asset('img/tokopedia.png');
  $storeLinks = collect([
      ['label' => 'Shopee', 'url' => $product->shopee_url, 'class' => 'store-shopee', 'icon' => $shopeeIcon],
      ['label' => 'TikTok Shop', 'url' => $product->tiktokshop_url, 'class' => 'store-tiktok', 'icon' => $tiktokIcon],
      ['label' => 'Tokopedia', 'url' => $product->tokopedia_url, 'class' => 'store-tokopedia', 'icon' => $tokopediaIcon],
  ])->filter(fn ($item) => filled($item['url']))->values();
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <title>{{ $product->name }} - {{ __('site.brand') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{ $product->name }} - {{ __('site.brand') }}">
  <link rel="icon" href="/img/faizalmotor_logo.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="/detail/style.css">
</head>
<body class="has-bottom-nav">
<div class="site-loader" id="siteLoader"><div class="site-loader__badge"></div><p>{{ __('site.common.loading_products') }}</p></div>
<div class="topbar" id="topbar">
  <a class="brandmark" href="/"><img src="/img/faizalmotor_logo.png" alt="{{ __('site.brand') }}"><span><strong>{{ __('site.brand') }}</strong><small>{{ __('site.tagline') }}</small></span></a>
  <button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-label="Toggle navigation">☰</button>
  <div class="topbar__links" data-nav-menu>
    <a href="/">{{ __('site.nav.home') }}</a>
    <a href="/kategori" class="is-active">{{ __('site.nav.category') }}</a>
    <a href="/sirine">{{ __('site.nav.sirine') }}</a>
    <a href="/kontak">{{ __('site.nav.contact') }}</a>
    <div class="locale-switch">
      <a href="{{ route('locale.switch', 'id') }}" class="{{ app()->getLocale() === 'id' ? 'is-active' : '' }}">{{ __('site.language.id') }}</a>
      <a href="{{ route('locale.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'is-active' : '' }}">{{ __('site.language.en') }}</a>
    </div>
  </div>
</div>
<main class="detail-page">
  <section class="detail-hero">
    <a href="/kategori" class="back-btn">{{ __('site.detail.back_category') }}</a>
    <div class="detail-shell reveal">
      <div class="detail-media">
        <div class="detail-image-card">
          <div class="media-carousel">
            <div class="media-stage"><div class="media-track" id="mediaTrack">@foreach($mediaItems as $media)<div class="media-slide">@if($media['type']==='image')<img src="{{ $media['src'] }}" alt="{{ $product->name }}">@else<video src="{{ $media['src'] }}" controls playsinline preload="metadata"></video>@endif</div>@endforeach</div></div>
            @if($mediaItems->count() > 1)<div class="media-dots">@foreach($mediaItems as $media)<button type="button" class="media-dot{{ $loop->first ? ' is-active' : '' }}" onclick="goToMediaSlide({{ $loop->index }})"></button>@endforeach</div>@endif
          </div>
        </div>
      </div>
      <div class="detail-content">
        <span class="detail-badge">{{ __('site.detail.custom_premium') }}</span>
        <h1>{{ $product->name }}</h1>
        <div class="detail-meta"><span>{{ $product->model->brand->name ?? 'Motor' }}</span><span>{{ $product->model->name ?? '-' }}</span></div>
        <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
        <div class="desc desc-formatted">{!! nl2br(e($formattedDescription)) !!}</div>
        <div class="feature-grid">
          <div class="feature-card"><strong>{{ app()->getLocale() === 'en' ? 'Custom lighting setup' : 'Setup custom lampu' }}</strong><span>{{ app()->getLocale() === 'en' ? 'Designed for a sharper look, brighter output, and a cleaner custom finish.' : 'Dirancang untuk tampilan lebih tajam, cahaya lebih maksimal, dan hasil custom yang lebih rapi.' }}</span></div>
          <div class="feature-card"><strong>{{ app()->getLocale() === 'en' ? 'Neat wiring' : 'Kabel lebih rapi' }}</strong><span>{{ app()->getLocale() === 'en' ? 'Wiring layout is arranged to look cleaner, safer, and easier to maintain.' : 'Jalur kabel ditata agar terlihat lebih bersih, aman, dan lebih mudah dirawat.' }}</span></div>
          <div class="feature-card"><strong>{{ app()->getLocale() === 'en' ? 'PNP / ready to install' : 'PNP / siap pasang' }}</strong><span>{{ app()->getLocale() === 'en' ? 'Suitable for plug and play style installation on compatible setups without making the bike look messy.' : 'Cocok untuk konsep plug and play pada setup yang kompatibel tanpa membuat motor terlihat berantakan.' }}</span></div>
        </div>
        <div class="detail-note">{{ __('site.detail.note_product') }}</div>
        <div class="detail-actions">
          <a href="https://wa.me/6281223466068?text={{ rawurlencode((app()->getLocale() === 'en' ? 'Hello admin, I am interested in ' : 'Halo admin, saya tertarik dengan ').$product->name) }}" target="_blank" class="btn-wa"><span class="store-icon"><img src="{{ $whatsappIcon }}" alt="WhatsApp"></span><span>{{ __('site.detail.order_whatsapp') }}</span></a>
          <a href="https://wa.me/6281223466068?text={{ rawurlencode((app()->getLocale() === 'en' ? 'Hello admin, I want details for product ' : 'Halo admin, saya mau tanya detail produk ').$product->name) }}" target="_blank" class="btn-outline"><span>{{ __('site.detail.ask_detail') }}</span></a>
        </div>
        @if($storeLinks->isNotEmpty())
          <div class="store-links-grid">@foreach($storeLinks as $store)<a href="{{ $store['url'] }}" target="_blank" rel="noopener noreferrer" class="btn-store {{ $store['class'] }}"><span class="store-icon"><img src="{{ $store['icon'] }}" alt="{{ $store['label'] }}"></span><span>{{ __('site.detail.buy_in', ['store' => $store['label']]) }}</span></a>@endforeach</div>
        @endif
      </div>
    </div>
  </section>
  @if($related->isNotEmpty())
    <section class="related-section">
      <div class="section-head"><h2>{{ __('site.detail.related_products') }}</h2><p>{{ __('site.detail.related_products_text') }}</p></div>
      <div class="related-grid">
        @foreach($related as $item)
          <a href="/product/{{ $item->id }}-{{ \Illuminate\Support\Str::slug($item->name) }}" class="related-card reveal"><div class="related-card__image"><img src="{{ $item->image ? Storage::url($item->image) : asset('images/dummy/product-placeholder.jpg') }}" alt="{{ $item->name }}" loading="lazy" decoding="async"></div><div class="related-card__body"><span>{{ $item->model->name ?? '-' }}</span><h4>{{ $item->name }}</h4></div></a>
        @endforeach
      </div>
    </section>
  @endif
</main>
<a class="floating-wa" href="https://wa.me/6281223466068?text={{ rawurlencode(app()->getLocale() === 'en' ? 'Hello admin, I want to ask about custom motorcycle lights.' : 'Halo admin, saya mau tanya tentang custom lampu motor.') }}" target="_blank">{{ __('site.home.chat_admin') }}</a>

{{-- Sticky CTA Mobile — tampil di atas bottom navbar saat mobile --}}
<div class="sticky-cta-mobile" id="stickyCta">
  <a href="https://wa.me/6281223466068?text={{ rawurlencode((app()->getLocale() === 'en' ? 'Hello admin, I am interested in ' : 'Halo admin, saya tertarik dengan ').$product->name) }}"
     target="_blank"
     class="sticky-cta-mobile__btn sticky-cta-mobile__btn--wa">
    <img src="{{ asset('img/whatsapp.png') }}" alt="WA" class="sticky-cta-mobile__icon">
    <span>{{ __('site.detail.order_whatsapp') }}</span>
  </a>
  <a href="https://wa.me/6281223466068?text={{ rawurlencode((app()->getLocale() === 'en' ? 'Hello admin, I want details for product ' : 'Halo admin, saya mau tanya detail produk ').$product->name) }}"
     target="_blank"
     class="sticky-cta-mobile__btn sticky-cta-mobile__btn--tanya">
    <span>{{ __('site.detail.ask_detail') }}</span>
  </a>
</div>

@include('components.bottom-navbar')
<footer class="site-footer"><p>&copy; 2026 {{ __('site.brand') }}</p></footer>
<script src="/script.js"></script>
<script>
const mediaTrack=document.getElementById('mediaTrack');const mediaDots=Array.from(document.querySelectorAll('.media-dot'));const mediaSlides=Array.from(document.querySelectorAll('.media-slide'));let currentMediaIndex=0;let mediaTimer=null;let startX=0;let deltaX=0;
function updateMediaSlide(index,resetTimer=true){if(!mediaSlides.length)return;currentMediaIndex=(index+mediaSlides.length)%mediaSlides.length;mediaTrack.style.transform='translateX('+(currentMediaIndex*-100)+'%)';mediaDots.forEach((dot,i)=>dot.classList.toggle('is-active',i===currentMediaIndex));mediaSlides.forEach((slide,i)=>{const video=slide.querySelector('video');if(!video)return;if(i!==currentMediaIndex)video.pause();});if(resetTimer)restartMediaTimer();}
function goToMediaSlide(index){updateMediaSlide(index);}
function nextMediaSlide(){updateMediaSlide(currentMediaIndex+1,false);restartMediaTimer();}
function restartMediaTimer(){if(mediaTimer)clearTimeout(mediaTimer);if(mediaSlides.length<=1)return;const activeVideo=mediaSlides[currentMediaIndex].querySelector('video');mediaTimer=setTimeout(nextMediaSlide,activeVideo?8000:3500);}
mediaTrack?.addEventListener('touchstart',e=>{startX=e.touches[0].clientX;deltaX=0;},{passive:true});mediaTrack?.addEventListener('touchmove',e=>{deltaX=e.touches[0].clientX-startX;},{passive:true});mediaTrack?.addEventListener('touchend',()=>{Math.abs(deltaX)>50?updateMediaSlide(currentMediaIndex+(deltaX<0?1:-1)):updateMediaSlide(currentMediaIndex);});
mediaSlides.forEach((slide,index)=>{const video=slide.querySelector('video');if(!video)return;video.addEventListener('ended',()=>{if(index===currentMediaIndex)nextMediaSlide();});});if(mediaSlides.length){updateMediaSlide(0,false);restartMediaTimer();}
</script>
</body>
</html>
