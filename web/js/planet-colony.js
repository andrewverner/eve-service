$(function () {
    $(document).on('click', '.colony-pin', function () {
        $('.colony-pin-data').hide();
        $($(this).data('target')).show();
    });
});
