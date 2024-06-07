$(document).ready(function () {
    //used for developer and personal pages
    if (windowWidth >= 500) {
        $('.fade-card.showcase').animate({ 'opacity': '1' }, 1500);
        console.log("loaded not index")
        /* Every time the window is scrolled ... */
        $(window).scroll(function () {
            console.log("Scrolled")
            /* Check the location of each desired element */
            $('.fade-card').each(function (i) {

                var top_of_object = $(this).position().top;
                var bottom_of_window = $(window).scrollTop() + $(window).height();

                /* If the top of an object is in the window, fade it it */
                if (bottom_of_window > top_of_object) {
                    console.log("Showing")
                    $(this).animate({ 'opacity': '1' }, 1500)
                    // .promise.done(
                    //     $(this).find(".fade-card-inside").delay(500).animate({ 'opacity': '1' }, 1500)
                    // );

                }

            });

        });
    }
});

