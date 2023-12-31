<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
require_once(ABSPATH . 'wp-admin/includes/media.php');
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
    $actual_link = strtok($actual_link, "?");
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

function get_media_duration($cached_durations, string $url)
{
    if (array_key_exists($url, $cached_durations)) {
        return $cached_durations[$url]['duration'];
    } else {
        $metadata = wp_read_audio_metadata(ContentUrlToLocalPath($url));
        return $metadata == false ? "0:00" : $metadata['length_formatted'];
    }
    return "0:00";
}

function ContentUrlToLocalPath(string $url)
{
    preg_match('/.*(\/wp\-content\/uploads\/\d+\/\d+\/.*)/', $url, $mat);
    if (count($mat) > 0) return ABSPATH . $mat[1];
    return '';
}

// update media meatadata using a call to the dl.sammakqoran.com
add_action('publish_post', 'call_the_endpoint', 10, 2);
function call_the_endpoint($post_id, $post)
{
    $post_type = $post->post_type;
    $content = $post->post_content;
    $src  = [];
    if ($post_type == 'video') {
        preg_match_all('/(src)=("[^"]*")/i', $content, $src);
        if (count($src[2]) > 0) {
            $src = (str_replace('"', '', $src[2][0]));
        } else {
            $src = "";
        }
    } else if ($post_type == 'audio') {
        preg_match_all('/(src)=("[^"]*")/i', $content, $src);
        if (count($src[2]) > 0) {
            $src = (str_replace('"', '', $src[2][0]));
        } else {
            $src = "";
        }
    }
    $url = "https://dl.sammakqoran.com/";
    $url .= $src === "" ? $src : "";
    wp_remote_request($url, ['method' => 'GET']);
}


function get_theme_version()
{
    return wp_get_theme()->get('Version');
}

function get_cat_list_in_order($category = null)
{
    if (is_null($category)) {
        $args = ['parent' => 0, 'hide_empty' => true];
    } else {
        // get subcategories
        $args = ['parent' => $category, 'hide_empty' => true];
    }
    $cats = get_categories($args);
    $cat_list = [];
    /* get recent post from each category */
    foreach ($cats as $cat) :
        $args = array(
            'numberposts' => 1,
            'category' => $cat->term_id,
        );
        $recent_posts = wp_get_recent_posts($args);
        /* category list */
        $cat_list[] = array(
            'id' => $cat->term_id,
            'name' => $cat->name,
            'post_date' => $recent_posts[0]['post_date']
        );
    endforeach;

    /* sort $cat_list on basis of resent publish post */
    function sortFunction($a, $b)
    {
        return strtotime($a["post_date"]) - strtotime($b["post_date"]) > 1 ? -1 : 1;
    }
    if (is_array($cat_list) && count($cat_list) > 0) {
        usort($cat_list, "sortFunction");
    }
    return $cat_list;
}

function display_pagination($query, $pageNumber)
{
    if ($query->max_num_pages == 1) {
        return;
    }
    $output = "";
    $output .= '<section class="view-more-container flex jc-center">';
    if ($pageNumber != 1) {
        $output .= '<button class="button-container button-48" onclick="goToPrevPage()">
        <div class="button-face green-button text-button">
            <div class="button-text">صفحۀ قبل</div>
            <div class="button-glow"></div>
            <div class="button-hover"></div>
        </div>
        </button>';
    }
    $output .= '<select name="pageNumber" class="pagination" onchange="goToSelectedPage(this)">';
    $pages_count = $query->max_num_pages;
    for ($i = 1; $i <= $pages_count; $i++) {
        $selected = $i == $pageNumber ? 'selected' : '';
        $output .= '<option value="' . $i . "\" $selected >$i</option>";
    }
    $output .= '</select>';
    if ($pageNumber != $query->max_num_pages) {
        $output .= '<button class="button-container button-48" onclick="goToNextPage()">
        <div class="button-face yellow-button text-button">
            <div class="button-text">صفحۀ بعد</div>
            <div class="button-glow"></div>
            <div class="button-hover"></div>
        </div>
        </button>';
    }
    $output .= '</section>';
    echo $output;
}

// Add video shortcode
function videoPlayerShortCode($atts, $content=null){
    return "[" . do_shortcode($content) . "]";
}
add_shortcode('videos', 'videoPlayerShortCode');

function videoShortCode($atts){
    return '{
		"src": "'.$atts['src'].'",
		"quality": "'.$atts['quality'].'"
	},';
}
add_shortcode('video', 'videoShortCode');