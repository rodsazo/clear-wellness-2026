<?php
$columns = get_field('columns') ?: '3';
$cards = get_field('cards') ?: [];
?>

<div class="container">
    <ul class="contentCards contentCards--cols-<?= esc_attr($columns); ?>">
        <?php foreach( $cards as $card ):
            $content = $card['content'];
            ?>
            <li class="contentCards__item | intersect fadeIn">
                <?php if( $content ): ?>
                    <div class="wysiwyg t-trim">
                        <?= $content; ?>
                    </div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
