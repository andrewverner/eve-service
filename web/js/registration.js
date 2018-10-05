$(function () {
    $('[data-toggle="popover"]').popover({
        trigger: 'hover'
    });

    $('.select-all-character').click(function () {
        $('input[type=checkbox].character-scope').prop('checked', true);
        return false;
    });
    $('.select-none-character').click(function () {
        $('input[type=checkbox].character-scope').prop('checked', false);
        return false;
    });

    $('.select-all-corp').click(function () {
        $('input[type=checkbox].corp-scope').prop('checked', true);
        return false;
    });
    $('.select-none-corp').click(function () {
        $('input[type=checkbox].corp-scope').prop('checked', false);
        return false;
    });
});
