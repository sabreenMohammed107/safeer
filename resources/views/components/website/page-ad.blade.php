@php
    $images = $ad->images();
    $count = count($images);
    $url = $ad->targetUrl();
    $newTab = $ad->opensNewTab();
    $isSlider = $count > 1;
    $isRtl = app()->getLocale() === 'ar';
    $linkAttrs = $url ? 'href="' . e($url) . '"' . ($newTab ? ' target="_blank" rel="noopener sponsored"' : '') : '';
    $tag = $url ? 'a' : 'div';
    $alt = __('links.' . $theme['title']);

    // The banner speaks about the linked offer when there is one.
    $offer = $ad->offer;
    $offerTitle = $offer ? ($isRtl ? $offer->subtitle_ar : $offer->subtitle_en) ?: $offer->subtitle_en : null;
@endphp

@once
    {{-- ?v= busts the week-long CSS cache (.htaccess) whenever the file changes. --}}
    <link rel="stylesheet" href="{{ asset('/website_assets/css/page-ads.css') }}?v={{ filemtime(public_path('website_assets/css/page-ads.css')) }}">
@endonce

<aside class="page_ad page_ad--{{ $layout }} page_ad--{{ $page }} {{ $isSlider ? 'page_ad--multi' : 'page_ad--single' }}"
    aria-label="{{ $alt }}" data-page-ad="{{ $page }}">

    @if ($layout === 'banner')
        <div class="page_ad__copy">
            <span class="page_ad__badge"><i class="fa-solid {{ $theme['icon'] }}"></i> {{ __('links.' . $theme['title']) }}</span>
            <h3 class="page_ad__title">{{ $offerTitle ?: __('links.' . $theme['title']) }}</h3>
            <p class="page_ad__text">{{ __('links.' . $theme['text']) }}</p>

            @if ($offer && ($offer->cost || $offer->end_date))
                <ul class="page_ad__facts">
                    @if ($offer->cost)
                        <li><i class="fa-solid fa-tag"></i> {{ __('links.ad_from') }} <strong>{{ money($offer->cost) }}</strong></li>
                    @endif
                    @if ($offer->end_date)
                        <li><i class="fa-regular fa-calendar"></i> {{ __('links.ad_until') }} <strong>{{ $offer->periodDate('end_date') }}</strong></li>
                    @endif
                </ul>
            @endif

            @if ($url)
                <a {!! $linkAttrs !!} class="page_ad__cta">
                    {{ __('links.ad_cta') }}
                    <i class="fa-solid {{ $isRtl ? 'fa-arrow-left' : 'fa-arrow-right' }}"></i>
                </a>
            @endif
        </div>
    @else
        <div class="page_ad__head">
            <i class="fa-solid {{ $theme['icon'] }}"></i>
            <span>{{ __('links.' . $theme['title']) }}</span>
        </div>
    @endif

    {{-- The ad itself: one 700x1000 (7:10) image at a time; a slider swipes between them. --}}
    <div class="page_ad__media">
        <div class="page_ad__frame">
            <div class="page_ad__track" @if ($isSlider) data-ad-carousel tabindex="0" aria-roledescription="carousel" @endif>
                @foreach ($images as $i => $image)
                    <{{ $tag }} {!! $linkAttrs !!} class="page_ad__slide" data-ad-slide
                        style="--ad-img: url('{{ $ad->imageUrl($image) }}')"
                        @if ($isSlider) aria-label="{{ $alt }} {{ $i + 1 }} / {{ $count }}" @endif>
                        <img src="{{ $ad->imageUrl($image) }}" alt="{{ $alt }}" width="700" height="1000"
                            loading="{{ $i === 0 ? 'eager' : 'lazy' }}" decoding="async">
                    </{{ $tag }}>
                @endforeach
            </div>

            @if ($layout !== 'banner')
                <span class="page_ad__ribbon">{{ __('links.ad_badge') }}</span>
            @endif

            @if ($isSlider)
                <span class="page_ad__counter" aria-live="polite">
                    <i class="fa-regular fa-images"></i> <span data-ad-current>1</span> / {{ $count }}
                </span>
                <button type="button" class="page_ad__arrow page_ad__arrow--prev" data-ad-prev aria-label="{{ __('links.ad_prev') }}">
                    <i class="fa-solid {{ $isRtl ? 'fa-chevron-right' : 'fa-chevron-left' }}"></i>
                </button>
                <button type="button" class="page_ad__arrow page_ad__arrow--next" data-ad-next aria-label="{{ __('links.ad_next') }}">
                    <i class="fa-solid {{ $isRtl ? 'fa-chevron-left' : 'fa-chevron-right' }}"></i>
                </button>
                <div class="page_ad__dots">
                    @foreach ($images as $i => $image)
                        <button type="button" class="page_ad__dot {{ $i === 0 ? 'is-active' : '' }}" data-ad-dot="{{ $i }}"
                            aria-label="{{ $i + 1 }} / {{ $count }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</aside>

@once
    <script>
        // Page-ad slider: one image at a time in a scroll-snap track (so touch swipe is native),
        // with arrows, "n / total" counter, dots, ←/→ keys, and autoplay that pauses on
        // hover / focus / touch and while off screen. Works in LTR and RTL.
        document.addEventListener('DOMContentLoaded', function() {
            var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            document.querySelectorAll('[data-ad-carousel]').forEach(function(track) {
                var frame = track.closest('.page_ad__frame');
                var slides = track.querySelectorAll('[data-ad-slide]');
                var dots = frame.querySelectorAll('[data-ad-dot]');
                var counter = frame.querySelector('[data-ad-current]');
                var rtl = getComputedStyle(track).direction === 'rtl';
                var current = 0, timer = null, held = false, visible = true;

                function goTo(index) {
                    var i = (index + slides.length) % slides.length;
                    // scrollLeft runs negative in RTL.
                    track.scrollTo({ left: (rtl ? -1 : 1) * i * track.clientWidth, behavior: reduceMotion ? 'auto' : 'smooth' });
                }
                function sync() {
                    current = Math.round(Math.abs(track.scrollLeft) / track.clientWidth);
                    counter.textContent = current + 1;
                    dots.forEach(function(dot, i) { dot.classList.toggle('is-active', i === current); });
                    slides.forEach(function(slide, i) {
                        slide.setAttribute('aria-hidden', i === current ? 'false' : 'true');
                        slide.setAttribute('tabindex', i === current ? '0' : '-1');
                    });
                }
                function play() {
                    var run = !reduceMotion && visible && !held && !document.hidden;
                    if (run && !timer) timer = setInterval(function() { goTo(current + 1); }, 4500);
                    if (!run && timer) { clearInterval(timer); timer = null; }
                }
                function restart() { clearInterval(timer); timer = null; play(); }

                frame.querySelector('[data-ad-prev]').addEventListener('click', function() { goTo(current - 1); restart(); });
                frame.querySelector('[data-ad-next]').addEventListener('click', function() { goTo(current + 1); restart(); });
                dots.forEach(function(dot) {
                    dot.addEventListener('click', function() { goTo(+dot.dataset.adDot); restart(); });
                });
                track.addEventListener('keydown', function(e) {
                    if (e.key !== 'ArrowLeft' && e.key !== 'ArrowRight') return;
                    e.preventDefault();
                    goTo(current + ((e.key === 'ArrowRight') !== rtl ? 1 : -1));
                });

                var raf = null;
                track.addEventListener('scroll', function() {
                    cancelAnimationFrame(raf);
                    raf = requestAnimationFrame(sync);
                }, { passive: true });

                ['mouseenter', 'focusin', 'touchstart'].forEach(function(e) {
                    frame.addEventListener(e, function() { held = true; play(); }, { passive: true });
                });
                ['mouseleave', 'focusout'].forEach(function(e) {
                    frame.addEventListener(e, function() { held = false; play(); });
                });
                document.addEventListener('visibilitychange', play);
                if ('IntersectionObserver' in window) {
                    new IntersectionObserver(function(entries) { visible = entries[0].isIntersecting; play(); },
                        { threshold: 0.4 }).observe(frame);
                }
                sync();
                play();
            });
        });
    </script>
@endonce
