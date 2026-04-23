<?php
namespace App\Theme;

use App\Helpers\BlockCategory;

class ThemeBlocks
{
    function __construct() {
        $blocks = new BlockCategory('Collective Measures');
        $blocks->addBlock( 'media-text', 'Media & Text', );
        $blocks->addBlock( 'section-title', 'Section Title', );
        $blocks->addBlock( 'modal-cards', 'Modal Cards', );
        $blocks->addBlock( 'form-image', 'Form and Image', );
        $blocks->addBlock( 'testimonials', 'Testimonials', );
        $blocks->addBlock( 'stats-cards', 'Stats Cards', );
        $blocks->addBlock( 'buttons', 'Button Group', );
        $blocks->addBlock( 'three-col-content', '3-Column Content' );
        $blocks->addBlock( 'single-quote', 'Single Quote' );
    }
}
