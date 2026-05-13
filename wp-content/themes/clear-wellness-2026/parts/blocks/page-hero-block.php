<?php

$title = get_field('title');
$accent = get_field('accent');
$text = get_field('text');
$bid = blockId();
?>

<header class="container container--886 text-center" aria-labelledby="<?= $bid; ?>-title">
    <div class="flow">
        <h1 class="t-h1 t-trim" id="<?= $bid; ?>-title">
            <?= $title; ?>
            <?php if( $accent ): ?>
                <span class="t-accent"><?= $accent; ?></span>
            <?php endif; ?>
        </h1>

        <?php if( $text ): ?>
            <div class="t-large">
                <?= $text; ?>
            </div>
        <?php endif; ?>
    </div>
</header>
