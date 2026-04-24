<?php

namespace App\Theme;

class ThemeSetup
{

    const MENU_MAIN = 'main_menu';
    const MOBILE_MENU = 'mobile_menu';
    const FOOTER_MENU = 'footer_menu';

    function __construct()
    {
        add_theme_support('post-thumbnails');

        add_action('get_header', [$this, 'removeHeaderBump']);
        add_action('wp_enqueue_scripts', [ $this, 'enqueueFrontEndScripts']);
        add_action('admin_enqueue_scripts', [ $this, 'enqueueAdminScripts']);
        add_action('enqueue_block_editor_assets', [ $this, 'enqueueGutenbergScripts']);
        add_action('admin_footer', [ $this, 'preventGutenbergLinks' ]);
        add_filter('tiny_mce_before_init', [ $this, 'limitTinyMceOptions']);

        register_nav_menu(self::MENU_MAIN,'Main Menu');
        register_nav_menu(self::FOOTER_MENU,'Footer Menu');
        register_nav_menu(self::MOBILE_MENU,'Mobile Menu');
    }

    public function removeHeaderBump() {
        remove_action('wp_head', '_admin_bar_bump_cb');
    }

    function enqueueFrontEndScripts() : void
    {
        $theme = wp_get_theme();
        $version = $theme->get('Version');

        wp_enqueue_style('general_styles', get_template_directory_uri() . '/dist/css/app.css', [],  $version );
        wp_enqueue_style('google_fonts_aleo', 'https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,100..900;1,100..900&display=swap', [], $version );
        wp_enqueue_style('google_fonts_public_sans', 'https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap', [], $version );
        wp_enqueue_script('general_scripts', get_template_directory_uri() . '/dist/js/main.js', ['jquery'], $version, [
            'in_footer' => true
        ] );
        wp_localize_script('general_scripts', 'themeData', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
        ]);
    }

    function enqueueAdminScripts () : void
    {
        $theme = wp_get_theme();
        $version = $theme->get('Version');

        wp_enqueue_style('general_style', get_template_directory_uri() . '/dist/css/admin-styles.css', [],  $version );
    }

    function enqueueGutenbergScripts() : void
    {
        $theme = wp_get_theme();
        $version = $theme->get('Version');

        wp_enqueue_style('gutenberg', get_template_directory_uri() . '/dist/css/gutenberg.css', [], $version );
        wp_enqueue_style('google_fonts_aleo', 'https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,100..900;1,100..900&display=swap', [], $version );
        wp_enqueue_style('google_fonts_public_sans', 'https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap', [], $version );
    }

    public function preventGutenbergLinks ()
    {
        if( is_gutenberg_editor() ) {
            ?>
            <script>
                jQuery( function ($){

                    $('body').on('click', '.editor-styles-wrapper a', function(e){
                        e.preventDefault();
                    });
                });
            </script>
            <?php
        }
    }

    public function limitTinyMceOptions( $options )
    {
        // Restrict to only paragraph, h2, h3, h4
        $options['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4';
        return $options;
    }

}
