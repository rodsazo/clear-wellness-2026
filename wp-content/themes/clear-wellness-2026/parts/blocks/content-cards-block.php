<?php
$columns = get_field('columns') ?: '3';
$cards = get_field('cards') ?: [];
?>

<section class="container">
    <div class="contentCards contentCards--cols-<?= esc_attr($columns); ?>">
        <?php foreach( $cards as $card ):
            $content = $card['content'];
            ?>
            <div class="contentCards__item | intersect fadeIn">
                <?php if( $content ): ?>
                    <div class="wysiwyg t-trim">
                        <?= $content; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
