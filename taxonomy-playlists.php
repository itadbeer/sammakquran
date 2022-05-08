<?php get_header();
$args = array(
  'post_type' => 'post',
  'posts_per_page' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'playlists',
      'field' => 'slug',
      'terms' => get_queried_object()->slug
    )
  )
);
$query = new WP_Query($args);
$count = $query->found_posts;
$term = get_term(get_queried_object());
$termMeta = get_option($term->term_id);
$playlist_type = $termMeta['playlist_type'] ?? "standard";
switch ($playlist_type) {
  case 'video':
    $play_list_type_icon = get_template_directory_uri() . '/icons/video.svg';
    break;
  case 'audio':
    $play_list_type_icon = get_template_directory_uri() . '/icons/audio.svg';
    break;
  case 'standard':
    $play_list_type_icon = get_template_directory_uri() . '/icons/blog.svg';
    break;
  default:
    $play_list_type_icon = get_template_directory_uri() . '/icons/blog.svg';
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
      <a class="button-container button-56" href="">
        <div class="button-face ghost-button">
          <img class="button-icon post-type-indicator" src="<?php echo $play_list_type_icon; ?>" alt="">
        </div>
      </a>
      <a class="button-container button-56" href="<?php echo get_queried_object()->the_permalink; ?>">
        <div class="button-face ghost-button text-button">
          <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/playlist.svg" alt="لیست پخش">
          <div class="button-text"><?php echo $count; ?></div>
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
      <a class="button-container button-56" href="https://wa.me/?text=<?php echo get_the_permalink(); ?>%0A<?php echo single_term_title('', false); ?>" target="_blank">
        <div class="button-face ghost-button">
          <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/whatsappt.svg" alt="">
        </div>
      </a>
      <a class="button-container button-56" href="https://t.me/share/url?url=<?php echo get_the_permalink(); ?>&text=<?php echo single_term_title('', false); ?>" target="_blank">
        <div class="button-face ghost-button">
          <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/telegram.svg" alt="">
        </div>
      </a>
    </div>
  </header>

  <section class="dbl-column flex ai-start">
    <article class="flex column ai-start single single-video dc-column">
      <h1 class="main-title"><?php echo single_term_title('', false); ?></h1>
      <div class="playlist-update">بروزرسانی: <?php echo how_many_days_ago_updated(); ?></div>
      <div class="video-content">
        <h2>توضیحات</h2>
        <p>
          <?php echo term_description(); ?>
        </p>
      </div>
    </article>
    <section class="dc-column playlist-posts">
      <h2>قسمت‌های این مجموعه</h2>
      <?php
      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
          get_template_part('template-parts/content', get_post_format());
        }
      }
      wp_reset_postdata();
      ?>
    </section>
  </section>
  <?php get_footer(); ?>