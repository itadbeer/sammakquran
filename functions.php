<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
require_once('includes/slider.php');

// Add theme supports
function SammakQuran_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'SammakQuran_theme_support');

add_theme_support('post-formats', array('video', 'audio'));

$labels = [
    'name' => _x('مجموعه ها', 'taxonomy general name'),
    'singular_name' => _x('مجموعه', 'taxonomy singular name'),
    'search_items' =>  __('جست و جوی مجموعه'),
    'all_items' => __('همه مجموعه ها'),
    'parent_item' => __('مجموعه والد'),
    'parent_item_colon' => __('مجموعه والد:'),
    'edit_item' => __('ویرایش مجموعه'),
    'update_item' => __('به روزرسانی مجموعه'),
    'add_new_item' => __('افزودن مجموعه جدید'),
    'new_item_name' => __('نام مجموعه جدید'),
    'menu_name' => __('مجموعه ها'),
];
register_taxonomy(
    'playlists',
    ['post'],
    [
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'playlists'),
        'show_in_quick_edit' => true,
    ]
);

function how_many_days_ago_updated()
{
    $days = round((date('U') - get_the_time('U')) / (60 * 60 * 24));
    if ($days == 0) {
        return "امروز";
    } elseif ($days == 1) {
        return "دیروز";
    } else {
        return "" . $days . " روز پیش";
    }
}


// Adding custom field to playlists taxonomy
$taxonomyName = "playlists";
function add_tax_field_oncreate()
{
    echo "<div class='form-field'>";
    echo "<label for='playlist_type'>نوع مجموعه </label>";
    echo "<input type='radio' name='playlist_type' value='standard' checked>مقاله ";
    echo "<input type='radio' name='playlist_type' value='audio'> صدا ";
    echo "<input type='radio' name='playlist_type' value='video'> ویدئو ";
    echo "</div>";
}

function add_tax_field_onedit($term)
{
    $termID = $term->term_id;
    $termMeta = get_option($termID);
    $playlist_type = $termMeta['playlist_type'];
    echo "<div class='form-field'>";
    echo "<label for='playlist_type'>نوع مجموعه: </label>";
    echo "<input type='radio' name='playlist_type' value='standard' " . $playlist_type == 'standard' ? ' checked ' : '' . ">مقاله ";
    echo "<input type='radio' name='playlist_type' value='audio' " . $playlist_type == 'audio' ? ' checked ' : '' . "> صدا ";
    echo "<input type='radio' name='playlist_type' value='video' " . $playlist_type == 'video' ? ' checked ' : '' . "> ویدئو ";
    echo "</div>";
}
function save_custom_tax_field($termID)
{
    if (isset($_POST['playlist_type'])) {
        $termMeta = get_option($termID);
        if (!is_array($termMeta))
            $termMeta = [];
        $termMeta['playlist_type'] = isset($_POST['playlist_type']) ? $_POST['playlist_type'] : '';
        update_option($termID, $termMeta);
    }
}
add_action($taxonomyName . '_add_form_fields', 'add_tax_field_oncreate');
add_action($taxonomyName . '_edit_form_fields', 'add_tax_field_onedit');
add_action("create_" . $taxonomyName, "save_custom_tax_field");
add_action("edited_" . $taxonomyName, "save_custom_tax_field");


function SammakQuran_menu()
{
    $locations = [
        'footer' => "منوی پابرگ",
    ];
    register_nav_menus($locations);
}
add_action('init', 'SammakQuran_menu');

function SammakQuran_get_menu_items($menu_name)
{
    $menu_list = "";
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
        $menu = wp_get_nav_menu_object($locations[$menu_name]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        foreach ((array) $menu_items as $key => $menu_item) {
            $title = $menu_item->title;
            $url = $menu_item->url;
            $thumbnail_src = wp_get_attachment_image_src($menu_item->thumbnail_id)[0] ?? get_template_directory_uri() . "/icons/all.svg";
            if ($url ==  $actual_link) {
                $class = " active ";
            } else {
                $class = "";
            }
            $menu_list .= '
            <li class="bottom-nav-item ' . $class . ' ">
                <a class="prevent-default" href="' . $url . '">
                    <img class="bottom-nav-icon" src="' . $thumbnail_src . '">
                    <span class="bottom-nav-label">' . $title . '</span>
                </a>
            </li>';
        }
    }
    return $menu_list;
}

// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
    global $wp_version;
    if ($wp_version !== '4.7.1') {
        return $data;
    }
    $filetype = wp_check_filetype($filename, $mimes);
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4);
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
function fix_svg()
{
    echo '';
}
add_action('admin_head', 'fix_svg');


function strip_tags_content(string $content, $tags = [])
{
    return strip_tags($content, $tags);
}
