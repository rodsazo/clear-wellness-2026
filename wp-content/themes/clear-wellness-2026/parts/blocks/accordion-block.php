<?php
$title = get_field('title');
$accordion = get_field('accordion') ?: [];
$blockId = blockId();

?>

<section class="container container--886" aria-labelledby="<?= $blockId; ?>-heading">
    <div class="flow">
        <?php if( $title ): ?>
        <h2 id="<?= $blockId; ?>-heading" class="t-h3 t-trim"><?= $title; ?></h2>
        <?php endif; ?>
        <?php the_accordion( $accordion, 't-h6' ); ?>
    </div>
</section>
