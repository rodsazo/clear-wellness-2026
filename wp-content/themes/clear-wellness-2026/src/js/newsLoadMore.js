jQuery( function ($){
    const observer = new IntersectionObserver(
        function( entries ){
            entries.forEach( function( entry ){
                if( entry.isIntersecting ){
                    entry.target.classList.add('intersected');
                }
            });
        },
        { threshold: 0.25 }
    );

    $(document).on( 'click', '.js-newsLoadMore', function (){
        const $btn       = $(this);
        const page       = parseInt( $btn.data('page') ) + 1;
        const exclude    = $btn.data('exclude') || 0;
        const categories = $btn.data('categories') || '';
        const nonce      = $btn.data('nonce');
        const $grid      = $btn.closest('.newsList__list').find('.newsList__grid');

        $btn.prop( 'disabled', true ).text('Loading…');

        $.post( themeData.ajaxUrl, {
            action:     'news_load_more',
            page:       page,
            exclude:    exclude,
            categories: categories,
            nonce:      nonce,
        }, function( response ){
            if( ! response.success ) return;

            const $cards = $( response.data.html );
            $grid.append( $cards );

            $cards.filter('.intersect').each( function( i, el ){
                observer.observe( el );
            });

            $btn.data( 'page', page ).prop( 'disabled', false ).text('Load more');

            if( ! response.data.has_more ){
                $btn.closest('.newsList__loadMore').remove();
            }
        });
    });
});
