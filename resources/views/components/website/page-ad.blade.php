@php
    $images = $ad->images();
    $url = $ad->targetUrl();
    $newTab = $ad->opensNewTab();
    $isSlider = count($images) > 1;
    $isRtl = app()->getLocale() === 'ar';
    $linkAttrs = $url ? 'href="' . e($url) . '"' . ($newTab ? ' target="_blank" rel="noopener sponsored"' : '') : '';
@endphp

@once
    <link rel="stylesheet" href="{{ asset('/website_assets/css/page-ads.css') }}">
@endonce

<aside class="page_ad page_ad--{{ $layout }} page_ad--{{ $page }}" aria-label="{{ __('links.' . $theme['title']) }}"
    data-page-ad="{{ $page }}">

    @if ($layout === 'banner')
        <div class="page_ad__copy">
            <span class="page_ad__badge"><i class="fa-solid {{ $theme['icon'] }}"></i> {{ __('links.ad_badge') }}</span>
            <h3 class="page_ad__title">{{ __('links.' . $theme['title']) }}</h3>
            <p class="page_ad__text">{{ __('links.' . $theme['text']) }}</p>
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

    <div class="page_ad__media">
        <div class="page_ad__frame" @if ($isSlider) data-ad-slider @endif>
            @foreach ($images as $i => $image)
                @if ($url)
                    <a {!! $linkAttrs !!} class="page_ad__slide {{ $i === 0 ? 'is-active' : '' }}" @if ($i > 0) aria-hidden="true" tabindex="-1" @endif>
                @else
                    <div class="page_ad__slide {{ $i === 0 ? 'is-active' : '' }}" @if ($i > 0) aria-hidden="true" @endif>
                @endif
                    <img src="{{ $ad->imageUrl($image) }}" alt="{{ __('links.' . $theme['title']) }}"
                        width="700" height="1000" loading="lazy" decoding="async">
                @if ($url)
                    </a>
                @else
                    </div>
                @endif
            @endforeach
            <span class="page_ad__ribbon">{{ __('links.ad_badge') }}</span>

            @if ($isSlider)
                <div class="page_ad__dots" role="tablist">
                    @foreach ($images as $i => $image)
                        <button type="button" class="page_ad__dot {{ $i === 0 ? 'is-active' : '' }}" data-ad-dot="{{ $i }}"
                            aria-label="{{ $i + 1 }} / {{ count($images) }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</aside>

@once
    <script>
        // Fade slider for page ads: auto-advances, pauses on hover/focus, dots to jump.
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-ad-slider]').forEach(function(frame) {
                var slides = frame.querySelectorAll('.page_ad__slide');
                var dots = frame.querySelectorAll('[data-ad-dot]');
                var current = 0, timer = null;
                var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

                function show(index) {
                    current = (index + slides.length) % slides.length;
                    slides.forEach(function(slide, i) {
                        var active = i === current;
                        slide.classList.toggle('is-active', active);
                        slide.setAttribute('aria-hidden', active ? 'false' : 'true');
                        slide.setAttribute('tabindex', active ? '0' : '-1');
                    });
                    dots.forEach(function(dot, i) { dot.classList.toggle('is-active', i === current); });
                }
                function play() {
                    if (!reduceMotion && !timer) timer = setInterval(function() { show(current + 1); }, 4500);
                }
                function pause() { clearInterval(timer); timer = null; }

                dots.forEach(function(dot) {
                    dot.addEventListener('click', function() { show(+dot.dataset.adDot); pause(); play(); });
                });
                frame.addEventListener('mouseenter', pause);
                frame.addEventListener('mouseleave', play);
                frame.addEventListener('focusin', pause);
                frame.addEventListener('focusout', play);
                play();
            });
        });
    </script>
@endonce
