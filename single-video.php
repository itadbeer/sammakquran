<?php
get_header();
$page_type = 'ویدیو ها';
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
  <header class="main-header">
    <button class="button-container button-56">
      <div class="button-face green-button">
        <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="برگشت">
        <div class="button-glow"></div>
        <div class="button-hover"></div>
      </div>
    </button>
    <div class="flex">
      <a class="button-container button-56" href="">
        <div class="button-face ghost-button">
          <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/video.svg" alt="ویدیو">
        </div>
      </a>
      <a class="button-container button-56" href="<?php echo "#"; ?>">
        <div class="button-face ghost-button text-button">
          <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/playlist.svg" alt="لیست پخش">
          <div class="button-text"><?php echo $found_posts_count; ?></div>
        </div>
      </a>
    </div>
    <button class="button-container button-56">
      <div class="button-face yellow-button">
        <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/share.svg" alt="اشتراک گذاری">
        <div class="button-glow"></div>
        <div class="button-hover"></div>
      </div>
    </button>
  </header>

  <video class="main-video" src=""></video>

  <section class="dbl-column flex ai-start">
    <article class="flex column ai-start single single-video dc-column">
      <h1 class="main-title"><?php echo get_the_title(); ?></h1>
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
      <div class="video-content">
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
<?php get_footer(); ?>