<?php
global $wp;
$category_ids = get_terms();
$categories = get_categories(["orderby" => "count", "order" => "DESC"]);
?>
<div id="filtersOverlay">

    <form id="filters" action="" method="GET">
        <h2 class="filters-heading">فیلترها</h2>
        <?php
        if (is_search()) {
            echo "<input type=\"hidden\" name=\"s\" value=\"" . get_query_var('s') . "\">";
        }
        if ($args['hide_category_filter_options'] === false) { ?>
            <h3 class="filters-category">دسته</h3>
        <?php
            foreach ($categories as $category) {
                $category_name = $category->name;
                $category_id = $category->term_id;
                echo '<input type="checkbox" name="category[]" id="cat_' . $category_id . '" value="' . $category_id . '">
        <label class="custom-checkbox" for="cat_' . $category_id . '">
            <div class="checkbox-button">
                <div class="checkbox-icon"></div>
                <div class="checkbox-hover"></div>
            </div>
            <div class="checkbox-text">' . $category_name . '</div>
        </label>';
            }
        }
        ?>

        <h3 class="filters-category">ترتیب</h3>
        <input type="radio" name="order" id="newest_post_option" value="DESC" <?php echo $order == 'DESC' ? 'checked' : ''; ?>>
        <label class="custom-radio" for="newest_post_option">
            <div class="radio-button">
                <div class="radio-icon"></div>
                <div class="radio-hover"></div>
            </div>
            <div class="radio-text">جدیدترین</div>
        </label>
        <input type="radio" name="order" id="oldest_post_option" value="ASC" <?php echo $order == 'ASC' ? 'checked' : ''; ?>>
        <label class="custom-radio" for="oldest_post_option">
            <div class="radio-button">
                <div class="radio-icon"></div>
                <div class="radio-hover"></div>
            </div>
            <div class="radio-text">قدیمی ترین</div>
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