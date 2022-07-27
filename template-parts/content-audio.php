<?php
$playlist = wp_get_post_terms(get_the_ID(), 'playlists')[0]?->name ?? null;
$content = get_the_content();
$audio_src = [];
preg_match_all('/(src)=("[^"]*")/i', $content, $audio_src);
if (count($audio_src[2]) > 0) {
    $audio_src = (str_replace('"', '', $audio_src[2][0]));
} else {
    $audio_src = "";
}
?>
<div class="post-container revealable" id="p<?php echo $args['counter'] ?? ''; ?>">
    <a class="prevent-default" href="<?php the_permalink(); ?>">
        <div class="post-face audio-post">
            <div class="flex ai-center">
                <div class="thumbnail-container">
                    <?php
                    $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                    $thumbnail_src = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . "/images/placeholder.svg";
                    $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) == "" ? get_the_title() : get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                    ?>
                    <img class="thumbnail" src="<?php echo $thumbnail_src; ?>" alt="<?php echo $thumbnail_alt; ?>" loading="lazy">
                    <img class="post-type-icon" src="<?php echo get_template_directory_uri(); ?>/icons/audio.svg" alt="صدا">
                </div>
                <div class="flex column">
                    <h2 class="post-title"><?php echo get_the_title(); ?></h2>
                    <div class="post-info">
                        <span class="post-category"><?php echo (get_the_category()[0]->name); ?></span>
                        <span class="post-time"><?php echo how_many_days_ago_updated(); ?></span>
                    </div>
                </div>
            </div>
            <div class="flex fw-wrap jc-sb ai-end">

                <div class="post-playlist">
                    <?php if (!is_null($playlist)) { ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/icons/playlist.svg" alt="لیست پخش">
                        <span><?php echo $playlist; ?></span>
                    <?php } ?>
                </div>

                <div class="post-duration"><?php echo get_media_duration($args['cached_durations'], $audio_src); ?></div>
            </div>
        </div>
    </a>
</div>