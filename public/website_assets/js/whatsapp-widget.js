/**
 * Modern WhatsApp floating widget behavior.
 * Pairs with: resources/views/components/website/whatsapp-widget.blade.php
 *             public/website_assets/css/whatsapp-widget.css
 *
 * The widget is a plain <a href="https://wa.me/..."> link, so no click
 * handling / window.open() logic is needed (unlike the old widget, this
 * works natively on desktop and mobile). The only behavior here is a
 * one-time "peek" of the label shortly after load, to help first-time
 * visitors notice the button without permanently taking up space.
 */
(function () {
    "use strict";

    var fab = document.querySelector(".wa-fab");
    if (!fab) {
        return;
    }

    var reduceMotion = window.matchMedia &&
        window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    if (reduceMotion) {
        return;
    }

    var peekTimer = window.setTimeout(function () {
        fab.classList.add("wa-fab--peek");
        window.setTimeout(function () {
            fab.classList.remove("wa-fab--peek");
        }, 3000);
    }, 1500);

    // Cancel the scheduled peek if the visitor already interacted with it.
    ["mouseenter", "focus", "click"].forEach(function (evt) {
        fab.addEventListener(evt, function () {
            window.clearTimeout(peekTimer);
        }, { once: true });
    });
})();
