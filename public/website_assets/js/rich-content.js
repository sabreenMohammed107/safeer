/*
 * Lightbox for images inside admin editor output (`.rich-content`, see rich-content.css).
 *
 * - One overlay is created lazily and reused; clicks are delegated from `document`,
 *   so content injected later (AJAX, tabs) works without re-binding.
 * - Images the editor wrapped in a link are left alone so the link still works.
 * - Closes on the X button, a click on the backdrop, or Escape.
 */
(function () {
    'use strict';

    var CONTAINER = '.rich-content';
    var overlay, overlayImg, closeBtn, lastFocused;

    function isZoomable(img) {
        return img.closest(CONTAINER) && !img.closest('a');
    }

    function fullSrc(img) {
        // data-full / data-src cover editors and lazy-loaders that keep the large file elsewhere
        return img.getAttribute('data-full') || img.getAttribute('data-src') || img.currentSrc || img.src;
    }

    function build() {
        overlay = document.createElement('div');
        overlay.className = 'rc-lightbox';
        overlay.setAttribute('role', 'dialog');
        overlay.setAttribute('aria-modal', 'true');
        overlay.setAttribute('aria-hidden', 'true');

        closeBtn = document.createElement('button');
        closeBtn.type = 'button';
        closeBtn.className = 'rc-lightbox__close';
        closeBtn.innerHTML = '&times;';

        overlayImg = document.createElement('img');
        overlayImg.className = 'rc-lightbox__img';
        overlayImg.alt = '';

        overlay.appendChild(closeBtn);
        overlay.appendChild(overlayImg);
        document.body.appendChild(overlay);

        closeBtn.addEventListener('click', close);
        overlay.addEventListener('click', function (e) {
            // backdrop only — clicking the image itself keeps it open
            if (e.target === overlay) close();
        });
    }

    function open(img) {
        if (!overlay) build();

        var rtl = getComputedStyle(img).direction === 'rtl';
        overlay.setAttribute('dir', rtl ? 'rtl' : 'ltr');
        closeBtn.setAttribute('aria-label', rtl ? 'إغلاق' : 'Close');
        overlay.setAttribute('aria-label', img.alt || (rtl ? 'معاينة الصورة' : 'Image preview'));

        overlayImg.src = fullSrc(img);
        overlayImg.alt = img.alt || '';

        lastFocused = document.activeElement;
        overlay.classList.add('is-open');
        overlay.setAttribute('aria-hidden', 'false');
        document.body.classList.add('rc-lightbox-open');
        closeBtn.focus();
    }

    function close() {
        if (!overlay || !overlay.classList.contains('is-open')) return;
        overlay.classList.remove('is-open');
        overlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('rc-lightbox-open');
        if (lastFocused && lastFocused.focus) lastFocused.focus();
    }

    // Zoom cursor + keyboard access for images already on the page
    function mark(root) {
        (root || document).querySelectorAll(CONTAINER + ' img').forEach(function (img) {
            if (!isZoomable(img) || img.classList.contains('rc-zoomable')) return;
            img.classList.add('rc-zoomable');
            img.setAttribute('tabindex', '0');
            img.setAttribute('role', 'button');
        });
    }

    document.addEventListener('click', function (e) {
        var img = e.target.closest && e.target.closest(CONTAINER + ' img');
        if (!img || !isZoomable(img)) return;
        e.preventDefault();
        open(img);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            close();
            return;
        }
        if ((e.key === 'Enter' || e.key === ' ') && e.target.classList &&
            e.target.classList.contains('rc-zoomable')) {
            e.preventDefault();
            open(e.target);
        }
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () { mark(); });
    } else {
        mark();
    }

    // For content injected after load: window.SaferRichContent.refresh(container)
    window.SaferRichContent = { refresh: mark, open: open, close: close };
})();
