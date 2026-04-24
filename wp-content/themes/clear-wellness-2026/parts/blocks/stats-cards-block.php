<?php
$cards = get_field('cards') ?: [];
$footnote = get_field('footnote');
?>

<div class="container">
    <div class="statsCards">
        <?php foreach( $cards as $card ):
            $title = $card['title'];
            $prefix = $card['prefix'];
            $number = $card['number'];
            $suffix = $card['suffix'];
            $text = $card['text'];
            ?>

            <div class="statsCards__item | intersect fadeIn">
                <div class="t-h2 t-trim">
                    <?php echo $prefix; ?><span class="statsCards__numberIncrement"><?php echo $number; ?></span><?php echo $suffix; ?>
                </div>
                <div class="statsCards__title t-trim">
                    <?php echo $title; ?>
                </div>
                <?php if( $text ): ?>
                    <div class="statsCards__text t-trim">
                        <?php echo $text; ?>
                    </div>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    </div>

    <?php if( $footnote ): ?>
        <div class="statsCards__footnote t-trim">
            <?= $footnote; ?>
        </div>
    <?php endif; ?>
</div>
