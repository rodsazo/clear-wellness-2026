jQuery(function ($){
    $('.testimonials').each(function(i,el){

        const $this = $(el);
        const $sliderSubContent = $this.find('.testimonials__slider');
        const $slides = $this.find('.testimonials__slide');
        if ($slides.length <= 1) {
            return;
        }
        const $angleBrackets = $this.find('.testimonials__control');
        const $back = $angleBrackets.eq(0);
        const $next = $angleBrackets.eq(1);
        let currentIndex = 0;
        resizeContainer( true );
        $next.on('click',next);
        $back.on('click',back);

        // let interval = setInterval(next, 8000);

        $(window).on('resize', function(){resizeContainer( false )});
        $(window).on('load', function(){resizeContainer( true )});
        $sliderSubContent.addClass('active');
        function resizeContainer(){
            $sliderSubContent.height( $slides.eq( currentIndex ).outerHeight());
        }

        function goto(index){
            $slides.eq(currentIndex).fadeOut();
            $slides.eq(index).fadeIn();
            currentIndex = index;
            resizeContainer();
            clearInterval(interval);
            interval = setInterval(next, 8000);
        }

        function next(){
            const index = (currentIndex + 1)%$slides.length;
            goto(index);
        }
        function back(){
            const index = (currentIndex - 1+$slides.length)%$slides.length;
            goto(index);
        }
    })
});