$(function () {
    $(document).on('click', '.bp-container', function () {
        $.ajax({
            url: '/eve/type',
            type: 'get',
            data: {
                typeId: $(this).data('type-id')
            },
            success: function (data) {

            }
        });
    });
});
