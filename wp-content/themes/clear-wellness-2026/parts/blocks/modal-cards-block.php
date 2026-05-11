<?php
$items = get_field('items') ?: [];
$uid = uniqid();
?>

<section class="container">
    <div class="modalCards">
        <?php foreach( $items as $i => $item ):
            $image = $item['image'];
            $title = $item['title'];
            $slug = sanitize_title($title);
            ?>

        <a class="modalCards__item | intersect fadeIn" role="button" href="#modal-<?= $slug; ?>">
            <div class="modalCards__image">
                <?= wp_get_attachment_image( $image, 'medium_large'); ?>
            </div>
            <div class="modalCards__title">
                <?= $title; ?>
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="20" fill="#32602F"/>
                    <mask id="mask0_98_42" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="8" y="8" width="24" height="24">
                        <rect x="8" y="8" width="24" height="24" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_98_42)">
                        <path d="M19.2875 28.7125C19.0958 28.5208 19 28.2833 19 28V21H12C11.7167 21 11.4792 20.9042 11.2875 20.7125C11.0958 20.5208 11 20.2833 11 20C11 19.7167 11.0958 19.4792 11.2875 19.2875C11.4792 19.0958 11.7167 19 12 19H19V12C19 11.7167 19.0958 11.4792 19.2875 11.2875C19.4792 11.0958 19.7167 11 20 11C20.2833 11 20.5208 11.0958 20.7125 11.2875C20.9042 11.4792 21 11.7167 21 12V19H28C28.2833 19 28.5208 19.0958 28.7125 19.2875C28.9042 19.4792 29 19.7167 29 20C29 20.2833 28.9042 20.5208 28.7125 20.7125C28.5208 20.9042 28.2833 21 28 21H21V28C21 28.2833 20.9042 28.5208 20.7125 28.7125C20.5208 28.9042 20.2833 29 20 29C19.7167 29 19.4792 28.9042 19.2875 28.7125Z" fill="white"/>
                    </g>
                </svg>
            </div>
        </a>

        <?php endforeach; ?>
    </div>
</section>

<?php foreach( $items as $item ):
    $title = $item['title'];
    $slug   = sanitize_title( $title );
    $image = $item['image'];
    $text = $item['text'];

    ?>
    <div class="modal" id="modal-<?= $slug; ?>">
        <button class="modal__close">&times;</button>
        <div class="modal__content">
            <div class="modal__flex">
                <div class="modal__body">

                    <div class="modalDetail">
                        <div class="modalDetail__image">
                            <?= wp_get_attachment_image( $image, 'large' ); ?>
                        </div>
                        <div class="modalDetail__text">
                            <div class="flow flow--24">
                                <h3 class="t-h3 t-trim">
                                    <?= $title; ?>
                                </h3>
                                <div class="t-trim">
                                    <?= $text; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
