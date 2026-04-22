jQuery( function ($){
    const $menu = $('.stickyHeader');
    let scrolling = false;
    const min_scroll_sticky = 300;
    let sticky_threshold = 0;

    let previous_scroll = window.scrollY;

    const $globalBanner = $('.topBar');

    $(window).on('scroll', function(){
        if( !scrolling ) {
            scrolling = true;
            requestAnimationFrame( scroll );
        }
    });

    if ( $globalBanner.length ) {
        onResize();
        $(window).on('resize', onResize );
    }

    function scroll() {
        const current_scroll = window.scrollY;
        const scrolling_up = current_scroll - previous_scroll < 0;


        if( scrolling_up && current_scroll >= min_scroll_sticky ) {
            $menu.addClass('sticky in');
            if ($('body').hasClass('is-front')) {
                $menu.addClass('barmenu--font');
            }
        } else if( !scrolling_up && current_scroll >= min_scroll_sticky ) {
            $menu.removeClass('in');
            if ($('body').hasClass('is-front')) {
                $menu.removeClass('barmenu--font');
            }
        } else if( scrolling_up && current_scroll <= sticky_threshold) {
            $menu.removeClass('sticky');
            if ($('body').hasClass('is-front')) {
                $menu.removeClass('barmenu--font');
            }
        }

        previous_scroll = current_scroll;
        scrolling = false;
    }

    function onResize() {
        sticky_threshold = $globalBanner.outerHeight();
    }
});