<!DOCTYPE html>
<html lang="<?php echo get_locale(); ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="https://use.typekit.net/wqz3nuq.css">
    <!-- Disable automatic link creation in Safari -->
    <meta name="format-detection" content="telephone=no">
    <title>
        <?php wp_title('|', true, 'right') ?>
        <?php bloginfo('name'); ?>
    </title>

    <!-- WP HEAD -->
    <?php wp_head(); ?>
    <!-- /WP HEAD -->

    <?php tracking_codes('tracking_before_head') ?>

    <?php if( false ): ?>
        <!-- OneTrust Cookies Consent Notice start for clearwellness.com -->
        <script type="text/javascript" src="https://cdn.cookielaw.org/consent/01966803-6507-7d16-af1b-30d82791199e/OtAutoBlock.js" ></script>
        <script src="https://cdn.cookielaw.org/scripttemplates/otSDKStub.js"  type="text/javascript" charset="UTF-8" data-domain-script="01966803-6507-7d16-af1b-30d82791199e" ></script>
        <script type="text/javascript">
            function OptanonWrapper() { }
        </script>
        <!-- OneTrust Cookies Consent Notice end for clearwellness.com -->
        <script type="text/javascript">
            function OptanonWrapper() { }
        </script>
        <!-- OneTrust Cookies Consent Notice end -->
    <?php endif; ?>

</head>

<body>
<?php tracking_codes('tracking_after_body') ?>
<?php get_template_part('parts/globalBanner'); ?>
<div id="wrap">
    <?php get_template_part('parts/siteHeader'); ?>