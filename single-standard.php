<?php
get_header();
$page_type = 'نوشته ها';
$args = [
  'post_type' => 'post',
];
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
      <a class="button-container button-56" href="#">
        <div class="button-face ghost-button">
          <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/blog.svg" alt="مقاله">
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

  <article class="single single-blog">
    <h1 class="main-title"><?php echo get_the_title(); ?></h1>
    <div class="single-info flex jc-sb ai-center">
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
    <div class="blog-content">
      <?php
      $thumbnail_id = get_post_thumbnail_id(get_the_ID());
      $thumbnail_src = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . "/images/thumbnail.jpg";
      $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) == "" ? get_the_title() : get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
      ?>
      <img src="<?php echo $thumbnail_src; ?>" alt="<?php echo $thumbnail_alt; ?>">
      <?php echo the_content(); ?>
    </div>
  </article>
</main>
<?php get_footer(); ?>