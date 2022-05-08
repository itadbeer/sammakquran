<?php
$playlist = wp_get_post_terms(get_the_ID(), 'playlists')[0]->name;
?>
<div class="post-container revealable">
    <a class="prevent-default" href="<?php the_permalink(); ?>">
        <div class="post-face video-post">
            <div class="thumbnail-container">
                <?php
                $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                $thumbnail_src = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . "/images/placeholder.svg";
                $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) == "" ? get_the_title() : get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                ?>
                <img class="thumbnail" src="<?php echo $thumbnail_src; ?>" alt="<?php echo $thumbnail_alt ?>">
                <img class="post-type-icon" src="<?php echo get_template_directory_uri(); ?>/icons/video.svg" alt="ویدیو">
                <div class="post-playlist">
                    <img src="<?php echo get_template_directory_uri(); ?>/icons/playlist.svg" alt="لیست پخش">
                    <span><?php echo $playlist; ?></span>
                </div>
                <div class="post-duration">10:37</div>
            </div>
            <h2 class="post-title"><?php echo get_the_title(); ?></h2>
            <div class="post-info">
                <span class="post-category"><?php echo (get_the_category()[0]->name); ?></span>
                <span class="post-time"><?php echo how_many_days_ago_updated(); ?></span>
            </div>
        </div>
    </a>
</div>