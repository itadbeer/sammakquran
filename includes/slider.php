<?php
$args = array(
    'public'    => true,
    'label'     => __('اسلایدر ها', 'textdomain'),
    'menu_icon' => 'dashicons-slides',
    'menu_position' => 5,
    'supports'      => array('title', 'thumbnail', 'custom-fields'),
    'labels' => [
        'name'                  => _x('اسلایدر ها', 'Post type general name', 'textdomain'),
        'singular_name'         => _x('اسلایدر', 'Post type singular name', 'textdomain'),
        'menu_name'             => _x('اسلایدر ها', 'Admin Menu text', 'textdomain'),
        'name_admin_bar'        => _x('اسلایدر', 'Add New on Toolbar', 'textdomain'),
        'add_new'               => __('افزودن', 'textdomain'),
        'add_new_item'          => __('افزودن اسلایدر جدید', 'textdomain'),
        'new_item'              => __('اسلایدر جدید', 'textdomain'),
        'edit_item'             => __('ویرایش اسلایدر', 'textdomain'),
        'view_item'             => __('نمایش اسلایدر', 'textdomain'),
        'all_items'             => __('همه اسلایدر ها', 'textdomain'),
        'search_items'          => __('جست و جوی اسلایدر ها', 'textdomain'),
        'parent_item_colon'     => __('اسلایدر های والد:', 'textdomain'),
        'not_found'             => __('اسلایدری یافت نشد!', 'textdomain'),
        'not_found_in_trash'    => __('اسلایدری در سطل زباله یافت نشد!', 'textdomain'),
        'featured_image'        => _x('تصویر کاور اسلایدر', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
        'set_featured_image'    => _x('تنظیم تصویر اسلایدر', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'remove_featured_image' => _x('حذف کاور اسلایدر', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'use_featured_image'    => _x('استفاده از یک تصویر برای اسلایدر', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'archives'              => _x('بایگانی اسلایدر ها', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
        'filter_items_list'     => _x('فیلتر لیست اسلایدر ها', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain'),
        'items_list'            => _x('لیست اسلایدر ها', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain'),
    ],
);
register_post_type('sliders', $args);

function sliders_custom_field($post_id)
{
    $post_type = get_post_type($post_id);
    $meta_value = '#';
    $meta_name = 'slider_link';
    if ($post_type === 'sliders') {
        add_post_meta($post_id, $meta_name, $meta_value, true);
    }
    return $post_type;
}
add_action('wp_insert_post', 'sliders_custom_field');
