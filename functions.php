<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Add theme supports
function SammakQuran_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'SammakQuran_theme_support');

// footer widgets
function SammakQuran_footer_widgets()
{
    register_sidebar(array(
        'name' => __('درباره سماک قران', 'SammakQuran'),
        'id' => 'sammak-quran-about',
        'description' => __('اینجا متنی درباره سماک قران بنویسید', 'SammakQuran'),
        'before_widget' => '<div class="about-text flex column">',
        'after_widget' => '</div>',
    ));
}
add_action('widgets_init', 'SammakQuran_footer_widgets');

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
        'rewrite' => array('slug' => 'playlist'),
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
function add_tax_field_oncreate($term)
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
    global $taxonomyName;
    $termMeta = get_option($taxonomyName . '_' . $termID);
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
    global $taxonomyName;
    if (isset($_POST['playlist_type'])) {
        $termMeta = get_option($taxonomyName . '_' . $termID);
        if (!is_array($termMeta))
            $termMeta = array();
        $termMeta['playlist_type'] = isset($_POST['playlist_type']) ? $_POST['playlist_type'] : '';
        update_option($taxonomyName . '_' . $termID, $termMeta);
    }
}
add_action($taxonomyName . '_add_form_fields', 'add_tax_field_oncreate');
add_action($taxonomyName . '_edit_form_fields', 'add_tax_field_onedit');
add_action("create_$taxonomyName", "save_custom_tax_field");
add_action("edited_$taxonomyName", "save_custom_tax_field");
