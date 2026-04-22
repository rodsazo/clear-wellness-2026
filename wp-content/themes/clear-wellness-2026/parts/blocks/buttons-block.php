<?php
$buttons = get_field('template_buttons') ?: [];
$centered = get_field('centered');
?>

<div class="container">
    <?php the_buttons($buttons,$centered); ?>
</div>


