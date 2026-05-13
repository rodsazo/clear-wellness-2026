<?php
$team = get_field('team') ?: [];
$uid = uniqid();
?>

<div class="container">
    <div class="teamCards">
        <?php foreach( $team as $i => $member ):
            $image  = $member['picture'];
            $name   = $member['name'];
            $lastName = $member['last_name'];
            $role   = $member['role'];
            $modalId = 'modal-team-' . $uid . '-' . $i;
            ?>
            <button class="teamCards__item | intersect fadeIn" aria-haspopup="dialog" data-modal="<?= $modalId; ?>" aria-label="View bio for <?= esc_html( $name ); ?>">
                <span class="teamCards__image">
                    <?= wp_get_attachment_image( $image, 'medium_large' ); ?>
                    <span class="teamCards__plus">
                        <svg aria-hidden="true" focusable="false" width="32" height="32" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="40" height="40" rx="20" fill="#32602F"/>
                            <path d="M19.2875 28.7125C19.0958 28.5208 19 28.2833 19 28V21H12C11.7167 21 11.4792 20.9042 11.2875 20.7125C11.0958 20.5208 11 20.2833 11 20C11 19.7167 11.0958 19.4792 11.2875 19.2875C11.4792 19.0958 11.7167 19 12 19H19V12C19 11.7167 19.0958 11.4792 19.2875 11.2875C19.4792 11.0958 19.7167 11 20 11C20.2833 11 20.5208 11.0958 20.7125 11.2875C20.9042 11.4792 21 11.7167 21 12V19H28C28.2833 19 28.5208 19.0958 28.7125 19.2875C28.9042 19.4792 29 19.7167 29 20C29 20.2833 28.9042 20.5208 28.7125 20.7125C28.5208 20.9042 28.2833 21 28 21H21V28C21 28.2833 20.9042 28.5208 20.7125 28.7125C20.5208 28.9042 20.2833 29 20 29C19.7167 29 19.4792 28.9042 19.2875 28.7125Z" fill="white"/>
                        </svg>
                    </span>
                </span>
                <span class="teamCards__info">
                    <span class="teamCards__name">
                        <?= esc_html( $name ); ?>
                        <?php if( $lastName ): ?>
                            <span class="t-accent">
                                <?= esc_html($lastName); ?>
                            </span>
                        <?php endif; ?>
                    </span>
                    <span class="teamCards__role"><?= esc_html( $role ); ?></span>
                </span>
            </button>
        <?php endforeach; ?>
    </div>
</div>

<?php foreach( $team as $i => $member ):
    $image   = $member['picture'];
    $name    = $member['name'];
    $role    = $member['role'];
    $bio     = $member['bio'];
    $modalId = 'team-' . $uid . '-' . $i;
    ?>
    <?php openModal( $modalId, $name ); ?>
        <div class="modalDetail">
            <div class="modalDetail__image modalDetail__image--vertical">
                <?= wp_get_attachment_image( $image, 'large' ); ?>
            </div>
            <div class="modalDetail__text">
                <div class="flow flow--32">
                    <div class="flow flow--16">
                        <h3 class="t-h4 t-trim"><?= esc_html( $name ); ?></h3>
                        <?php if( $role ): ?>
                            <p class="t-h6 t-trim"><?= esc_html( $role ); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if( $bio ): ?>
                        <div class="wysiwyg t-trim"><?= $bio; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php closeModal(); ?>
<?php endforeach; ?>
