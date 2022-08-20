<?php
get_header();

$orderby_allowed_list = ['modified', 'date'];
$orderby = "modified";
if (isset($_GET['orderby']) && in_array($_GET['orderby'], $orderby_allowed_list)) {
    $orderby = $_GET['orderby'];
}
global $query_string;
global $query;
$pageNumber = max($_GET['pageNumber'] ?? 1, 1);
$s = get_query_var('s');
$args = [
    "s"             => $s,
    'paged' => $pageNumber,
    "post_type"     => "post",
    "post_status"   => "publish",
    "orderby"       => $orderby
];
$query = new WP_Query($args);
?>
<?php if ($query->have_posts()) { ?>
    <main class="main flex column ai-center max-width fluid-width">
        <header class="main-header relative">
            <h1 class="main-title"><?php echo get_search_query(); ?></h1>
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
        ?>
    </main>
<?php } else {
    get_template_part('template-parts/empty-state', args: ['title' => 'درحال حاضر محتوایی وجود ندارد']);
}
?>
<?php get_footer(); ?>