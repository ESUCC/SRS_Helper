$(document).on('show.bs.collapse', '.panel-collapse', function (e) {
    if ($(this).is(e.target)) {
        $(this).siblings('.panel-heading').addClass('active');
    }
});

$(document).on('hide.bs.collapse', '.panel-collapse', function (e) {
    if ($(this).is(e.target)) {
        $(this).siblings('.panel-heading').removeClass('active');
    }    
});