<?php /*
    Template Name: صفحه صدا ها
*/
get_header();
$order = $_GET['order'] ?? 'DESC';
$pageNumber = $_GET['pageNumber'] ?? 1;
global $query;
$query = new WP_Query(array(
    'order' => $order,
    'posts_per_page' => get_option('posts_per_page') * $pageNumber,
    'tax_query' => array(
        array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => ['post-format-audio'],
        )
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
        <?php get_template_part("template-parts/filters"); ?>
        <section class="posts-grid">
            <?php
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/content', get_post_format());
            }

            wp_reset_postdata();
            ?>
        </section>
        <?php if ($query->max_num_pages > 1) { ?>
            <div class="view-more-container flex jc-center">
                <button class="button-container button-48">
                    <div class="button-face yellow-button text-button">
                        <div class="button-text">بیشتر</div>
                        <div class="button-glow"></div>
                        <div class="button-hover"></div>
                    </div>
                </button>
            </div>
    <?php }
    } else {
        get_template_part('template-parts/empty-state', args: ['title' => 'درحال حاضر صدایی وجود ندارد']);
    }
    ?>
    </main>
    <script src="<?php echo get_template_directory_uri(); ?>/scripts/load_more_post.js"></script>
    <?php echo get_footer(); ?>