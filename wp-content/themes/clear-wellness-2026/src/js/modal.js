jQuery( function ($){
    const FOCUSABLE = 'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])';

    const $modals = $('.modal');
    $modals.each(function(i, el){
        const $modal = $(el);
        const id = $modal.attr('id');
        const $triggers = $('[href="#' + id + '"], [data-modal="' + id + '"]');
        const $close = $modal.find('.modal__close');
        const $body = $modal.find('.modal__body');
        const $onOpen = $modal.find('.modal__onOpen');

        let $lastFocus = null;

        $triggers.on('click', function (e){
            e.preventDefault();
            openModal( $(this) );
        });

        $close.on('click', closeModal);

        $modal.on('click', function (e){
            if( !$(e.target).closest('.modal__content').length ) {
                closeModal();
            }
        });

        $modal.on('keydown', function (e){
            if( e.key === 'Escape' ) {
                closeModal();
                return;
            }
            if( e.key === 'Tab' ) {
                trapFocus(e);
            }
        });

        function trapFocus(e) {
            const $focusable = $modal.find(FOCUSABLE).filter(':visible');
            const first = $focusable[0];
            const last  = $focusable[$focusable.length - 1];
            if( e.shiftKey ) {
                if( document.activeElement === first ) {
                    e.preventDefault();
                    last.focus();
                }
            } else {
                if( document.activeElement === last ) {
                    e.preventDefault();
                    first.focus();
                }
            }
        }

        function openModal($trigger) {
            if( $onOpen.length ) {
                $body.html( $onOpen.html() );
            }
            $lastFocus = $trigger || null;
            $modal.fadeIn(200, function(){
                $modal.removeAttr('aria-hidden');
                const $first = $modal.find(FOCUSABLE).filter(':visible').first();
                if( $first.length ) {
                    $first.trigger('focus');
                } else {
                    $modal.attr('tabindex', '-1').trigger('focus');
                }
            });
            $('body').addClass('modal-is-open');
        }

        function closeModal() {
            $modal.attr('aria-hidden', 'true');
            $modal.fadeOut(200, function(){
                if( $onOpen.length ) {
                    $body.html('');
                }
            });
            $('body').removeClass('modal-is-open');
            if( $lastFocus ) {
                $lastFocus.trigger('focus');
                $lastFocus = null;
            }
        }
    });
});