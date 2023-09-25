<?php
/**
 * Genesis Sample.
 *
 * This file adds the default theme settings to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

add_filter( 'simple_social_default_styles', 'genesis_sample_social_default_styles' );
/**
 * Set Simple Social Icon defaults.
 *
 * @since 1.0.0
 *
 * @param array $defaults Social style defaults.
 * @return array Modified social style defaults.
 */
function genesis_sample_social_default_styles( $defaults ) {

	$args = genesis_get_config( 'simple-social-icons-settings' );

	return wp_parse_args( $args, $defaults );

}

remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
remove_action( 'genesis_header', 'genesis_do_header' );
//add in the new header markup - prefix the function name - here sm_ is used
add_action( 'genesis_header', 'sm_genesis_header_markup_open', 5 );
add_action( 'genesis_header', 'sm_genesis_header_markup_close', 15 );
add_action( 'genesis_header', 'sm_genesis_do_header' );
//New Header functions
function sm_genesis_header_markup_open() {
	genesis_markup( array(
		'html5'   => '<header %s>',
		'context' => 'site-header',
	) );
	// Added in content
	echo '<div class="header-ghost"></div>';
	genesis_structural_wrap( 'header' );
}
function sm_genesis_header_markup_close() {
	genesis_structural_wrap( 'header', 'close' );
	genesis_markup( array(
		'close'   => '</header>',
		'context' => 'site-header',
	) );
}
function sm_genesis_do_header() {
	global $wp_registered_sidebars;

	if ( ( is_page( 'home' )) ) {
		genesis_markup( array(
			'open'    => '<div %s>' . genesis_sidebar_title( 'header-right' ),
			'context' => 'header-widget-area',
		) );
			do_action( 'genesis_header_right' );
			add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
			dynamic_sidebar( 'header-right' );
			remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
		genesis_markup( array(
			'close'   => '</div>',
			'context' => 'header-widget-area',
		) );
	} else {

	}
}

// For all pages


 remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

 add_action( "genesis_after_header", 'before_page_add', 0 );
 function before_page_add() {
	 if(!is_page('home') && !is_page('blog') && is_page()):
		 	$tagline = get_field('page_tagline');
         	?>
         <section class="hero-page">
                 <h1 class="title-center-page">
                 <?php echo get_the_title(); ?>
                 </h1>
                 <?php echo $tagline;?>
         </section>
         <?php

     ?>
         <div class="body-page-content">


     <!-- Big Spinner -->
     <div class="main-spinner">
        <div class="main-spinner-content">
            <img class="main-spinner1" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-1.png" alt="">
            <img class="main-spinner2 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-2.png" alt="">
            <img class="main-spinner3 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-3.png" alt="">
            <img class="main-spinner4 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-4.png" alt="">
            <img class="main-spinner5 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner-5.png" alt="">
        </div>
     </div>
       <!-- End Big Spinner -->

     <div class="second-spinner" data-sr-id="12" style="; visibility: visible;  -webkit-transform: scale(1); opacity: 1;transform: scale(1); opacity: 1;-webkit-transition: -webkit-transform 0.5s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 0.5s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; transition: transform 0.5s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 0.5s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; ">
         <div class="second-spinner-content">
             <img class="second-spinner1" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-1@2x.png" alt="">
             <img class="second-spinner2 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-2@2x.png" alt="">
             <img class="second-spinne3 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-3@2x.png" alt="">
             <img class="second-spinne4 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-4@2x.png" alt="">
             <img class="second-spinne5 animated" src="<?php echo get_stylesheet_directory_uri();?>/images/spinner2-5@2x.png" alt="">
         </div>
     </div>
    <?php
	endif;
 }


 add_action( "genesis_before_footer", 'after_page_add' );
 function after_page_add() {
 if(!is_page('home') && !is_page('blog') && is_page()):
     ?>
      </div>
    <?php
endif;
 }



// Register Custom Post Type
function custom_post_type_episodes() {

    $labels = array(
        'name'                => _x( 'Espisodes', 'Post Type General Name', 'health' ),
        'singular_name'       => _x( 'Podcast', 'Post Type Singular Name', 'health' ),
        'menu_name'           => __( 'Podcast', 'health' ),
        'parent_item_colon'   => __( 'Parent Item:', 'health' ),
        'all_items'           => __( 'All Items', 'health' ),
        'view_item'           => __( 'View Item', 'health' ),
        'add_new_item'        => __( 'Add New Item', 'health' ),
        'add_new'             => __( 'Add New', 'health' ),
        'edit_item'           => __( 'Edit Item', 'health' ),
        'update_item'         => __( 'Update Item', 'health' ),
        'search_items'        => __( 'Search Item', 'health' ),
        'not_found'           => __( 'Not found', 'health' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'health' ),
    );
    $args = array(
        'label'               => __( 'Podcast', 'health' ),
        'description'         => __( 'podcast CPT', 'health' ),
        'labels'              => $labels,
        'supports'            => array('title','editor','thumbnail','excerpt' ),
        'taxonomies'          => array( ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-playlist-video',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'episode', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_episodes', 0 );
