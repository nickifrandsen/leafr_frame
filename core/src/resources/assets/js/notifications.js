(function() {

    $('.notification .close').on('click', function(e) {

        e.preventDefault();
        $(this).parent('.notification').slideUp(1000, function() {
            $(this).remove();
        });

    });

})();
