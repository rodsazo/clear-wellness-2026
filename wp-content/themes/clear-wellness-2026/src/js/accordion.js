jQuery( function ($){
    $('.js-accordion').each(function(i,el){
        const $this = $(el);
        const $title = $this.find('.js-accordion__title');
        const $content = $this.find('.js-accordion__content');

        $title.on('click', function(){
            $this.toggleClass('active');
            $content.slideToggle();
        });
    });
});