<?php
$featured_post       = get_field('featured_post');
$featured_post_title = get_field('featured_post_title');
$categories_title    = get_field('categories_title');
$filter_categories   = get_field('filter_categories') ?: [];

$exclude_ids = $featured_post ? [ $featured_post->ID ] : [];

$list_query_args = [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 12,
    'paged'          => 1,
    'post__not_in'   => $exclude_ids,
    'orderby'        => 'date',
    'order'          => 'DESC',
];

if( !empty( $filter_categories ) ) {
    $list_query_args['tax_query'] = [[
        'taxonomy' => 'category',
        'field'    => 'term_id',
        'terms'    => $filter_categories,
        'operator' => 'IN',
    ]];
}

$list_query = new WP_Query( $list_query_args );
$bid = blockId();
?>

<section class="container" aria-labelledby="<?= $bid; ?>-title">
    <div class="newsList">

        <?php if( $featured_post ): ?>
            <article class="newsList__featured">

                <?php if( $featured_post_title ): ?>
                    <h2 id="<?= $bid; ?>-title" class="t-h3 t-trim"><?= esc_html( $featured_post_title ); ?></h2>
                <?php endif; ?>

                <div class="newsList__featuredGrid">
                    <a class="newsList__featuredImage" href="<?= esc_url(get_permalink( $featured_post )); ?>">
                        <?= get_the_post_thumbnail( $featured_post, 'large' ); ?>
                    </a>

                    <div class="newsList__featuredContent">
                        <div class="flow flow--24">
                            <?php
                            $cats = get_the_category( $featured_post->ID );
                            $date = get_the_date( 'F j, Y', $featured_post );
                            ?>
                            <div class="newsList__meta">
                                <?php if( $cats ): ?>
                                    <span class="newsList__category"><?= esc_html( $cats[0]->name ); ?></span>
                                    <span class="newsList__metaDot">&middot;</span>
                                <?php endif; ?>
                                <time class="newsList__date" datetime="<?= esc_attr(get_the_date('Y-m-d', $featured_post)); ?>"><?= esc_html( $date ); ?></time>
                            </div>

                            <h3 class="t-h4 t-trim">
                                <a href="<?= esc_url(get_permalink( $featured_post )); ?>">
                                    <?= esc_html(get_the_title( $featured_post )); ?>
                                </a>
                            </h3>

                            <?php $lede = get_field( 'lede', $featured_post->ID ); ?>
                            <?php if( $lede ): ?>
                                <p class="t-trim"><?= esc_html(wp_strip_all_tags( $lede )); ?></p>
                            <?php endif; ?>

                            <div>
                                <a href="<?= esc_url(get_permalink( $featured_post )); ?>" class="btn">
                                    Read more
                                    <span class="sr-only">about <?= esc_html( get_the_title($featured_post) ); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        <?php endif; ?>

        <?php if( $list_query->have_posts() ): ?>
            <div class="newsList__list">

                <?php if( $categories_title ): ?>
                    <h2 class="t-h3 t-trim"><?= esc_html( $categories_title ); ?></h2>
                <?php endif; ?>

                <ul class="newsList__grid">
                    <?php while( $list_query->have_posts() ): $list_query->the_post(); ?>
                        <li>
                            <?php get_template_part( 'parts/blocks/news/list-item' ); ?>
                        </li>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>

                <?php if( $list_query->max_num_pages > 1 ): ?>
                    <div class="newsList__loadMore">
                        <button class="btn js-newsLoadMore"
                            data-page="1"
                            data-exclude="<?= $featured_post ? intval( $featured_post->ID ) : ''; ?>"
                            data-categories="<?= esc_attr( implode( ',', $filter_categories ) ); ?>"
                            data-nonce="<?= wp_create_nonce( 'news_load_more' ); ?>"
                        >Load more</button>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>

    </div>
</section>
