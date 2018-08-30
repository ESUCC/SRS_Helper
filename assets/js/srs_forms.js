$(document).on('show.bs.collapse', '.panel-collapse', function () {
    $(this).siblings('.panel-heading').addClass('active');
});

$(document).on('hide.bs.collapse', '.panel-collapse', function () {
    $(this).siblings('.panel-heading').removeClass('active');
});