<div class="fav-empty-state text-center py-5 {{ $hidden ? 'd-none' : '' }}" id="{{ $id }}">
    <i class="fa-regular fa-heart" style="font-size: 48px; opacity: .35;"></i>
    <p class="mt-3 mb-2">{{ __('links.no_favorites_yet') }}</p>
    <a href="{{ LaravelLocalization::localizeUrl($url) }}" class="btn submit_button">{{ __('links.browse_' . $type) }}</a>
</div>
