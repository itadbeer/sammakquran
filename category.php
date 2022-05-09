<?php
get_header();
$pageNumber = $_GET['pageNumber'] ?? 1;
$orderby_allowed_list = ['modified', 'date'];
$orderby = "modified";
if (isset($_GET['orderby']) && in_array($_GET['orderby'], $orderby_allowed_list)) {
  $orderby = $_GET['orderby'];
}
$cat_id = get_query_var('cat');
$args = [
  'posts_per_page' => intval(get_option('posts_per_page')) * $pageNumber,
  "cat"           => $cat_id,
  "orderby"       => $orderby
];
$posts = new WP_Query($args);
?>
<main class="main flex column ai-center max-width fluid-width">
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

  <div id="filtersOverlay">
    <form id="filters">
      <h2 class="filters-heading">فیلترها</h2>
      <h3 class="filters-category">دسته</h3>
      <input type="checkbox" name="test" id="checkboxTest">
      <label class="custom-checkbox" for="checkboxTest">
        <div class="checkbox-button">
          <div class="checkbox-icon"></div>
          <div class="checkbox-hover"></div>
        </div>
        <div class="checkbox-text">چکباکس تستی</div>
      </label>
      <input type="checkbox" name="test" id="checkboxTest2">
      <label class="custom-checkbox" for="checkboxTest2">
        <div class="checkbox-button">
          <div class="checkbox-icon"></div>
          <div class="checkbox-hover"></div>
        </div>
        <div class="checkbox-text">چکباکس تستی</div>
      </label>
      <input type="checkbox" name="test" id="checkboxTest3">
      <label class="custom-checkbox" for="checkboxTest3">
        <div class="checkbox-button">
          <div class="checkbox-icon"></div>
          <div class="checkbox-hover"></div>
        </div>
        <div class="checkbox-text">چکباکس تستی</div>
      </label>

      <h3 class="filters-category">دسته</h3>
      <input type="radio" name="test2" id="radioTest1">
      <label class="custom-radio" for="radioTest1">
        <div class="radio-button">
          <div class="radio-icon"></div>
          <div class="radio-hover"></div>
        </div>
        <div class="radio-text">رادیو تستی</div>
      </label>
      <input type="radio" name="test2" id="radioTest2">
      <label class="custom-radio" for="radioTest2">
        <div class="radio-button">
          <div class="radio-icon"></div>
          <div class="radio-hover"></div>
        </div>
        <div class="radio-text">رادیو تستی</div>
      </label>

      <div class="filters-button-bar">
        <button class="button-container button-48" type="reset">
          <div class="button-face white-button text-button">
            <div class="button-text">پاک‌کردن</div>
            <div class="button-glow"></div>
            <div class="button-hover"></div>
          </div>
        </button>
        <button class="button-container button-48" type="submit">
          <div class="button-face green-button text-button">
            <div class="button-text">اعمال</div>
            <div class="button-glow"></div>
            <div class="button-hover"></div>
          </div>
        </button>
      </div>
    </form>
  </div>

  <section class="posts-grid">
    <?php
    if ($posts->have_posts()) {
      while ($posts->have_posts()) {
        $posts->the_post();
        get_template_part('template-parts/content', get_post_format());
      }
      wp_reset_postdata();
    }
    ?>
  </section>
  <?php if ($posts->max_num_pages > 1) { ?>
    <div class="view-more-container flex jc-center">
      <button class="button-container button-48">
        <div class="button-face yellow-button text-button">
          <div class="button-text">بیشتر</div>
          <div class="button-glow"></div>
          <div class="button-hover"></div>
        </div>
      </button>
    </div>
  <?php } ?>
</main>
<script src="<?php echo get_template_directory_uri(); ?>/scripts/load_more_post.js"></script>
<?php echo get_footer(); ?>