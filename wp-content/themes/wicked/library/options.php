<?php

// Set some theme specific variables for the options panel
$childthemename = "Wicked Theme";
$childshortname = "wt";
$childoptions = array();

function childtheme_options() {
    global $childthemename, $childshortname, $childoptions;

    // Create array to store the Categories to be used in the drop-down select box
    $categories_obj = get_categories('hide_empty=0');
    $categories = array();
    foreach ($categories_obj as $cat) {
        $categories[$cat->cat_ID] = $cat->cat_name;
    }

    $childoptions = array (

        array( "name" => __('Link Color','thematic'),
            "desc" => __('Change the color of links by entering a HEX color number. (e.g.: 003333)','thematic'),
            "id" => "wicked_link_color",
            "std" => "999999",
            "type" => "text"
        ),
        array( "name" => __('Show Header Image','thematic'),
            "desc" => __('Show an image in the header. Replace the header.png file found in the /wicked/images/ folder with your own image, up to 120x100px.','thematic'),
            "id" => "wicked_show_logo",
            "std" => "false",
            "type" => "checkbox"
        ),
        array( "name" => __('Featured Category','thematic'),
            "desc" => __('A category of posts to be featured on the front page.','thematic'),
            "id" => "wicked_feature_cat",
            "std" => $default_cat,
            "type" => "select",
            "options" => $categories
        )
    );
}
add_action('init', 'childtheme_options');

?>