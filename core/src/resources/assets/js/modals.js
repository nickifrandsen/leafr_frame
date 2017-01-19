(function() {

    $('.modal-button').on('click', function(e) {

        e.preventDefault();

        var modal = $('#' + $(this).data('target'));

        if(modal.is('.is-active')) {

            modal.removeClass('is-active');
            $('html').removeClass('is-clipped');

        } else {

            modal.addClass('is-active');
            $('html').addClass('is-clipped');

        }

    });

    $('.modal-close').on('click', function(e) {
        e.preventDefault();

        $('.modal').removeClass('is-active');
        $('html').removeClass('is-clipped');
    })

})();


$(document).mouseup(function (e) {
    var modal = $('.modal-content');

    if (!modal.is(e.target) // if the target of the click isn't the container...
        && modal.has(e.target).length === 0) // ... nor a descendant of the container
    {
        modal.parent('.modal').removeClass('is-active');
        $('html').removeClass('is-clipped');
    }
});
