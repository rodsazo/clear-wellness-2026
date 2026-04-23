<?php
$title = get_field('title');
$accordion = get_field('items') ?: [];

?>

<div class="container container--886">
    <div class="flow">
        <?php if( $title ): ?>
        <h2 class="t-h3 t-trim"><?= $title; ?></h2>
        <?php endif; ?>
        <?php the_accordion( $accordion ); ?>
    </div>
</div>
