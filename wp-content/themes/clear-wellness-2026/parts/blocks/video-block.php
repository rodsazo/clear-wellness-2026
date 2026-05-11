<?php

$videoIframe = get_field('video_iframe');
$videoImage = get_field('video_image');
$title = get_field('title');
$text = get_field('text');
$footnote = get_field('footnote');
$videoId = uniqid();
$bid = blockId();
?>

<section class="container" aria-labelledby="<?= $bid; ?>-title">
    <div class="videoBlock">
        <div class="videoBlock__video">
            <div class="flow flow--16">
                <div class="videoBlock__videoThumb">
                     <?= wp_get_attachment_image( $videoImage, 'large' ); ?>

                    <button aria-haspopup="dialog" aria-label="Play Video" class="videoBlock__playButton" data-modal="modal-<?= $videoId; ?>"></button>
                </div>
                <?php if( $footnote ): ?>
                    <div class="t-small t-trim">
                        <?= $footnote; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="videoBlock__content">
            <div class="flow flow--24">
                <h2 class="t-h3 t-trim" id="<?= $bid; ?>-title"><?= $title ?></h2>
                <p class="t-trim videoBlock__text"><?= $text ?></p>
            </div>
        </div>
    </div>
</section>

<?php openModal( $videoId, 'Video modal' ); ?>
<script type="text/html" class="modal__onOpen">
    <div class="modal__video">
        <?= $videoIframe; ?>
    </div>
</script>
<?php closeModal(); ?>