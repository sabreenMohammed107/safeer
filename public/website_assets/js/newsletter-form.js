/**
 * Newsletter subscribe form — AJAX submission with Toast feedback.
 * Pairs with: public/website_assets/css/toast.css, .../js/toast.js
 * Server endpoint: POST /sendNewsLetter
 *   -> App\Http\Controllers\Website\ContentController::sendNewsLetter
 *      (returns {status: 'success'|'error', message: string} as JSON
 *      when the request is sent with the headers below)
 */
(function (window, document) {
    "use strict";

    document.addEventListener("DOMContentLoaded", function () {
        var form = document.getElementById("newsletter-form");
        if (!form || !window.fetch || !window.FormData) {
            // No JS fetch support: leave the form as a normal full-page POST.
            return;
        }

        var submitButton = form.querySelector('button[type="submit"]');

        function fallbackToRealSubmit() {
            form.removeEventListener("submit", handleSubmit);
            form.submit();
        }

        function handleSubmit(event) {
            event.preventDefault();

            if (submitButton) {
                submitButton.disabled = true;
            }

            fetch(form.getAttribute("action"), {
                method: "POST",
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: new FormData(form)
            })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data || {} };
                    });
                })
                .then(function (result) {
                    var message = result.data.message || "";

                    if (result.ok && result.data.status === "success") {
                        if (window.SaferToast) {
                            window.SaferToast.success(message);
                        }
                        form.reset();
                    } else if (window.SaferToast) {
                        window.SaferToast.error(message);
                    }
                })
                .catch(function () {
                    // Network failure: don't leave the user stuck, submit for real.
                    fallbackToRealSubmit();
                })
                .then(function () {
                    if (submitButton) {
                        submitButton.disabled = false;
                    }
                });
        }

        form.addEventListener("submit", handleSubmit);
    });
})(window, document);
