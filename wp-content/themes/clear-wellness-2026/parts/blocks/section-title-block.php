<?php
$title = get_field('title');
$accent = get_field('accent');
$text = get_field('text');
$bid = blockId();
?>

<section class="container container--886" aria-labelledby="<?= $bid; ?>-title">
    <div class="flow">
        <h2 class="t-h2 t-trim text-center | intersect fadeIn" id="<?= $bid; ?>-title">
            <?= $title; ?>
            <?php if( $accent ): ?>
                <span class="t-accent"><?= $accent; ?></span>
            <?php endif; ?>
        </h2>
        <?php if( $text ): ?>
            <div class="t-trim text-center | intersect fadeIn">
                <?= $text; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
