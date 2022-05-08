<?php /*
    Template Name: صفحه صدا ها
*/
get_header();
global $query;
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
?>
<main class="main flex column ai-center max-width fluid-width">
    <header class="main-header relative">
        <h1 class="main-title">صدا ها</h1>
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
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/content', get_post_format());
            }
        }
        wp_reset_postdata();
        ?>
    </section>
    <div class="view-more-container flex jc-center">
        <button class="button-container button-48">
            <div class="button-face yellow-button text-button">
                <div class="button-text">بیشتر</div>
                <div class="button-glow"></div>
                <div class="button-hover"></div>
            </div>
        </button>
    </div>
</main>
<?php echo get_footer(); ?>