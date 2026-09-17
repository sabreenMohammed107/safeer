$(function () {
    $(document).on('click', '.fav-toggle-btn', function (e) {
        e.preventDefault();

        var $btn = $(this);
        if ($btn.data('fav-loading')) {
            return;
        }

        var type = $btn.data('fav-type');
        var id = $btn.data('fav-id');
        var url = (window.FAV_URLS && window.FAV_URLS[type]) ? window.FAV_URLS[type].replace('__ID__', id) : null;

        if (!url) {
            return;
        }

        $btn.data('fav-loading', true);

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: url,
            method: 'POST',
            success: function (result) {
                var $icon = $btn.find('i.fa-heart');
                var favourited = !!result.favourited;
                $btn.toggleClass('is-fav', favourited);
                $icon.toggleClass('is-fav-icon', favourited);
                $icon.toggleClass('fa-solid', favourited);
                $icon.toggleClass('fa-regular', !favourited);
                $icon.addClass('fav-pulse');
                setTimeout(function () {
                    $icon.removeClass('fav-pulse');
                }, 300);
            },
            error: function (jqXHR) {
                if (jqXHR.status === 401 && jqXHR.responseJSON && jqXHR.responseJSON.redirect) {
                    window.location.href = jqXHR.responseJSON.redirect;
                } else {
                    console.log('favourite toggle failed', jqXHR.responseText);
                }
            },
            complete: function () {
                $btn.data('fav-loading', false);
            }
        });
    });
});
