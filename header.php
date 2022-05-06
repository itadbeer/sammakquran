<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <meta name="theme-color" content="#333333">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/style.css?v=">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/medium-device.css" media="(min-width: 672px)">
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
                    echo '<img src="' . esc_url($logo_src) . '" alt="' . get_bloginfo('name') . '">';
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/images/logo.png" alt="">';
                }
                ?>
            </a>
            <?php get_search_form(); ?>
        </div>
    </header>

    <nav class="bottom-nav">
        <ul class="bottom-nav-face">
            <li class="bottom-nav-item active">
                <a class="prevent-default" href="">
                    <img class="bottom-nav-icon" src="<?php echo get_template_directory_uri(); ?>/icons/all.svg" alt="">
                    <span class="bottom-nav-label">همه</span>
                </a>
            </li>
            <li class="bottom-nav-item">
                <a class="prevent-default" href="">
                    <img class="bottom-nav-icon" src="<?php echo get_template_directory_uri(); ?>/icons/video.svg" alt="">
                    <span class="bottom-nav-label">ویدیوها</span>
                </a>
            </li>
            <li class="bottom-nav-item">
                <a class="prevent-default" href="">
                    <img class="bottom-nav-icon" src="<?php echo get_template_directory_uri(); ?>/icons/audio.svg" alt="">
                    <span class="bottom-nav-label">صداها</span>
                </a>
            </li>
            <li class="bottom-nav-item">
                <a class="prevent-default" href="">
                    <img class="bottom-nav-icon" src="<?php echo get_template_directory_uri(); ?>/icons/blog.svg" alt="">
                    <span class="bottom-nav-label">نوشته‌ها</span>
                </a>
            </li>
        </ul>
    </nav>