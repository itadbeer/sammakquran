<?php
get_header();
?>
<main class="main flex column ai-center max-width fluid-width">
  <section class="splide header-carousel" aria-label="بنرهای هدر">
    <div style="position:relative;">
      <div class="splide__arrows flex jc-sb">
        <button class="splide__arrow splide__arrow--prev button-container button-32">
          <div class="button-face green-button">
            <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="قبلی">
            <div class="button-glow"></div>
            <div class="button-hover"></div>
          </div>
          <div class="button-hitbox"></div>
        </button>
        <button class="splide__arrow splide__arrow--next button-container button-32">
          <div class="button-face green-button">
            <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="بعدی">
            <div class="button-glow"></div>
            <div class="button-hover"></div>
          </div>
          <div class="button-hitbox"></div>
        </button>
      </div>
      <div class="splide__track">
        <ul class="splide__list">
          <?php
          $slider = new WP_Query(
            [
              'post_type' => 'sliders',
              'posts_per_page' => 10,
            ]
          );
          if ($slider->have_posts()) {
            while ($slider->have_posts()) {
              $slider->the_post();
              $thumbnail_id = get_post_thumbnail_id($slider->get_the_ID());
              $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) == "" ? get_the_title($slider) : get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
              $thumbnail_src = wp_get_attachment_image_src($thumbnail_id)[0] ?? get_template_directory_uri() . "/icons/all.svg";
              echo '<li class="splide__slide">';
              echo '<a class="header-banner" href="">';
              echo '<img data-splide-lazy="' . $thumbnail_src . '" alt="' . $thumbnail_alt . '">';
              echo '</a>';
              echo '</li>';
            }
            wp_reset_postdata();
          }
          ?>
        </ul>
      </div>
    </div>
  </section>
  <section class="splide categories-carousel" aria-label="دسته‌بندی‌ها">
    <div style="position:relative;">
      <div class="splide__arrows flex jc-sb">
        <button class="splide__arrow splide__arrow--prev button-container button-48">
          <div class="button-face green-button">
            <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="قبلی">
            <div class="button-glow"></div>
            <div class="button-hover"></div>
          </div>
        </button>
        <button class="splide__arrow splide__arrow--next button-container button-48">
          <div class="button-face green-button">
            <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="بعدی">
            <div class="button-glow"></div>
            <div class="button-hover"></div>
          </div>
        </button>
      </div>
      <div class="splide__track">
        <ul class="splide__list">
          <?php
          $category_ids = get_terms();
          $categories = get_categories(["orderby" => "count", "order" => "DESC"]);
          foreach ($categories as $category) {
            $category_name = $category->name;
            $category_link = get_category_link($category->term_id);
          ?>
            <li class="splide__slide">
              <a class="button-container button-48" href="<?php echo $category_link; ?>">
                <div class="button-face white-button text-button">
                  <div class="button-text"><?php echo $category_name; ?></div>
                  <div class="button-hover"></div>
                </div>
              </a>
            </li>
          <?php }
          ?>
        </ul>
      </div>
    </div>
  </section>
  <section class="splide posts-carousel" aria-label="جدیدترین ویدیوها">
    <header class="carousel-header flex ai-center">
      <img class="carousel-icon" src="<?php echo get_template_directory_uri(); ?>/icons/video.svg" alt="ویدیو">
      <h1 class="main-title">جدیدترین ویدیوها</h1>
      <div class="splide__arrows flex">
        <button class="splide__arrow splide__arrow--prev button-container button-32">
          <div class="button-face green-button">
            <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="قبلی">
            <div class="button-glow"></div>
            <div class="button-hover"></div>
          </div>
          <div class="button-hitbox"></div>
        </button>
        <button class="splide__arrow splide__arrow--next button-container button-32">
          <div class="button-face green-button">
            <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="بعدی">
            <div class="button-glow"></div>
            <div class="button-hover"></div>
          </div>
          <div class="button-hitbox"></div>
        </button>
      </div>
    </header>
    <div class="splide__track">
      <ul class="splide__list">
        <?php
        $query = new WP_Query(array(
          'tax_query' => array(
            array(
              'taxonomy' => 'post_format',
              'field' => 'slug',
              'terms' => ['post-format-video'],
              'orderby' => "date",
              'order' => 'DESC'
            )
          )
        ));
        if ($query->have_posts()) {
          while ($query->have_posts()) {
            $query->the_post();
            echo '<li class="splide__slide">';
            get_template_part('template-parts/content', get_post_format());
            echo '</li>';
          }
          wp_reset_postdata();
        }
        ?>
      </ul>
    </div>
  </section>
  <section class="splide posts-carousel" aria-label="جدیدترین صداها">
    <header class="carousel-header flex ai-center">
      <img class="carousel-icon" src="<?php echo get_template_directory_uri(); ?>/icons/audio.svg" alt="صدا">
      <h1 class="main-title">جدیدترین صداها</h1>
      <div class="splide__arrows flex">
        <button class="splide__arrow splide__arrow--prev button-container button-32">
          <div class="button-face green-button">
            <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="قبلی">
            <div class="button-glow"></div>
            <div class="button-hover"></div>
          </div>
          <div class="button-hitbox"></div>
        </button>
        <button class="splide__arrow splide__arrow--next button-container button-32">
          <div class="button-face green-button">
            <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="بعدی">
            <div class="button-glow"></div>
            <div class="button-hover"></div>
          </div>
          <div class="button-hitbox"></div>
        </button>
      </div>
    </header>
    <div class="splide__track">
      <ul class="splide__list">
        <?php
        $query = new WP_Query(array(
          'tax_query' => array(
            array(
              'taxonomy' => 'post_format',
              'field' => 'slug',
              'terms' => ['post-format-audio'],
              'orderby' => "date",
              'order' => 'DESC'
            )
          )
        ));
        if ($query->have_posts()) {
          while ($query->have_posts()) {
            $query->the_post();
            echo '<li class="splide__slide">';
            get_template_part('template-parts/content', get_post_format());
            echo '</li>';
          }
          wp_reset_postdata();
        }
        ?>
      </ul>
    </div>
  </section>
  <section class="splide posts-carousel" aria-label="جدیدترین نوشته‌ها">
    <header class="carousel-header flex ai-center">
      <img class="carousel-icon" src="<?php echo get_template_directory_uri(); ?>/icons/blog.svg" alt="مقاله">
      <h1 class="main-title">جدیدترین نوشته‌ها</h1>
      <div class="splide__arrows flex">
        <button class="splide__arrow splide__arrow--prev button-container button-32">
          <div class="button-face green-button">
            <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="قبلی">
            <div class="button-glow"></div>
            <div class="button-hover"></div>
          </div>
          <div class="button-hitbox"></div>
        </button>
        <button class="splide__arrow splide__arrow--next button-container button-32">
          <div class="button-face green-button">
            <img class="button-icon" src="<?php echo get_template_directory_uri(); ?>/icons/back.svg" alt="بعدی">
            <div class="button-glow"></div>
            <div class="button-hover"></div>
          </div>
          <div class="button-hitbox"></div>
        </button>
      </div>
    </header>
    <div class="splide__track">
      <ul class="splide__list">
        <?php
        $query = new WP_Query(array(
          'tax_query' => array(
            array(
              'taxonomy' => 'post_format',
              'field' => 'slug',
              'terms' => array(
                'post-format-aside',
                'post-format-audio',
                'post-format-chat',
                'post-format-gallery',
                'post-format-image',
                'post-format-link',
                'post-format-quote',
                'post-format-status',
                'post-format-video'
              ),
              'orderby' => "date",
              'order' => 'DESC',
              'operator' => 'NOT IN'
            )
          )
        ));
        if ($query->have_posts()) {
          while ($query->have_posts()) {
            $query->the_post();
            echo '<li class="splide__slide">';
            get_template_part('template-parts/content', get_post_format() ? get_post_format() : "standard");
            echo '</li>';
          }
          wp_reset_postdata();
        }
        ?>
      </ul>
    </div>
  </section>
  <section class="about-section flex ai-center revealable">
    <div class="about-img flex jc-center">
      <?php
      $page = get_page_by_path('about');
      $thumbnail_id = get_post_thumbnail_id($page);
      $thumbnail_src = get_the_post_thumbnail_url($page) ? get_the_post_thumbnail_url($page) : get_template_directory_uri() . "/images/placeholder.svg";
      $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) == "" ? get_the_title() : get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
      ?>
      <img src="<?php echo $thumbnail_src; ?>" alt="<?php echo $thumbnail_alt; ?>">
    </div>
    <!-- Display about page as a widget-->
    <?php
    if ($page) {
      echo '<div class="about-text flex column">';
      echo '<h1 class="main-title"> ' . $page->post_title . '</h1>';
      echo '<p>' . $page->post_content . '</p>';
      echo '<a class="button-container button-48" href=' . get_permalink($page) . '>
      <div class="button-face yellow-button text-button">
        <div class="button-text">بیشتر بخوانید</div>
        <div class="button-glow"></div>
        <div class="button-hover"></div>
      </div>
    </a>';
      echo '</div>';
    }
    ?>
  </section>
</main>
<footer class="footer max-width">
  طراحی و توسعه با 🍰 به‌دست
  <a class="prevent-default" href="https://cilver.net" target="_blank">ادیب</a>
  و
  <a class="prevent-default" href="https://edrisranjbar.ir" target="_blank">ادریس</a>
</footer>
<script src="<?php echo get_template_directory_uri(); ?>/scripts/splide.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/scripts/sliders.js"></script>
<?php get_footer(); ?>