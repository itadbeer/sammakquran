<?php
get_header();
$response = file_get_contents("https://dl.sammakqoran.com/metadata.json");
$cached_durations = json_decode($response, true);
$order = $_GET['order'] ?? 'DESC';
$pageNumber = $_GET['pageNumber'] ?? 1;
if (isset($_GET['orderby']) && in_array($_GET['orderby'], $orderby_allowed_list)) {
  $orderby = $_GET['orderby'];
}
$cat_id = get_query_var('cat');
$args = [
  'order' => $order,
  'posts_per_page' => (get_option('posts_per_page') * $pageNumber) + 1,
  "cat"           => $cat_id,
];
$posts = new WP_Query($args);
if ($posts->have_posts()) {

  // get all playlists of posts in this category
  $playlists = [];
  while ($posts->have_posts()) {
    $posts->the_post();
    $playlist = wp_get_post_terms(get_the_ID(), 'playlists')[0] ?? [];
    if (!in_array($playlist, $playlists) && $playlist !== []) {
      array_push($playlists, $playlist);
    }
  }

?>
  <main class="main flex column ai-center max-width fluid-width">

    <section class="splide categories-carousel" aria-label="مجموعه‌های این دسته">
      <div style="position:relative;">
        <div class="splide__arrows flex jc-sb">
          <button class="splide__arrow splide__arrow--prev button-container button-48">
            <div class="button-face green-button">
              <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="">
              <div class="button-glow"></div>
              <div class="button-hover"></div>
            </div>
          </button>
          <button class="splide__arrow splide__arrow--next button-container button-48">
            <div class="button-face green-button">
              <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="">
              <div class="button-glow"></div>
              <div class="button-hover"></div>
            </div>
          </button>
        </div>
        <div class="splide__track">
          <ul class="splide__list">
            <?php
            foreach ($playlists as $key => $playlist) {
            ?>
              <li class="splide__slide">
                <a class="button-container button-48" href="<?php echo $playlist->slug ?? ''; ?>">
                  <div class="button-face white-button text-button">
                    <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/playlist.svg" alt="">
                    <div class="button-text"><?php echo $playlist->name ?? ''; ?></div>
                    <div class="button-hover"></div>
                  </div>
                </a>
              </li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </section>

    <header class="main-header relative">
      <h1 class="main-title"><?php echo single_cat_title(); ?></h1>
      <button class="button-container button-48" onclick="openFilters()">
        <div class="button-face yellow-button text-button">
          <div class="button-text">فیلترها</div>
          <div class="button-glow"></div>
          <div class="button-hover"></div>
        </div>
      </button>
    </header>
    <?php get_template_part("template-parts/filters", args: ['hide_category_filter_options' => true]); ?>
    <section class="posts-grid">
      <?php
      $counter = 0;
      while ($posts->have_posts()) {
        $posts->the_post();
        get_template_part('template-parts/content', get_post_format(), args: ['cached_durations' => $cached_durations, 'counter' => ++$counter]);
      }
      wp_reset_postdata();
      ?>
    </section>
    <?php
    $category_posts_count = get_category($cat_id)->category_count;
    $displayed_posts_count = (get_option('posts_per_page') * $pageNumber) + 1;
    if ($displayed_posts_count < $category_posts_count) { ?>
      <form class="view-more-container flex jc-center">
        <button class="button-container button-48" name="pageNumber" value="<?php echo ++$pageNumber; ?>" onclick="getPostCardsCount()">
          <div class="button-face yellow-button text-button">
            <div class="button-text">بیشتر</div>
            <div class="button-glow"></div>
            <div class="button-hover"></div>
          </div>
        </button>
      </form>
  <?php }
  } else {
    get_template_part('template-parts/empty-state', args: ['title' => 'درحال حاضر در این دسته محتوایی وجود ندارد']);
  } ?>
  </main>
  <script src="<?php echo get_template_directory_uri(); ?>/scripts/splide.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/scripts/sliders.js?v=<?php echo get_theme_version(); ?>"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/scripts/load_more_post.js"></script>
  <?php
  get_footer();
  ?>