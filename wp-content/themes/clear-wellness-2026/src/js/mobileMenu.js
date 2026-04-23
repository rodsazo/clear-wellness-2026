jQuery( function ($){
    const $btn  = $('.siteHeader__mobBtn');
    const $menu = $('.siteHeader__mobMenu');
    const $body = $('body');

    $btn.on('click', function (){
        const isOpen = $btn.hasClass('is-open');

        if( isOpen ){
            close();
        } else {
            open();
        }
    });

    // Close on any link click inside the mobile menu
    $menu.on('click', 'a', function (){
        close();
    });

    function open(){
        $btn.addClass('is-open').attr('aria-expanded', 'true');
        $menu.addClass('is-open').attr('aria-hidden', 'false');
        $body.css('overflow', 'hidden');
    }

    function close(){
        $btn.removeClass('is-open').attr('aria-expanded', 'false');
        $menu.removeClass('is-open').attr('aria-hidden', 'true');
        $body.css('overflow', '');
    }
});
