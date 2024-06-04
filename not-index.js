$(document).ready(function () {
    //used for developer and personal pages

    $('.fade-card.showcase').animate({ 'opacity': '1' }, 1500);

    /* Every time the window is scrolled ... */
    $(window).scroll(function () {

        /* Check the location of each desired element */
        $('.fade-card').each(function (i) {

            var top_of_object = $(this).position().top;
            var bottom_of_window = $(window).scrollTop() + $(window).height();

            /* If the top of an object is in the window, fade it it */
            if (bottom_of_window > top_of_object) {

                $(this).animate({ 'opacity': '1' }, 1500)
                // .promise.done(
                //     $(this).find(".fade-card-inside").delay(500).animate({ 'opacity': '1' }, 1500)
                // );

            }

        });

    });

});

