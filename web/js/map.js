$.fn.attachDragger = function(){
    var attachment = false, lastPosition, position, difference;
    $( $(this).selector ).on("mousedown mouseup mousemove",function(e){
        if( e.type == "mousedown" ) attachment = true, lastPosition = [e.clientX, e.clientY];
        if( e.type == "mouseup" ) attachment = false;
        if( e.type == "mousemove" && attachment == true ){
            position = [e.clientX, e.clientY];
            difference = [ (position[0]-lastPosition[0]), (position[1]-lastPosition[1]) ];
            $(this).scrollLeft( $(this).scrollLeft() - difference[0] );
            $(this).scrollTop( $(this).scrollTop() - difference[1] );
            lastPosition = [e.clientX, e.clientY];
        }
    });
    $(window).on("mouseup", function(){
        attachment = false;
    });
};

$(function () {
    var scale = 1;

    $("#map").attachDragger();

    $('#map').on('wheel', function (e) {
        e.preventDefault();
        var delta = e.delta || e.originalEvent.wheelDelta,
            scrollLeft = $('#map').scrollLeft(),
            scrollTop = $('#map').scrollTop();
        if (delta === undefined) {
            //we are on firefox
            delta = e.originalEvent.detail;
        }
        e.preventDefault();

        if (delta < 0) {
            // Zoom in
            scale /= 2;
        } else {
            // Zoom out
            scale *= 2;
        }

        $('#map svg').css({
            transform: 'scale(' + scale + ')'
        });
        $('#map').scrollTop(scrollTop);
        $('#map').scrollLeft(scrollLeft);
    });
});
