<?php
$formId = get_field('form_id');
?>

<div class="container container--886">
    <div class="formBlock">
        <?php if( $formId && function_exists('gravity_form') ): ?>
            <div class="gravityform">
                <?php gravity_form( $formId , false, false, false, false, true ); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
