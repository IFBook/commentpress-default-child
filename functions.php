<?php /*
===============================================================
Commentpress Child Theme Functions
===============================================================
AUTHOR			: Christian Wach <needle@haystack.co.uk>
LAST MODIFIED	: 31/08/2012
---------------------------------------------------------------
NOTES

Example theme amendments and overrides.

---------------------------------------------------------------
*/




/** 
 * @description: add to the Commentpress setup function 'cp_setup'
 * @todo: 
 *
 */
function cpchild_setup( 
	
) { //-->

	/** 
	 * Make theme available for translation.
	 * Translations can be added to the /languages/ directory of the child theme.
	 * If you're building a theme based on this as a "starter pack", use a find and replace
	 * to change 'commentpress-child-theme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 
	
		'commentpress-child-theme', 
		get_stylesheet_directory() . '/languages' 
		
	);

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

}

// add after theme setup hook
add_action( 'after_setup_theme', 'cpchild_setup' );






/** 
 * @description: override default setting for comment registration
 * @todo: 
 *
 */
function cpchild_sidebar_tab_order( $order ) {
	
	// ignore what's sent to us and set our own order here
	$cpuea_order = array( 'contents', 'activity', 'comments' );
	
	// --<
	return $cpuea_order;

}

// add a filter for the above
add_filter( 'cp_sidebar_tab_order', 'cpchild_sidebar_tab_order', 21, 1 );







/** 
 * @description: override the title of the "Recent Comments in..." link
 * @todo: 
 *
 */
function cpchild_activity_tab_recent_title_blog( $title ) {

	// if groupblog...
	global $commentpress_obj;
	if ( 
	
		!is_null( $commentpress_obj ) 
		AND is_object( $commentpress_obj ) 
		AND $commentpress_obj->is_groupblog() 
		
	) { 
	
		// override default link name for a Group Blog context
		return __( 'Recent Comments in this Blog', 'commentpress-child-theme' );
		
	}
	
	// if main site...
	if ( is_multisite() AND is_main_site() ) { 
	
		// override default link name for the main site of a Multisite context
		return __( 'Recent Comments on Main Site', 'commentpress-child-theme' );
		
	} else {
	
		// override default link name for a Single Install context
		return __( 'Recent Comments on this Site', 'commentpress-child-theme' );
		
	}
	
	
	
	// --<
	return $title;

}

// add a filter for the above
add_filter( 'cp_activity_tab_recent_title_blog', 'cpchild_activity_tab_recent_title_blog', 21, 1 );






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
	
	// add Commentpress Theme css file
	//wp_enqueue_style( 'cpchild_parent_css', get_template_directory_uri() . '/style.css' );

	// add child theme's css file
	wp_enqueue_style( 
	
		'cpchild_css', 
		get_stylesheet_directory_uri() . '/assets/css/style-overrides'.$dev.'.css' 
		
	);

}

// add a filter for the above
add_filter( 'wp_enqueue_scripts', 'cpchild_enqueue_styles', 50 );





?>