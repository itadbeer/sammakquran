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
$termID = $term->term_id;
$termMeta = get_option($termID);
$playlist_type = $termMeta['playlist_type'];
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
  <header class="main-header">
    <button class="button-container button-56">
      <div class="button-face green-button">
        <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="">
        <div class="button-glow"></div>
        <div class="button-hover"></div>
      </div>
    </button>
    <div class="flex">
      <a class="button-container button-56" href="">
        <div class="button-face ghost-button">
          <img class="button-icon" src="<?php echo $play_list_type_icon; ?>" alt="">
        </div>
      </a>
      <a class="button-container button-56" href="playlist.html">
        <div class="button-face ghost-button text-button">
          <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/playlist.svg" alt="">
          <div class="button-text"><?php echo $count; ?></div>
        </div>
      </a>
    </div>
    <button class="button-container button-56">
      <div class="button-face yellow-button">
        <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/share.svg" alt="">
        <div class="button-glow"></div>
        <div class="button-hover"></div>
      </div>
    </button>
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
      $term_title = single_term_title('', false);
      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
          get_template_part('template-parts/content', get_post_format(),  args: ["term_title" => $term_title]);
        }
      }
      wp_reset_postdata();
      ?>
    </section>
  </section>
  <?php get_footer(); ?>