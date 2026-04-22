<?php

use App\Theme\ThemePostTypes;

require_once 'common.php';
require_once 'vendor/autoload.php';
require_once 'setup.php';

function getPostDateString( $post ) {
    $date_string = '';
    switch( $post->post_type ) {
        case ThemePostTypes::BLOG:
        case ThemePostTypes::PODCAST:
            $date_string = mysql2date('M j, Y', $post->post_date);
            break;
        case ThemePostTypes::EVENT:
            $firstStartDate = get_field('event_start_date',$post->ID);
            $firstEndDate = get_field('event_end_date',$post->ID);
            $firstStartTime = get_field('event_start_time',$post->ID);
            $firstEndTime = get_field('event_end_time',$post->ID);
            $date_string = format_date_range($firstStartDate,$firstEndDate,$firstStartTime,$firstEndTime);
            break;
    }

    return $date_string;
}

function getPostTypeName ( $post )
{
    return match( $post->post_type ) {
        ThemePostTypes::PODCAST => 'Podcast',
        ThemePostTypes::EVENT => 'Event',
        default => 'News',
    };
}

function the_accordion ( $accordion )
{
    ?>
    <div class="accordion__wrap">
        <?php foreach( $accordion as $item ): ?>
            <div class="accordion js-accordion">
                <h3 class="accordion__title js-accordion__title">
                    <?php echo $item['title']; ?>

                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_95_397" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="40" height="40">
                            <rect width="40" height="40" fill="#D9D9D9"/>
                        </mask>
                        <g mask="url(#mask0_95_397)">
                            <path d="M19.0071 34.6008C18.7432 34.3344 18.6113 34.0046 18.6113 33.6112V21.3888H6.38875C5.99542 21.3888 5.66556 21.2553 5.39917 20.9883C5.13306 20.7211 5 20.39 5 19.995C5 19.6003 5.13306 19.271 5.39917 19.0071C5.66556 18.7432 5.99542 18.6112 6.38875 18.6112H18.6113V6.38875C18.6113 5.99542 18.7447 5.66556 19.0117 5.39917C19.2789 5.13306 19.61 5 20.005 5C20.3997 5 20.729 5.13306 20.9929 5.39917C21.2568 5.66556 21.3888 5.99542 21.3888 6.38875V18.6112H33.6112C34.0046 18.6112 34.3344 18.7447 34.6008 19.0117C34.8669 19.2789 35 19.61 35 20.005C35 20.3997 34.8669 20.729 34.6008 20.9929C34.3344 21.2568 34.0046 21.3888 33.6112 21.3888H21.3888V33.6112C21.3888 34.0046 21.2553 34.3344 20.9883 34.6008C20.7211 34.8669 20.39 35 19.995 35C19.6003 35 19.271 34.8669 19.0071 34.6008Z" fill="#32602F"/>
                        </g>
                    </svg>

                </h3>
                <div class="accordion__content js-accordion__content">
                    <div class="wysiwyg">
                        <?php echo $item['content']; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}