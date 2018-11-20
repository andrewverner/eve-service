$(function () {
    $('.pi-chart td.planet-type').click(function () {
        if ($(this).parent('tr').is('.active')) {
            $('.pi-chart img.active').toggleClass('active');
            $('.pi-chart tr.active').toggleClass('active');
            return false;
        }

        $('.pi-chart img.active').toggleClass('active');
        $('.pi-chart tr.active').toggleClass('active');
        $(this).parent('tr').addClass('active');
        var $commodities = $(this).data('commodities').split(',');
        for (var i=0; i<=$commodities.length-1; i++) {
            $('.pi-chart img[data-type=' + $commodities[i] + ']').addClass('active');
        }
    });

    $('.commodities-row img').click(function () {
        if ($(this).is('.active')) {
            $('.pi-chart img.active').toggleClass('active');
            $('.pi-chart tr.active').toggleClass('active');
            return false;
        }

        $('.pi-chart img.active').toggleClass('active');
        $('.pi-chart tr.active').toggleClass('active');
        $(this).addClass('active');
        var $commodity = $(this);
        $('.pi-chart .planet-row').each(function (index, row) {
            if ($(row).data('commodities').indexOf($commodity.data('type')) !== -1) {
                $(row).addClass('active');
            }
        });
    });

    $('.planetary-commodity').click(function () {
        var $node = $('.pi-chart .commodities-row img[data-type=' + $(this).data('type') + ']');
        if ($node.length) {
            $('.planetary-commodity.active').toggleClass('active');
            $('.planetary-commodity[data-type=' + $(this).data('type') + ']').toggleClass('active');
            $node.trigger('click');
        }
    });
});