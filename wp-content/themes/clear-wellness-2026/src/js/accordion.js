jQuery( function ($){
    $('.js-accordion-wrap').each(function(i, el){
        const $wrap = $(el);
        const $accordions = $wrap.find('.js-accordion');
        const $contents = $wrap.find('.js-accordion__content');

        $accordions.each(function(i, el){
            const $this = $(el);
            const $trigger = $this.find('.js-accordion__title');
            const $content = $this.find('.js-accordion__content');

            $trigger.on('click', function(){
                const isOpen = $this.hasClass('active');

                if( !isOpen ) {
                    $accordions.removeClass('active');
                    $accordions.find('.js-accordion__title').attr('aria-expanded', 'false');
                    $contents.slideUp();
                }

                $this.toggleClass('active');
                $trigger.attr('aria-expanded', $this.hasClass('active') ? 'true' : 'false');
                $content.stop().slideToggle();
            });
        });
    });
});