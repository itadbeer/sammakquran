<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <meta name="theme-color" content="#333333">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/style.css?v=">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/medium-device.css" media="(min-width: 672px)">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/large-device.css" media="(min-width: 1024px)">
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png?v=">
    <link rel="apple-touch-icon" sizes="48x48" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png?v=">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png?v=">
    <link rel="apple-touch-icon" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png?v=">
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="header">
        <div class="header-container max-width">
            <a class="header-logo" href="<?php echo get_bloginfo('url'); ?>">
                <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo_src = wp_get_attachment_image_src($custom_logo_id, 'full')[0];
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
        <div id="shareMenu">
            <button class="button-container button-56" onclick="copyUrl()">
                <div class="button-face ghost-button">
                    <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/copy.svg" alt="">
                </div>
            </button>
            <a class="button-container button-56" href="https://wa.me/?text={url}%0A{pageTitle}" target="_blank">
                <div class="button-face ghost-button">
                    <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/whatsappt.svg" alt="">
                </div>
            </a>
            <a class="button-container button-56" href="https://t.me/share/url?url={url}&text={pageTitle}" target="_blank">
                <div class="button-face ghost-button">
                    <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/telegram.svg" alt="">
                </div>
            </a>
        </div>
    </header>
    <?php get_template_part('bottom-nav'); ?>