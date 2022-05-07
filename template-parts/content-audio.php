<div class="post-container">
    <a class="prevent-default" href="<?php the_permalink(); ?>">
        <div class="post-face audio-post">
            <div class="flex ai-center">
                <div class="thumbnail-container">
                    <img class="thumbnail" src="<?php echo get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . "/images/thumbnail.jpg"; ?>" alt="">
                    <img class="post-type-icon" src="<?php echo get_template_directory_uri(); ?>/icons/audio.svg" alt="">
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
                    <img src="<?php echo get_template_directory_uri(); ?>/icons/playlist.svg" alt="">
                    <span><?php echo $args['term_title']; ?></span>
                </div>
                <div class="post-duration">10:37</div>
            </div>
        </div>
    </a>
</div>