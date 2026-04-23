<?php get_header(); ?>

<?php
while( have_posts() ): the_post();
    $post_id = get_the_ID();
    $cats    = get_the_category();
    $date    = get_the_date( 'F j, Y' );
    $lede    = get_field('lede');
?>

<div class="postHeader">
    <div class="container">
        <div class="postHeader__grid">
            <div class="postHeader__image">
                <?= get_the_post_thumbnail( null, 'large' ); ?>
            </div>
            <div class="postHeader__content">
                <div class="flow flow--24">
                    <div class="newsList__meta">
                        <?php if( $cats ): ?>
                            <span class="newsList__category"><?= esc_html( $cats[0]->name ); ?></span>
                            <span class="newsList__metaDot">&middot;</span>
                        <?php endif; ?>
                        <span><?= esc_html( $date ); ?></span>
                    </div>
                    <h1 class="t-h2 t-trim"><?= get_the_title(); ?></h1>
                    <?php if( $lede ): ?>
                        <p class="t-large t-trim"><?= esc_html( $lede ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="postContent">
    <div class="container container--816">
        <div class="wysiwyg t-large t-trim">
            <?= the_content(); ?>
        </div>
    </div>
</div>

<?php endwhile; ?>

<?php
$related = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'post__not_in'   => [ $post_id ],
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
?>

<?php if( $related->have_posts() ): ?>
    <div class="postRelated">
        <div class="container">
            <div class="flow flow--40">
                <h2 class="t-h3 t-trim">You Might Also Like</h2>
                <div class="newsList__grid">
                    <?php while( $related->have_posts() ): $related->the_post(); ?>
                        <?php get_template_part('parts/blocks/news/list-item'); ?>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
