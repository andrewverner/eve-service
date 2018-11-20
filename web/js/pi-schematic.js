$(function () {
    new Treant(window.chartConfig, function () {
        $('[data-toggle="popover"]').popover({
            trigger: 'click hover'
        });
    }, $);
});