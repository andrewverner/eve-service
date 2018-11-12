$(function () {
    var timer,
        recorder = function () {
            $.ajax({
                url: '/character/' + window.characterId + '/record-route',
                type: 'post',
                data: {
                    stations: $('#record-stations').prop('checked'),
                    wormholes: $('#record-wormholes').prop('checked'),
                    ship: $('#record-ship').prop('checked')
                },
                success: function (data) {
                    $('.record-container').html(data.data);
                    if (parseInt(data.rows) > 0) {
                        if ($('#save-route').is('.hidden')) {
                            $('#save-route').toggleClass('hidden');
                        }
                        if ($('#clear-route').is('.hidden')) {
                            $('#clear-route').toggleClass('hidden');
                        }
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        };

    $('#start-recording').click(function () {
        recorder();
        timer = setInterval(recorder, 10000);
        $(this).hide();
        $('#stop-recording').show();
    });

    $('#stop-recording').click(function () {
        clearInterval(timer);
        $(this).hide();
        $('#start-recording').show();
    });

    $(document).on('click', '.drop-route-row', function () {
        var $btn = $(this);
        $.ajax({
            url: '/character/' + window.characterId + '/drop-route-record',
            type: 'post',
            data: {
                index: $btn.data('id')
            },
            success: function () {
                $btn.closest('tr').fadeOut(500);
            }
        });
    });

    $('#save-route').click(function () {
        $('#save-route-modal').modal('show');
    });

    $('#confirm-save-route').click(function () {
        $.ajax({
            url: '/character/' + window.characterId + '/save-route',
            type: 'post',
            data: {
                name: $('#route-name').val(),
                clear: $('#clear-after-save').prop('checked')
            },
            success: function (data) {
                $('.record-container').html(data.data);
                if (parseInt(data.rows) === 0) {
                    $('#save-route').hide();
                    $('#clear-route').hide();
                }
            }
        });
    });

    $('#clear-route').click(function () {
        $.ajax({
            url: '/character/' + window.characterId + '/clear-route',
            type: 'post',
            success: function () {
                $('.record-container').html('');
                $('#save-route').hide();
                $('#clear-route').hide();
            }
        });
    });

    $('#set-route').click(function () {
        $.ajax({
            url: '/character/' + window.characterId + '/set-route',
            type: 'post',
            data: {
                route: $(this).data('id'),
                reverse: $('#reverse-route').prop('checked') ? 1 : 0,
                startEnd: $('#start-end').prop('checked') ? 1 : 0,
                skipStations: $('#skip-stations').prop('checked') ? 1 : 0,
                fromCurrentLocation: $('#from-current-location').prop('checked') ? 1 : 0,
                clearWaypoints: $('#clear-waypoints').prop('checked') ? 1 : 0,
            }
        });
    });

    $('#share-route').click(function () {
        $('#share-route-modal').modal('show');
    });

    $('#share-route-by-link').click(function () {
        var $box = $(this);
        $.ajax({
            url: '/character/' + window.characterId + '/share-route',
            type: 'post',
            data: {
                share: $box.prop('checked') ? 1 : 0,
                route: $box.data('id')
            },
            success: function () {
                $('#route-share-hash').toggleClass('hidden');
            }
        });
    });
});
