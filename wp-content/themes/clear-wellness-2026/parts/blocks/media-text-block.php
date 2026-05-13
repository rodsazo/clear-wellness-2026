<?php
$title = get_field('title');
$accent = get_field('accent');
$is_h1 = get_field('is_h1');
$title_font = get_field('title_font') ?: 't-h1';

$content = get_field('content');
$accordion = get_field('accordion') ?: [];
$buttons = get_field('template_buttons');
$eyebrow = get_field('eyebrow');

$image = get_field('image');
$image_position = get_field('image_position');
$image_aspect = get_field('image_aspect');

$text_class = $is_h1 ? 't-large' : '';

$bid = blockId();
?>

<section class="container" aria-labelledby="<?= $bid; ?>-title">
    <div class="mediaText mediaText--image-<?= esc_attr($image_position); ?> mediaText--aspect-<?= esc_attr($image_aspect); ?>">

        <div class="mediaText__image | intersect fadeIn">
            <?php if( $image ): ?>
                <?= wp_get_attachment_image( $image, 'large' ); ?>
            <?php endif; ?>
        </div>

        <div class="mediaText__content">
            <div class="flow">
                <?php if( $title || $eyebrow ): ?>
                <div class="flow flow--24">
                    <?php if( $eyebrow ): ?>
                        <p class="t-eyebrow t-trim"><?= esc_html($eyebrow); ?></p>
                    <?php endif; ?>

                    <?php if( $title ): ?>

                        <?php if( $is_h1 ): ?>
                            <h1 id="<?= $bid; ?>-title" class="<?= $title_font; ?> t-trim | intersect fadeIn">
                                <?= esc_html($title); ?>
                                <?php if( $accent ): ?>
                                    <span class="t-accent"><?= esc_html($accent); ?></span>
                                <?php endif; ?>
                            </h1>
                        <?php else: ?>
                            <h2 id="<?= $bid; ?>-title" class="<?= $title_font; ?> t-trim | intersect fadeIn">
                                <?= esc_html($title); ?>
                                <?php if( $accent ): ?>
                                    <span class="t-accent"><?= esc_html($accent); ?></span>
                                <?php endif; ?>
                            </h2>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
                <?php endif; ?>


                <?php if( $content ): ?>
                    <div class="t-trim wysiwyg <?= $text_class; ?> | intersect fadeIn">
                        <?= $content; ?>
                    </div>
                <?php endif; ?>

                <?php if( $accordion ): ?>
                    <?php the_accordion($accordion); ?>
                <?php endif; ?>

                <?php if( !empty($buttons) ): ?>
                    <div class="| intersect fadeIn">
                        <?php the_buttons($buttons); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>


</section>
