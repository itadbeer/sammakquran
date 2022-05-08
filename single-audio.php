<?php
$page_type = 'صدا ها';
get_header();
$playlist = wp_get_post_terms(get_the_ID(), 'playlists')[0];
$args = array(
    'post_type' => 'post',
    'tax_query' => array(
        array(
            'taxonomy' => 'playlists',
            'field' => 'slug',
            'terms' => $playlist->slug
        )
    )
);
$query = new WP_Query($args);
$found_posts_count = $query->found_posts;
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
        <div class="flex">
            <a class="button-container button-56" href="">
                <div class="button-face ghost-button">
                    <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/audio.svg" alt="صدا">
                </div>
            </a>
            <a class="button-container button-56" href="<?php echo "#" ?>">
                <div class="button-face ghost-button text-button">
                    <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/playlist.svg" alt="لیست پخش">
                    <div class="button-text"><?php echo $found_posts_count; ?></div>
                </div>
            </a>
        </div>
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

    <section class="dbl-column flex">
        <article class="flex column ai-center single single-audio dc-column">
            <?php
            $thumbnail_id = get_post_thumbnail_id(get_the_ID());
            $thumbnail_src = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . "/images/thumbnail.jpg";
            $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) == "" ? get_the_title() : get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
            ?>

            <img class="single-audio-thumbnail" src="<?php echo $thumbnail_src; ?>" alt="<?php echo $thumbnail_alt; ?>">
            <h1 class=" main-title"><?php echo get_the_title(); ?></h1>
            <div class="single-info flex jc-center ai-center">
                <?php
                $categories = get_the_category();
                $counter = 0;
                foreach ($categories as $category) {
                    $counter++;
                    if ($counter > 2) {
                        break;
                    }
                    echo '<a class="single-category" href="' . get_category_link($category) . '">';
                    echo '<span class="single-category">' . $category->name . '</span>';
                    echo '<div class="button-hitbox"></div>';
                    echo '</a>';
                }
                ?>
                <span class="single-time"><?php echo how_many_days_ago_updated(); ?></span>
            </div>
            <a class="button-container button-48" href="<?php echo get_term_link($playlist); ?>">
                <div class="button-face white-button text-button">
                    <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/playlist.svg" alt="لیست پخش">
                    <div class="button-text"><?php echo $playlist->name; ?></div>
                    <div class="button-hover"></div>
                </div>
            </a>
            <div class="audio-content">
                <div class="audio-controls">
                    <div class="flex jc-center ai-center">
                        <button class="button-container button-48">
                            <div class="button-face white-button">
                                <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/rewind.svg" alt="عقب">
                                <div class="button-hover"></div>
                            </div>
                        </button>
                        <button class="button-container button-56 play-button">
                            <div class="button-face yellow-button">
                                <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/play.svg" alt="پخش">
                                <div class="button-hover"></div>
                            </div>
                        </button>
                        <button class="button-container button-48">
                            <div class="button-face white-button">
                                <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/forward.svg" alt="جلو">
                                <div class="button-hover"></div>
                            </div>
                        </button>
                    </div>
                    <div class="audio-timeline">
                        <div class="timeline-passed"></div>
                    </div>
                    <div class="flex jc-sb">
                        <span>4:56</span>
                        <span>10:37</span>
                    </div>
                </div>
                <h2>توضیحات</h2>
                <?php echo the_content(); ?>
            </div>
        </article>
        <section class="dc-column playlist-posts">
            <h2>قسمت‌های دیگر این مجموعه</h2>
            <?php
            $term_title = $playlist->name;
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    get_template_part('template-parts/content', get_post_format(),  args: ["term_title" => $term_title]);
                }
                wp_reset_postdata();
            }
            ?>
        </section>
    </section>
</main>
<script src="<?php echo get_template_directory_uri(); ?>/scripts/audio-player.js"></script>
<?php get_footer(); ?>