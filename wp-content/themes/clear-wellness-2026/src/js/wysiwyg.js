jQuery( function ($){
    $('.wysiwyg ol').each(function(i,el){
        const $this = $(el);
        if( $this.attr('start') ) {
            $this.attr('style', '--start:' + $this.attr('start') + ' !important');
        }
    })
});