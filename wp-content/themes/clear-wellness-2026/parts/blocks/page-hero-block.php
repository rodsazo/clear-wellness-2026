<?php

$title = get_field('title');
$text = get_field('text');

?>

<div class="container container--886 text-center">
    <div class="flow">
        <h1 class="t-h1 t-trim"><?= $title; ?></h1>

        <?php if( $text ): ?>
            <div class="t-large">
                <?= $text; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
