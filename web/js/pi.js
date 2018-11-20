$(function () {
    var $bigPlanetsContainer = $('#big-planets-container'),
        $miniPlanetsContainer = $('#mini-planets-container'),
        schemas = window.schemas;

    $(document).on('scroll', function () {
        if ($('.schema-row.active').length) {
            if ($(this).scrollTop() >= $bigPlanetsContainer.offset().top + $bigPlanetsContainer.height() - 250
                && $(this).scrollTop() <= $('#pi-chart-widget').offset().top - 300) {
                $miniPlanetsContainer.fadeIn(250);
            } else {
                $miniPlanetsContainer.fadeOut(250);
            }
        }
    });

    $('.schema-row').click(function () {
        if ($(this).is('.active')) {
            $(this).toggleClass('active');
            $('#mini-planets-container').fadeOut(250);
            return false;
        }

        $('#mini-planets-container').fadeIn(250);
        var $inputId = $(this).data('schema') == 'basic' ? $(this).data('input') : $(this).data('input').split(','),
            $outputId = $(this).data('output'),
            $name = $(this).data('name');
        $('.schema-row.active').removeClass('active');
        $(this).addClass('active');
        $('.planet-cell.active').removeClass('active');
        $('.planet-cell .commodities img.active').removeClass('active');
        $('#output-type img').attr('src', 'http://image.eveonline.com/Type/' + $outputId + '_32.png');
        $('#output-type span').text($name);
        switch ($(this).data('schema')) {
            case 'basic':
                exploreBase($inputId);
                break;
            case 'tier1':
                exploreTier1($inputId);
                break;
            case 'tier2':
                exploreTier2($inputId);
                break;
            default:
                exploreTier3($inputId);
                break;
        }
    });

    function exploreBase(inputId) {
        for (var planetType in schemas.planets) {
            if (schemas.planets.hasOwnProperty(planetType)) {
                var planet = schemas.planets[planetType];
                if (planet.indexOf(inputId) !== -1) {
                    $('.planet-cell[data-type="' + planetType + '"] img[data-type="' + inputId + '"]').addClass('active');
                    $('.planet-cell[data-type="' + planetType + '"]').addClass('active');
                }
            }
        }
    }

    function exploreTier1(inputIds) {
        for (var index in inputIds) {
            if (inputIds.hasOwnProperty(index)) {
                var $tierInputId = inputIds[index],
                    baseInputIds = schemas.base[$tierInputId];
                for (var index in baseInputIds) {
                    if (baseInputIds.hasOwnProperty(index)) {
                        exploreBase(baseInputIds[index]);
                    }
                }
            }
        }
    }

    function exploreTier2(inputIds) {
        for (var i=0; i<=inputIds.length-1; i++) {
            var tierId = inputIds[i];
            exploreTier1(schemas.tier1[tierId]);
        }
    }

    function exploreTier3(inputIds) {
        for (var i=0; i<=inputIds.length-1; i++) {
            var tierId = inputIds[i];
            if (schemas.tier2.hasOwnProperty(tierId)) {
                exploreTier2(schemas.tier2[tierId]);
            } else {
                exploreBase(schemas.tier2[tierId]);
            }
        }
    }

    $('.select-all').click(function () {
        $('#big-planets-container input[type=checkbox]').prop('checked', true);
        return false;
    });

    $('.select-none').click(function () {
        $('#big-planets-container input[type=checkbox]').prop('checked', false);
        return false;
    });

    $('[data-toggle="popover"]').popover({
        trigger: 'click hover'
    });

    $('.search-system').click(function () {
        var systemName = $('input[name=solarSystem]').val().trim();
        if (systemName) {
            $.ajax({
                url: '/pi/search-system',
                type: 'get',
                data: {
                    name: systemName
                },
                success: function (data) {
                    $('#solar-system-search-results').html(data);
                }
            });
        }
    });
});