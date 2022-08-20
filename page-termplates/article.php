<?php /*
    Template Name: صفحه نوشته ها
*/
get_header();
$order = $_GET['order'] ?? 'DESC';
$pageNumber = max($_GET['pageNumber'] ?? 1, 1);
$categories = $_GET['category'] ?? [];
$query = new WP_Query(array(
    'order' => $order,
    'paged' => $pageNumber, 'category__in' => $categories,
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
if ($query->have_posts()) { ?>
    <main class="main flex column ai-center max-width fluid-width">
        <header class="main-header relative">
            <h1 class="main-title">نوشته ها</h1>
            <button class="button-container button-48" onclick="openFilters()">
                <div class="button-face yellow-button text-button">
                    <div class="button-text">فیلترها</div>
                    <div class="button-glow"></div>
                    <div class="button-hover"></div>
                </div>
            </button>
        </header>
        <?php get_template_part("template-parts/filters", args: ['hide_category_filter_options' => false]); ?>
        <section class="posts-grid">
            <?php
            $counter = 0;
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/content', get_post_format() ? get_post_format() : "standard", args: ['counter' => ++$counter]);
            }
            wp_reset_postdata();

            ?>
        </section>
    <?php
    display_pagination($query, $pageNumber);
} else {
    get_template_part('template-parts/empty-state', args: ['title' => 'درحال حاضر نوشته ای وجود ندارد']);
}   ?>
    </main>

    <?php echo get_footer(); ?>