<?php
$title = get_field('title');
$accent = get_field('accent');
$is_h1 = get_field('is_h1');

$content = get_field('content');
$accordion = get_field('accordion') ?: [];
$buttons = get_field('template_buttons');

$image = get_field('image');
$image_position = get_field('image_position');

$text_class = $is_h1 ? 't-large' : '';

?>

<div class="container">
    <div class="mediaText mediaText--image-<?= $image_position; ?>">

        <div class="mediaText__image | intersect fadeIn">
            <?php if( $image ): ?>
                <?= wp_get_attachment_image( $image, 'large' ); ?>
            <?php endif; ?>
        </div>

        <div class="mediaText__content">
            <div class="flow">
                <?php if( $title ): ?>

                    <?php if( $is_h1 ): ?>
                        <h1 class="t-h1 t-trim | intersect fadeIn">
                            <?= $title; ?>
                            <?php if( $accent ): ?>
                                <div class="t-accent"><?= $accent; ?></div>
                            <?php endif; ?>
                        </h1>
                    <?php else: ?>
                        <h2 class="t-h1 t-trim | intersect fadeIn">
                            <?= $title; ?>
                            <?php if( $accent ): ?>
                                <div class="t-accent"><?= $accent; ?></div>
                            <?php endif; ?>
                        </h2>
                    <?php endif; ?>
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


</div>
