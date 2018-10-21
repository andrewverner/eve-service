$(function () {
    $('#asset-search').keyup(function () {
        var query = $(this).val().toLowerCase();
        if (query.length >= 3) {
            $('.asset-row').each(function (index, $row) {
                if ($($row).data('item').toLowerCase().indexOf(query) === -1) {
                    $($row).hide();
                }
            });
        } else {
            $('.asset-row').show();
        }
    });
});
