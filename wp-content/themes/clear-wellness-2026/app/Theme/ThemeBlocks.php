<?php
namespace App\Theme;

use App\Helpers\BlockCategory;

class ThemeBlocks
{
    function __construct() {
        $blocks = new BlockCategory('Collective Measures');
        $blocks->addBlock( 'home-hero', 'Main Hero', '', ['banner', 'title']);
    }
}
