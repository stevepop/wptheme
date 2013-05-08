<?php
//
//  Custom Child Theme Functions
//

function wicked_footer_pagelinks() {
    echo '<ul id="simplepages">';
    wp_list_pages('depth=1&sort_column=menu_order&title_li=');
    echo '</ul>';
}

function wicked_favicon() {
    echo '<link rel="shortcut icon" href="'
        . get_bloginfo('stylesheet_directory')
        . '/images/favicon.ico"/>';
}
add_action('wp_head', 'wicked_favicon');

// Add social media links
function wicked_linklove($content) {
    if(is_single()) {
        $content .= '<div class="linklove">
        Did you love this post? Tell everyone you know, right now!
        <!-- AddThis Button BEGIN -->
        <div class="addthis_toolbox addthis_default_style ">
        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
        <a class="addthis_button_tweet"></a>
        <a class="addthis_button_pinterest_pinit"></a>
        <a class="addthis_counter addthis_pill_style"></a>
        </div>
        <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4dcd378b3ab75319"></script>
        <!-- AddThis Button END -->
    </div>';
    }
    return $content;
}

add_filter('thematic_post','wicked_linklove', 90);
?>
