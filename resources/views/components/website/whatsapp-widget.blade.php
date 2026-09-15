{{--
    Modern floating WhatsApp widget.

    Replaces the old "Blanter"-style fake chat popup (removed from
    components/website/header.blade.php) with a single, real wa.me link:
      - No fake multi-agent chat UI, no unencoded text, no user-agent sniffing.
      - The phone number is normalized to digits-only (wa.me rejects "+",
        spaces, dashes, parentheses).
      - The pre-filled message is localized (ar/en) and URL-encoded.

    Data source: $comFooter (the singleton Company row, id=1) is shared
    globally to every view via View::share() in App\Providers\AppServiceProvider,
    so this component needs no props and works wherever it's included.
--}}
@php
    $__waLocale = LaravelLocalization::getCurrentLocale();
    $__waRawPhone = $comFooter->chat_whatsapp ?? null;

    // Keep digits only -> valid wa.me format, e.g. "905444668838".
    $__waPhone = $__waRawPhone ? preg_replace('/\D+/', '', $__waRawPhone) : null;

    $__waMessage = $__waLocale === 'ar'
        ? 'مرحباً، أرغب في الاستفسار عن عروض السفر، وقد تواصلت معكم عبر الموقع الإلكتروني safer.travel'
        : 'Hello, I would like to inquire about your travel offers. I am reaching out via the safer.travel website.';

    $__waLink = $__waPhone ? 'https://wa.me/' . $__waPhone . '?text=' . rawurlencode($__waMessage) : null;
@endphp

@if ($__waLink)
    <a href="{{ $__waLink }}" id="waFab" class="wa-fab" target="_blank" rel="noopener noreferrer nofollow"
        aria-label="{{ __('links.whatsapp_cta') }}" title="{{ __('links.whatsapp_cta') }}">
        <span class="wa-fab__label">{{ __('links.whatsapp_cta') }}</span>
        <span class="wa-fab__icon">
            <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.29.173-1.414-.074-.124-.272-.198-.57-.347z" />
                <path
                    d="M12.004 2c-5.514 0-9.986 4.472-9.986 9.986 0 1.76.464 3.478 1.345 4.985L2 22l5.164-1.354a9.94 9.94 0 0 0 4.84 1.234h.004c5.513 0 9.985-4.472 9.985-9.986C21.993 6.472 17.517 2 12.004 2zm5.845 15.83a8.27 8.27 0 0 1-4.845 1.5h-.004a8.31 8.31 0 0 1-4.229-1.156l-.303-.18-3.065.804.818-2.987-.197-.306a8.28 8.28 0 0 1-1.27-4.42c0-4.583 3.73-8.312 8.318-8.312 2.222 0 4.31.866 5.881 2.438a8.26 8.26 0 0 1 2.436 5.881c0 4.588-3.73 8.317-8.34 8.317z" />
            </svg>
        </span>
    </a>
@endif
