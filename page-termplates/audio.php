<?php /*
    Template Name: صفحه صدا ها
*/
get_header();

$order = $_GET['order'] ?? 'DESC';
$pageNumber = max($_GET['pageNumber'] ?? 1, 1);
$categories = $_GET['category'] ?? [];
global $query;
$query = new WP_Query(array(
    'order' => $order,
    'category__in' => $categories,
    'paged' => $pageNumber,
    'tax_query' => array(
        [
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => ['post-format-audio'],
        ]
    )
));
if ($query->have_posts()) {

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
        <?php get_template_part("template-parts/filters", args: ['hide_category_filter_options' => false]); ?>
        <section class="posts-grid">
            <?php
            $counter = 0;
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/content', get_post_format(), args: ['counter' => ++$counter]);
            }

            wp_reset_postdata();
            ?>
        </section>
    <?php
    display_pagination($query, $pageNumber);
} else {
    get_template_part('template-parts/empty-state', args: ['title' => 'درحال حاضر صدایی وجود ندارد']);
}
    ?>
    </main>

    <?php echo get_footer(); ?>