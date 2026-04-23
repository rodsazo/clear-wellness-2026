jQuery( function ($){
    $('.js-accordion-wrap').each(function(i,el){
        const $wrap = $(el);
        const $accordions = $wrap.find('.js-accordion');
        const $contents = $wrap.find('.js-accordion__content');

        $accordions.each(function(i,el){
            const $this = $(el);
            const $title = $this.find('.js-accordion__title');
            const $content = $this.find('.js-accordion__content');

            $title.on('click', function(){

                if( !$this.hasClass('active') ) {
                    $accordions.removeClass('active');
                    $contents.slideUp();
                }

                $this.toggleClass('active');
                $content.stop().slideToggle();
            });
        });
    });
});