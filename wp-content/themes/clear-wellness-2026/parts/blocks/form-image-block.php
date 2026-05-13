<?php
$formId = get_field('form_id');
$image = get_field('image');
$title = get_field('title');
$text = get_field('text');
$bid = blockId();
?>

<section class="container" aria-labelledby="<?= $bid; ?>-title">
    <div class="formImage">
        <div class="formImage__image">
            <?php echo wp_get_attachment_image($image, 'large'); ?>
        </div>
        <div class="formImage__content">
            <div class="flow">
                <?php if( $title ): ?>
                    <h2 class="t-trim t-h3" id="<?= $bid; ?>-title">
                        <?= esc_html($title); ?>
                    </h2>
                <?php endif; ?>
                <?php if( $text ): ?>
                    <div class="t-trim">
                        <?= $text; ?>
                    </div>
                <?php endif; ?>

                <?php if( $formId && function_exists('gravity_form') ): ?>
                    <div class="gravityform">
                        <?php gravity_form( $formId , false, false, false, false, true ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
