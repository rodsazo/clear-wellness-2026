jQuery( function ($){
    const $modals = $('.modal');
    $modals.each(function(i,el){
        const $this = $(el);
        const id = $this.attr('id');
        const $buttons = $('a[href="#' + id + '"]');
        const $close = $this.find('.modal__close');
        const $body = $this.find('.modal__body');
        const $onOpen = $this.find('.modal__onOpen');

        $buttons.on('click', function (e){
            e.preventDefault();
            openModal();
        });

        $close.on('click', closeModal);
        $this.on('click', closeModal);

        $body.on('click', function (e){
            e.stopPropagation();
        });

        function openModal() {
            if( $onOpen.length ) {
                $body.html( $onOpen.html() );
            }
            $this.fadeIn();
            $('body').addClass('modal-is-open');
        }
        function closeModal() {
            $this.fadeOut(200, function(){
                if( $onOpen.length ) {
                    $body.html('');
                }
            });
            $('body').removeClass('modal-is-open');
        }
    });
});