{{--
    Collapsible cart item card (used by website/booking.blade.php).
    The status badge is refreshed client-side from the validity of the
    required fields inside the card; `ready` only sets the initial state.
--}}
@props([
    'id',
    'icon',
    'type',
    'title',
    'meta' => null,
    'price',
    'priceClass' => '',
    'deleteUrl' => null,
    'deleteMessage' => null,
    'open' => false,
    'ready' => false,
])
@php
    $isEn = LaravelLocalization::getCurrentLocale() === 'en';
@endphp
<article class="sc-item" data-sc-item>
    <div class="sc-item__head">
        <button type="button" class="sc-item__toggle {{ $open ? '' : 'collapsed' }}" data-bs-toggle="collapse"
            data-bs-target="#{{ $id }}" aria-expanded="{{ $open ? 'true' : 'false' }}"
            aria-controls="{{ $id }}">
            <span class="sc-item__icon"><i class="fa-solid {{ $icon }}"></i></span>
            <span class="sc-item__text">
                <span class="sc-item__type">{{ $type }}</span>
                <span class="sc-item__title">{{ $title }}</span>
                @if ($meta)
                    <span class="sc-item__meta">{{ $meta }}</span>
                @endif
            </span>
            <span class="sc-item__aside">
                <span class="sc-badge {{ $ready ? 'sc-badge--ready' : 'sc-badge--pending' }}" data-sc-status
                    data-label-ready="{{ $isEn ? 'Ready' : 'جاهز' }}"
                    data-label-pending="{{ $isEn ? 'Details needed' : 'بيانات مطلوبة' }}">
                    {{ $ready ? ($isEn ? 'Ready' : 'جاهز') : ($isEn ? 'Details needed' : 'بيانات مطلوبة') }}
                </span>
                <span class="sc-item__price {{ $priceClass }}">{{ $price }}</span>
            </span>
            <i class="fa-solid fa-chevron-down sc-item__chevron" aria-hidden="true"></i>
        </button>
        @if ($deleteUrl)
            <a class="sc-item__delete delete_trash" href="{{ $deleteUrl }}"
                @if ($deleteMessage) data-confirm="{{ $deleteMessage }}" @endif
                title="{{ $isEn ? 'Remove from cart' : 'حذف من السلة' }}"
                aria-label="{{ $isEn ? 'Remove from cart' : 'حذف من السلة' }}">
                <i class="fa-solid fa-trash"></i>
            </a>
        @endif
    </div>
    <div id="{{ $id }}" class="collapse {{ $open ? 'show' : '' }}">
        <div class="sc-item__body">
            {{ $slot }}
        </div>
    </div>
</article>
