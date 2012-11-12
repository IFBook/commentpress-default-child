<?php /*
===============================================================
Commentpress Child Theme Functions
===============================================================
AUTHOR: Christian Wach <needle@haystack.co.uk>
---------------------------------------------------------------
NOTES

Example theme amendments and overrides.

---------------------------------------------------------------
*/




/**
 * Set the content width based on the theme's design and stylesheet.
 * This seems to be a WordPress requirement - though rather dumb in the
 * context of our theme, which has a percentage-based default width.
 * I have arbitrarily set it to the apparent content-width when viewing
 * on a 1280px-wide screen.
 */
if ( !isset( $content_width ) ) { $content_width = 586; }





/** 
 * @description: augment the CommentPress Default Theme setup function
 * @todo: 
 *
 */
function cpchild_setup( 
	
) { //-->

	/** 
	 * Make theme available for translation.
	 * Translations can be added to the /languages/ directory of the child theme.
	 */
	load_theme_textdomain( 
	
		'commentpress-child-theme', 
		get_stylesheet_directory() . '/languages' 
		
	);

}

// add after theme setup hook
add_action( 'after_setup_theme', 'cpchild_setup' );






/** 
 * @description: override styles by enqueueing as late as we can
 * @todo:
 *
 */
function cpchild_enqueue_styles() {

	// init
	$dev = '';
	
	// check for dev
	if ( defined( 'SCRIPT_DEBUG' ) AND SCRIPT_DEBUG === true ) {
		$dev = '.dev';
	}
	
	// add child theme's css file
	wp_enqueue_style( 
	
		'cpchild_css', 
		get_stylesheet_directory_uri() . '/assets/css/style-overrides'.$dev.'.css',
		array( 'cp_reset_css' ),
		'1.0', // version
		'all' // media
	
	);

}

// add a filter for the above
add_filter( 'wp_enqueue_scripts', 'cpchild_enqueue_styles', 110 );






/** 
 * @description: override default setting for comment registration
 * @todo: 
 *
 */
function cpchild_sidebar_tab_order( $order ) {
	
	// ignore what's sent to us and set our own order here
	$order = array( 'comments', 'activity', 'contents' );
	
	// --<
	return $order;

}

// uncomment the line below to enable the order defined above
//add_filter( 'cp_sidebar_tab_order', 'cpchild_sidebar_tab_order', 21, 1 );






