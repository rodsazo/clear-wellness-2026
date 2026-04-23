<div class="newsList__card | intersect fadeIn">
    <a class="newsList__cardImage" href="<?= get_permalink(); ?>">
        <?= get_the_post_thumbnail( null, 'medium_large' ); ?>
    </a>

    <?php
    $cats = get_the_category();
    $date = get_the_date( 'F j, Y' );
    ?>
    <div class="newsList__meta">
        <?php if( $cats ): ?>
            <span class="newsList__category"><?= esc_html( $cats[0]->name ); ?></span>
            <span class="newsList__metaDot">&middot;</span>
        <?php endif; ?>
        <span><?= esc_html( $date ); ?></span>
    </div>

    <h3 class="t-h6 t-trim">
        <a href="<?= get_permalink(); ?>"><?= get_the_title(); ?></a>
    </h3>
</div>