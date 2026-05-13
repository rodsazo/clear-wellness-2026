<article class="newsList__card | intersect fadeIn">
    <a class="newsList__cardImage" href="<?= esc_url(get_permalink()); ?>">
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
        <time datetime="<?= esc_attr(get_the_date('Y-m-d')); ?>"><?= esc_html( $date ); ?></time>
    </div>

    <h3 class="t-h6 t-trim">
        <a href="<?= esc_url(get_permalink()); ?>"><?= esc_html(get_the_title()); ?></a>
    </h3>
</article>