<form class="header-search" action="<?php echo esc_url(home_url()); ?>" method="GET">
    <input class="search-input" type="search" name="s" id="search" placeholder="جست‌وجو" value="<?php the_search_query(); ?>">
    <button class="button-container search-button">
        <div class="button-face green-button">
            <img class="button-icon search-icon" src="<?php echo get_template_directory_uri(); ?>/icons/search.svg">
            <div class="button-glow"></div>
            <div class="button-hover"></div>
        </div>
        <div class="button-hitbox"></div>
    </button>
</form>