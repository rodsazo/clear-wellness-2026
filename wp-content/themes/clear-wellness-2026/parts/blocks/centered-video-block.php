<?php
$video_image   = get_field('video_image');
$video_iframe  = get_field('video_iframe');
$button_text   = get_field('button_text');
$videoId = uniqid();
?>

<div class="container">
    <div class="centeredVideo">
        <div class="centeredVideo__thumb">
            <?= wp_get_attachment_image( $video_image, 'large', false, ['alt' => ''] ); ?>
            <button class="centeredVideo__playBtn" aria-haspopup="dialog" data-modal="modal-<?= $videoId; ?>" aria-label="Play video">
                <span class="centeredVideo__playIcon"></span>
                <?php if( $button_text ): ?>
                    <span class="centeredVideo__label"><?= esc_html( $button_text ); ?></span>
                <?php endif; ?>
            </button>
        </div>
    </div>
</div>

<?php openModal( $videoId, 'Video modal', true); ?>
    <script type="text/html" class="modal__onOpen">
        <div class="modal__video">
            <?= $video_iframe; ?>
        </div>
    </script>
<?php closeModal(); ?>
