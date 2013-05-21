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

function wicked_showbio($content)  {
    if (is_single()) {
        $content .=  '<div id="authorbio">';
        $content .= '<h3>About ' . get_the_author() . '</h3>';
        $content .= '<p>' . get_avatar(get_the_author_meta("user_email"), "50");
        $content .= get_the_author_meta( 'description' ) .'</p></div>';
    }
    return $content;
}
add_filter('thematic_post','wicked_showbio', '70');

add_theme_support('post-thumbnails');
set_post_thumbnail_size(540, 300, true);
add_image_size('homepage-thumbnail', 300, 200, true);
add_theme_support('thematic_legacy_body_class');
add_theme_support('thematic_legacy_post_class');

function wicked_indexloop()
{
    query_posts("posts_per_page=4");
    $counter = 1;

    if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div id="post-<?php the_ID() ?>" <?php post_class(); ?>">
            <?php thematic_postheader();
            if ($counter == 1 && has_post_thumbnail()) {
                the_post_thumbnail('homepage-thumbnail');
            } ?>
            <div class="entry-content">
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="more"><?php echo more_text() ?></a>
                <?php $counter++; ?>
            </div>
        </div><!-- .post -->
        <?php endwhile; else: ?>
        <h2>Eek</h2>
        <p>There are no posts to show!</p>
        <?php endif;
    wp_reset_query();
}

function wicked_remove_index_insert() {
    unregister_sidebar('index-insert');
}
add_action('init', 'wicked_remove_index_insert', 20);

// Include custom widget areas
include('library/widget-areas.php');
include('widgets/author-data.php');

// include theme options
include('library/options.php');

// include style options
include('library/style-options.php');

?>
