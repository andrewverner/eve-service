$(function () {
    var preloading;

    $(document).on('click', 'ul.character-menu a', function () {
        var $link = $(this);

        preloading = $.ajax({
            url: $link.data('preload-url'),
            type: 'get',
            success: function () {
                window.location.href = $link.attr('href')
            }
        });

        return false;
    });
});
