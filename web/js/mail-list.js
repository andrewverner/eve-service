$(function () {
    var $progress = false;

    $(document).on('click', '.mail-list-record', function () {
        if ($progress) {
            return false;
        }

        var $row = $(this);
        if ($row.is('.active')) {
            return false;
        }

        $('.mail-list-record').removeClass('active');
        $('.mail-body-container').slideUp(250);
        $row.addClass('active');
        $progress = true;
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
            complete: function () {
                $progress = false;
            }
        });
    });

    $('.load-more').click(function () {
        if ($(this).is('.in-progress')) {
            return false;
        }

        var $lastId = $('.mail-list-record:last-child').data('mail-id'),
            $btn = $(this);

        $btn.addClass('in-progress');
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
            complete: function () {
                $btn.removeClass('in-progress');
            }
        });
    });

    $(document).on('click', '.drop-mail', function () {
        var $btn = $(this);
        $.ajax({
            url: '/character/' + $btn.data('character-id') + '/mail/' + $btn.data('mail-id'),
            type: 'delete',
            success: function () {
                $('.mail-body-container').slideUp(250, function () {
                    $('.mail-list-record.active').remove();
                    $('.mail-body-container').remove();
                });
            },
            error: function () {

            }
        });
    });
});
