<?php
$items = get_field('items') ?: [];
?>

<section class="container">
    <div class="testimonials | intersect fadeIn">
        <div class="testimonials__slider">
            <?php foreach( $items as $item ):
                $quote = $item['quote'];
                $author = $item['author'];
                $role = $item['role'];
                $pic = $item['author_pic'] ?? false;
                $picClass = $pic ? 'testimonials__authorBlock--has-picture' : '';
                ?>
                <div class="testimonials__slide">
                    <div class="flow centered">
                        <div class="testimonials__quoteMark">
                            <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.57143 21.7714L2.74286 24C1.77143 22.5143 1.05714 21 0.6 19.4571C0.2 17.9143 0 16.3714 0 14.8286C0 12.0857 0.685714 9.45714 2.05714 6.94286C3.48571 4.42857 5.48571 2.11429 8.05714 0L11.0571 1.8C11.5143 2.2 11.7429 2.6 11.7429 3C11.7429 3.51429 11.5714 3.94286 11.2286 4.28572C10.3714 5.31429 9.57143 6.51429 8.82857 7.88572C8.08572 9.25714 7.71429 10.8 7.71429 12.5143C7.71429 13.4286 7.85714 14.4286 8.14286 15.5143C8.42857 16.5429 8.94286 17.6571 9.68571 18.8571C9.8 19.0286 9.88571 19.2286 9.94286 19.4571C10 19.6286 10.0286 19.8 10.0286 19.9714C10.0286 20.8286 9.54286 21.4286 8.57143 21.7714ZM22.4571 21.7714L16.5429 24C15.6286 22.5143 14.9429 21 14.4857 19.4571C14.0286 17.9143 13.8 16.3714 13.8 14.8286C13.8 12.0857 14.4857 9.45714 15.8571 6.94286C17.2857 4.42857 19.2857 2.11429 21.8571 0L24.8571 1.8C25.3714 2.2 25.6286 2.6 25.6286 3C25.6286 3.51429 25.4571 3.94286 25.1143 4.28572C24.2571 5.31429 23.4571 6.51429 22.7143 7.88572C21.9714 9.25714 21.6 10.8 21.6 12.5143C21.6 13.4286 21.7429 14.4286 22.0286 15.5143C22.3143 16.5429 22.8286 17.6571 23.5714 18.8571C23.6857 19.0286 23.7714 19.2286 23.8286 19.4571C23.8857 19.6286 23.9143 19.8 23.9143 19.9714C23.9143 20.8286 23.4286 21.4286 22.4571 21.7714Z" fill="#78BA73"/>
                            </svg>
                        </div>
                        <div class="testimonials__quote t-trim">
                            <?= $quote; ?>
                        </div>
                        <div class="testimonials__authorBlock <?= $picClass; ?>">

                            <?php if( $pic ): ?>
                                <div class="testimonials__authorPic">
                                    <?= wp_get_attachment_image( $pic, 'medium' ); ?>
                                </div>
                            <?php endif; ?>

                            <div class="flow flow--<?= $pic ? '8' : '16'; ?>">
                                <div class="testimonials__author t-trim">
                                    <?= $author; ?>
                                </div>
                                <div class="testimonials__role t-trim">
                                    <?= $role; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if( count($items) > 1 ): ?>

            <div class="testimonials__controls">
                <button class="testimonials__control testimonials__control--prev" aria-label="Previous">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" stroke="#32602F"/>
                        <mask id="mask0_95_133" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="12" y="12" width="24" height="24">
                            <rect x="12" y="12" width="24" height="24" fill="#D9D9D9"/>
                        </mask>
                        <g mask="url(#mask0_95_133)">
                            <path d="M22.8 24L26.7 27.9C26.8833 28.0834 26.975 28.3167 26.975 28.6C26.975 28.8834 26.8833 29.1167 26.7 29.3C26.5167 29.4834 26.2833 29.575 26 29.575C25.7167 29.575 25.4833 29.4834 25.3 29.3L20.7 24.7C20.6 24.6 20.5292 24.4917 20.4875 24.375C20.4458 24.2584 20.425 24.1334 20.425 24C20.425 23.8667 20.4458 23.7417 20.4875 23.625C20.5292 23.5084 20.6 23.4 20.7 23.3L25.3 18.7C25.4833 18.5167 25.7167 18.425 26 18.425C26.2833 18.425 26.5167 18.5167 26.7 18.7C26.8833 18.8834 26.975 19.1167 26.975 19.4C26.975 19.6834 26.8833 19.9167 26.7 20.1L22.8 24Z" fill="#32602F"/>
                        </g>
                    </svg>
                </button>

                <button class="testimonials__control testimonials__control--next" aria-label="Next">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" stroke="#32602F"/>
                        <mask id="mask0_95_147" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="12" y="12" width="24" height="24">
                            <rect x="12" y="12" width="24" height="24" fill="#D9D9D9"/>
                        </mask>
                        <g mask="url(#mask0_95_147)">
                            <path d="M24.6 24L20.7 20.1C20.5167 19.9167 20.425 19.6834 20.425 19.4C20.425 19.1167 20.5167 18.8834 20.7 18.7C20.8834 18.5167 21.1167 18.425 21.4 18.425C21.6834 18.425 21.9167 18.5167 22.1 18.7L26.7 23.3C26.8 23.4 26.8709 23.5084 26.9125 23.625C26.9542 23.7417 26.975 23.8667 26.975 24C26.975 24.1334 26.9542 24.2584 26.9125 24.375C26.8709 24.4917 26.8 24.6 26.7 24.7L22.1 29.3C21.9167 29.4834 21.6834 29.575 21.4 29.575C21.1167 29.575 20.8834 29.4834 20.7 29.3C20.5167 29.1167 20.425 28.8834 20.425 28.6C20.425 28.3167 20.5167 28.0834 20.7 27.9L24.6 24Z" fill="#32602F"/>
                        </g>
                    </svg>

                </button>
            </div>
        <?php endif; ?>
    </div>
</section>
