<?php
$page_type = 'صدا ها';
get_header();
$response = file_get_contents("https://dl.sammakqoran.com/metadata.json");
$cached_durations = json_decode($response, true);
$playlist = wp_get_post_terms(get_the_ID(), 'playlists')[0] ?? null;
$args = array(
    'post_type' => 'post',
    'tax_query' => array(
        array(
            'taxonomy' => 'playlists',
            'field' => 'slug',
            'terms' => $playlist?->slug
        )
    )
);
$query = new WP_Query($args);
$found_posts_count = $query->found_posts;
$content = get_the_content();
$audio_src = [];
preg_match_all('/(src)=("[^"]*")/i', $content, $audio_src);
if (count($audio_src[2]) > 0) {
    $audio_src = (str_replace('"', '', $audio_src[2][0]));
} else {
    $audio_src = null;
}
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
            <a class="button-container button-56">
                <div class="button-face ghost-button">
                    <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/audio.svg" alt="صدا">
                </div>
            </a>
            <?php if (!is_null($playlist)) { ?>
                <a class="button-container button-56" href="<?php echo get_term_link($playlist); ?>">
                    <div class="button-face ghost-button text-button">
                        <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/playlist.svg" alt="لیست پخش">
                        <div class="button-text"><?php echo $found_posts_count; ?></div>
                    </div>
                </a>
            <?php } ?>
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
            $thumbnail_src = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . "/images/placeholder.svg";
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
            <?php if (!is_null($playlist)) { ?>
                <a class="button-container button-48" href="<?php echo get_term_link($playlist); ?>">
                    <div class="button-face white-button text-button">
                        <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/playlist.svg" alt="لیست پخش">
                        <div class="button-text"><?php echo $playlist?->name; ?></div>
                        <div class="button-hover"></div>
                    </div>
                </a>
            <?php } ?>
            <div class="audio-content">
                <?php if ($audio_src != null) { ?>
                    <div class="audio-controls">
                        <audio id="audio" src="<?php echo $audio_src; ?>"></audio>
                        <div class="flex jc-center ai-center">
                            <button id="rewindButton" class="button-container button-48">
                                <div class="button-face white-button">
                                    <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/rewind.svg" alt="10 ثانیه عقب">
                                    <div class="button-hover"></div>
                                </div>
                            </button>
                            <button id="playButton" class="button-container button-56 play-button paused    ">
                                <div class="button-face yellow-button">
                                    <img class="button-icon play-icon" src="<?php echo get_template_directory_uri(); ?>/icons/play.svg" alt="پخش">
                                    <img class="button-icon pause-icon" src="<?php echo get_template_directory_uri(); ?>/icons/pause.svg" alt="توقف">
                                    <div class="button-hover"></div>
                                </div>
                            </button>
                            <button id="forwardButton" class="button-container button-48">
                                <div class="button-face white-button">
                                    <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/forward.svg" alt="10 ثانیه جلو">
                                    <div class="button-hover"></div>
                                </div>
                            </button>
                        </div>
                        <div class="audio-timeline-container">
                            <input class="audio-timeline" id="timelineController" type="range" min="0" max="100" value="0">
                            <div class="audio-timeline-face" id="timelineFace"></div>
                        </div>
                        <div class="flex jc-sb">
                            <span id="audioDuration"><?php echo get_media_duration($cached_durations, $audio_src); ?></span>
                            <span id="audioCurrentTime">0:00</span>
                        </div>
                    </div>
                <?php } ?>
                <h2>توضیحات</h2>
                <?php
                echo strip_tags_content($content, ["<a>", "<b>", "<i>", "<u>", "<strong>", "<em>", "<p>", "<br>"]); ?>
            </div>

        </article>
        <?php if (!is_null($playlist)) { ?>
            <section class="dc-column playlist-posts">
                <h2>قسمت‌های دیگر این مجموعه</h2>
                <?php
                $term_title = $playlist->name;
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        get_template_part('template-parts/content', get_post_format(),  args: ["cached_durations" => $cached_durations, "term_title" => $term_title]);
                    }
                    wp_reset_postdata();
                }
                ?>
            </section>
        <?php } ?>
    </section>
</main>
<script src="<?php echo get_template_directory_uri(); ?>/scripts/audio-player.js"></script>
<?php get_footer(); ?>