/**
 * Reusable Toast Notification system (safer.travel).
 * Pairs with: public/website_assets/css/toast.css
 *
 * Usage from any page/form script:
 *   SaferToast.success('Thank you for subscribing!');
 *   SaferToast.error('This email is already subscribed.');
 *   SaferToast.show('Custom message', 'success', { duration: 4000 });
 *
 * No dependencies (vanilla JS) so it works the same whether a page has
 * jQuery loaded or not.
 */
(function (window, document) {
    "use strict";

    var DEFAULT_DURATION = 3500;
    var container = null;

    function getContainer() {
        if (container && document.body.contains(container)) {
            return container;
        }
        container = document.getElementById("safer-toast-container");
        if (!container) {
            container = document.createElement("div");
            container.id = "safer-toast-container";
            container.setAttribute("aria-live", "polite");
            container.setAttribute("aria-atomic", "true");
            document.body.appendChild(container);
        }
        return container;
    }

    var ICONS = {
        success: '<svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>',
        error: '<svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>'
    };

    function dismiss(toast) {
        if (!toast || toast.dataset.dismissing === "1") {
            return;
        }
        toast.dataset.dismissing = "1";
        toast.classList.remove("is-visible");
        toast.classList.add("is-leaving");
        window.setTimeout(function () {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }

    function show(message, type, options) {
        type = type === "error" ? "error" : "success";
        options = options || {};
        var duration = typeof options.duration === "number" ? options.duration : DEFAULT_DURATION;

        var toast = document.createElement("div");
        toast.className = "safer-toast safer-toast--" + type;
        toast.setAttribute("role", type === "error" ? "alert" : "status");

        toast.innerHTML =
            '<span class="safer-toast__icon">' + ICONS[type] + '</span>' +
            '<span class="safer-toast__message"></span>' +
            '<button type="button" class="safer-toast__close" aria-label="Close">&times;</button>' +
            '<span class="safer-toast__progress" style="animation-duration:' + duration + 'ms"></span>';

        // Set text via textContent (not innerHTML) so messages can never inject markup.
        toast.querySelector(".safer-toast__message").textContent = message;

        toast.querySelector(".safer-toast__close").addEventListener("click", function () {
            window.clearTimeout(autoTimer);
            dismiss(toast);
        });

        getContainer().appendChild(toast);

        // Force layout so the entrance transition actually runs.
        window.requestAnimationFrame(function () {
            toast.classList.add("is-visible");
        });

        var autoTimer = window.setTimeout(function () {
            dismiss(toast);
        }, duration);

        return toast;
    }

    window.SaferToast = {
        show: show,
        success: function (message, options) {
            return show(message, "success", options);
        },
        error: function (message, options) {
            return show(message, "error", options);
        }
    };
})(window, document);
