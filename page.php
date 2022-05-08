<?php
get_header();
?>
<main class="main max-width">
    <header class="main-header relative">
        <button class="button-container button-56" onclick="history.back()">
            <div class="button-face green-button">
                <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="برگشت">
                <div class="button-glow"></div>
                <div class="button-hover"></div>
            </div>
        </button>
        <button class="button-container button-56" onclick="openShareMenu()">
            <div class="button-face yellow-button">
                <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/share.svg" alt="اشتراک گذاری">
                <div class="button-glow"></div>
                <div class="button-hover"></div>
            </div>
        </button>
        <div id="shareMenu">
            <button class="button-container button-56" onclick="copyUrl()">
                <div class="button-face ghost-button">
                    <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/copy.svg" alt="">
                </div>
            </button>
            <a class="button-container button-56" href="https://wa.me/?text=<?php echo get_the_permalink(); ?>%0A<?php echo get_the_title(); ?>" target="_blank">
                <div class="button-face ghost-button">
                    <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/whatsappt.svg" alt="">
                </div>
            </a>
            <a class="button-container button-56" href="https://t.me/share/url?url=<?php echo get_the_permalink(); ?>&text=<?php echo get_the_title(); ?>" target="_blank">
                <div class="button-face ghost-button">
                    <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/telegram.svg" alt="">
                </div>
            </a>
        </div>
    </header>

    <article class="single single-blog">
        <h1 class="main-title"><?php echo get_the_title(); ?></h1>
        <div class="blog-content">
            <?php echo the_content(); ?>
        </div>
    </article>
</main>
<?php get_footer(); ?>