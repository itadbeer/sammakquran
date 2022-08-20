<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <meta name="theme-color" content="#333333">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/style.css?v=<?php echo get_theme_version(); ?>">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/medium-device.css?v=<?php echo get_theme_version(); ?>" media="(min-width: 672px)">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/large-device.css?v=<?php echo get_theme_version(); ?>" media="(min-width: 1024px)">
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png?v=<?php echo get_theme_version(); ?>">
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="header">
        <div class="header-container max-width">
            <a class="header-logo" href="<?php echo get_bloginfo('url'); ?>">
                <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo_src = wp_get_attachment_image_src($custom_logo_id, 'full') ? wp_get_attachment_image_src($custom_logo_id, 'full')[0] : null;
                if (has_custom_logo()) {
                    $logo_alt = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true) == "" ? get_bloginfo('name') : get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);
                    echo '<img src="' . esc_url($logo_src) . '" alt="' . $logo_alt . '">';
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/images/logo.png" alt="' . get_bloginfo('name') . '">';
                }
                ?>
            </a>
            <?php get_search_form(); ?>
        </div>
    </header>
    <?php if (!isset($args['hide_bottom_navbar'])) {
        get_template_part('bottom-nav');
    } ?>