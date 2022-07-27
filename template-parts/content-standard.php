<div class="post-container revealable" id="p<?php echo $args['counter']; ?>">
    <a class="prevent-default" href="<?php the_permalink(); ?>">
        <div class="post-face blog-post">
            <div class="flex ai-center">
                <div class="thumbnail-container">
                    <?php
                    $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                    $thumbnail_src = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . "/images/placeholder.svg";
                    $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) == "" ? get_the_title() : get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                    ?>
                    <img class="thumbnail" src="<?php echo $thumbnail_src; ?>" alt="<?php echo $thumbnail_alt; ?>">
                    <img class="post-type-icon" src="<?php echo get_template_directory_uri(); ?>/icons/blog.svg" alt="مقاله">
                </div>
                <div class="flex column">
                    <h2 class="post-title"><?php echo get_the_title(); ?></h2>
                    <div class="post-info">
                        <span class="post-category"><?php echo (get_the_category()[0]->name); ?></span>
                        <span class="post-time"><?php echo how_many_days_ago_updated(); ?></span>
                    </div>
                </div>
            </div>
            <p class="post-excerpt">
                <?php echo wp_trim_words(get_the_content(), 15, '...'); ?>
            </p>
        </div>
    </a>
</div>