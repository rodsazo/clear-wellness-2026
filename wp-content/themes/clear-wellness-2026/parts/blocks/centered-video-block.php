<?php
$video_image   = get_field('video_image');
$video_iframe  = get_field('video_iframe');
$button_text   = get_field('button_text');
$videoId = uniqid();
?>

<section class="container">
    <div class="centeredVideo">
        <div class="centeredVideo__thumb">
            <?= wp_get_attachment_image( $video_image, 'large' ); ?>
            <a class="centeredVideo__playBtn" href="#modal-<?= $videoId; ?>" aria-label="Play video">
                <span class="centeredVideo__playIcon"></span>
                <?php if( $button_text ): ?>
                    <span class="centeredVideo__label"><?= esc_html( $button_text ); ?></span>
                <?php endif; ?>
            </a>
        </div>
    </div>
</section>

<div class="modal" id="modal-<?= $videoId; ?>">
    <button class="modal__close">&times;</button>
    <div class="modal__content">
        <div class="modal__flex">
            <div class="modal__body"></div>
        </div>
    </div>
    <script type="text/html" class="modal__onOpen">
        <div class="modal__video">
            <?= $video_iframe; ?>
        </div>
    </script>
</div>
