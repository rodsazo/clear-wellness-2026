<?php
$title = get_field('title');
$accent = get_field('accent');
$text = get_field('text');

?>

<div class="container container--886">
    <div class="flow">
        <h2 class="t-h2 t-trim text-center">
            <?= $title; ?>
            <?php if( $accent ): ?>
                <span class="t-accent"><?= $accent; ?></span>
            <?php endif; ?>
        </h2>
        <?php if( $text ): ?>
            <div class="t-trim text-center">
                <?= $text; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
