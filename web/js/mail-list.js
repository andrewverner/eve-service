$(function () {
    $(document).on('click', '.mail-list-record', function () {
        var $row = $(this);
        if ($row.is('active')) {
            return false;
        }

        $('.mail-list-record').removeClass('active');
        $('.mail-body-container').slideUp(250);
        $(this).addClass('active');
        $.ajax({
            url: '/character/mail-body',
            type: 'get',
            data: {
                mailId: $(this).data('mail-id'),
                characterId: $(this).data('character')
            },
            success: function (data) {
                var $container = $('<div>').addClass('mail-body-container').html(data.data).slideDown(250);
                $row.after($container);
            },
            error: function (data) {

            },
        });
    });

    $('.load-more').click(function () {
        var $lastId = $('.mail-list-record:last-child').data('mail-id'),
            $btn = $(this);
        $.ajax({
            url: '/character/' + $(this).data('character-id') + '/mail-list',
            type: 'get',
            data: {
                lastId: $lastId,
            },
            success: function (data) {
                if (parseInt(data.count) >= 1) {
                    $('.mails-list').append(data.data);
                    if (data.count < 50) {
                        $btn.remove();
                    }
                } else {
                    $btn.remove();
                }
            },
            error: function (data) {

            },
        });
    });
});
