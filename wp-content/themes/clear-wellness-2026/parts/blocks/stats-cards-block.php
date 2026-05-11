<?php
$cards = get_field('cards') ?: [];
$footnote = get_field('footnote');
?>

<section class="container">
    <dl class="statsCards">
        <?php foreach( $cards as $card ):
            $title = $card['title'];
            $prefix = $card['prefix'];
            $number = $card['number'];
            $suffix = $card['suffix'];
            $text = $card['text'];
            ?>

            <div class="statsCards__item | intersect fadeIn">
                <dd class="t-h2 t-trim">
                    <?php echo $prefix; ?><span aria-live="polite" class="statsCards__numberIncrement"><?php echo $number; ?></span><?php echo $suffix; ?>
                </dd>
                <dt class="statsCards__title t-trim">
                    <?php echo $title; ?>
                </dt>
                <?php if( $text ): ?>
                    <div class="statsCards__text t-trim">
                        <?php echo $text; ?>
                    </div>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    </dl>

    <?php if( $footnote ): ?>
        <div class="statsCards__footnote t-trim">
            <?= $footnote; ?>
        </div>
    <?php endif; ?>
</section>
