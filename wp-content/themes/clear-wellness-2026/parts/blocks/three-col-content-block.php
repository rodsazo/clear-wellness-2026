<?php
$content = get_field('content') ?: [];
?>

<div class="container">
    <ul class="threeCols">
        <?php foreach( $content as $item ):
            $image = $item['image'];
            $title = $item['title'];
            $subtitle = $item['subtitle'];
            $content = $item['text'];
            ?>
            <li class="threeCols__item">
                <?php if( $image ): ?>
                    <div class="threeCols__image">
                        <?= wp_get_attachment_image( $image, 'medium_large'); ?>
                    </div>
                <?php endif; ?>

                <div class="threeCols__content">
                    <div class="flow flow--24">
                        <?php if( $title ): ?>
                            <h3 class="t-h5 t-trim">
                                <?= esc_html($title); ?>
                            </h3>
                        <?php endif; ?>

                        <?php if( $subtitle ): ?>
                            <p class="t-h6 t-trim"><?= esc_html($subtitle); ?></p>
                        <?php endif; ?>

                        <?php if( $content ): ?>
                            <div class="t-trim">
                                <?= $content; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
