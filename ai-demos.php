<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://devsgram.com
 * @since             1.0.0
 * @package           Ai_Demos
 *
 * @wordpress-plugin
 * Plugin Name:       AI Demos
 * Plugin URI:        https://devsgram.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Saroar Hossain
 * Author URI:        https://devsgram.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ai-demos
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'AI_DEMOS_VERSION', '1.0.0' );


add_action('wp_enqueue_scripts', 'ai_demos_add_scripts');
function ai_demos_add_scripts(){

    wp_enqueue_style( 'aidemo-styles',  plugin_dir_url( __FILE__ ) . 'assets/css/ai-demos.css' );

	wp_enqueue_script('aidemos-isotop', '//npmcdn.com/isotope-layout@3/dist/isotope.pkgd.js', array('jquery'), false, true);
	wp_enqueue_script('aidemos-scripts', plugin_dir_url( __FILE__ ) . 'assets/js/ai-demo-scripts.js', array('jquery'), false, true);
}



// Register Custom Post Type AI Demo
function create_aidemo_cpt() {

	$labels = array(
		'name' => _x( 'AI Demos', 'Post Type General Name', 'ai-demos' ),
		'singular_name' => _x( 'AI Demo', 'Post Type Singular Name', 'ai-demos' ),
		'menu_name' => _x( 'AI Demos', 'Admin Menu text', 'ai-demos' ),
		'name_admin_bar' => _x( 'AI Demo', 'Add New on Toolbar', 'ai-demos' ),
		'archives' => __( 'AI Demo Archives', 'ai-demos' ),
		'attributes' => __( 'AI Demo Attributes', 'ai-demos' ),
		'parent_item_colon' => __( 'Parent AI Demo:', 'ai-demos' ),
		'all_items' => __( 'All AI Demos', 'ai-demos' ),
		'add_new_item' => __( 'Add New AI Demo', 'ai-demos' ),
		'add_new' => __( 'Add New', 'ai-demos' ),
		'new_item' => __( 'New AI Demo', 'ai-demos' ),
		'edit_item' => __( 'Edit AI Demo', 'ai-demos' ),
		'update_item' => __( 'Update AI Demo', 'ai-demos' ),
		'view_item' => __( 'View AI Demo', 'ai-demos' ),
		'view_items' => __( 'View AI Demos', 'ai-demos' ),
		'search_items' => __( 'Search AI Demo', 'ai-demos' ),
		'not_found' => __( 'Not found', 'ai-demos' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'ai-demos' ),
		'featured_image' => __( 'Featured Image', 'ai-demos' ),
		'set_featured_image' => __( 'Set featured image', 'ai-demos' ),
		'remove_featured_image' => __( 'Remove featured image', 'ai-demos' ),
		'use_featured_image' => __( 'Use as featured image', 'ai-demos' ),
		'insert_into_item' => __( 'Insert into AI Demo', 'ai-demos' ),
		'uploaded_to_this_item' => __( 'Uploaded to this AI Demo', 'ai-demos' ),
		'items_list' => __( 'AI Demos list', 'ai-demos' ),
		'items_list_navigation' => __( 'AI Demos list navigation', 'ai-demos' ),
		'filter_items_list' => __( 'Filter AI Demos list', 'ai-demos' ),
	);
	$args = array(
		'label' => __( 'AI Demo', 'ai-demos' ),
		'description' => __( 'All the AI demos', 'ai-demos' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-feedback',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'aidemo', $args );



	$labels = array(
		'name'              => _x( 'Category', 'taxonomy general name', 'ai-demos' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'ai-demos' ),
		'search_items'      => __( 'Search Categorie', 'ai-demos' ),
		'all_items'         => __( 'All Categorie', 'ai-demos' ),
		'parent_item'       => __( 'Parent Category', 'ai-demos' ),
		'parent_item_colon' => __( 'Parent Category:', 'ai-demos' ),
		'edit_item'         => __( 'Edit Category', 'ai-demos' ),
		'update_item'       => __( 'Update Category', 'ai-demos' ),
		'add_new_item'      => __( 'Add New Category', 'ai-demos' ),
		'new_item_name'     => __( 'New Category Name', 'ai-demos' ),
		'menu_name'         => __( 'Category', 'ai-demos' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( 'Mention your Category', 'ai-demos' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
	);
	register_taxonomy( 'ai_category', array('aidemo'), $args );



	$labels = array(
		'name'              => _x( 'Tag', 'taxonomy general name', 'ai-demos' ),
		'singular_name'     => _x( 'Tag', 'taxonomy singular name', 'ai-demos' ),
		'search_items'      => __( 'Search Tag', 'ai-demos' ),
		'all_items'         => __( 'All Tags', 'ai-demos' ),
		'parent_item'       => __( 'Parent Tag', 'ai-demos' ),
		'parent_item_colon' => __( 'Parent Tag:', 'ai-demos' ),
		'edit_item'         => __( 'Edit Tag', 'ai-demos' ),
		'update_item'       => __( 'Update Tag', 'ai-demos' ),
		'add_new_item'      => __( 'Add New Tag', 'ai-demos' ),
		'new_item_name'     => __( 'New Tag Name', 'ai-demos' ),
		'menu_name'         => __( 'Tag', 'ai-demos' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( 'Mention your Tags', 'ai-demos' ),
		'hierarchical' => false,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
	);
	register_taxonomy( 'ai_tag', array('aidemo'), $args );

}
add_action( 'init', 'create_aidemo_cpt', 0 );



function aidemos_shortcode_func( $atts ){

	$output = '';
	$output .= '<div class="aidemos_container">';


		$output .= '<div class="aidemos_filters">';

			$output .= '<button id="aidemos_reset_filer">Reset Filter</button>';

			$output .= '<div class="aidemos_filter_item aidemos_filter_by_category">';
				$output .= '<h3>Filter By Category</h3>';

				$categories = get_terms( 'ai_category', array(
					'hide_empty' => false,
				) );

				$output .= '<ul class="ai_filter_list ai_category_filters" data-filter-group="ai_category">';
				foreach($categories as $category){
					$output .= '<li class="filter_button" data-filter=".'. $category->slug .'"><a href="#">'. $category->name .'</a></li>';
				}
				$output .= '</ul>';
			$output .= '</div>';



			$output .= '<div class="aidemos_filter_item aidemos_filter_by_tags">';
				$output .= '<h3>Filter By Tags</h3>';

				$tags = get_terms( 'ai_tag', array(
					'hide_empty' => false,
				) );

				$output .= '<ul class="ai_filter_list ai_category_filters" data-filter-group="ai_tag">';
				foreach($tags as $tag){
					$output .= '<li class="filter_button" data-filter=".'. $tag->slug .'"><a href="#">'. $tag->name .'</a></li>';
				}
				$output .= '</ul>';
			$output .= '</div>';
		
		$output .= '</div>';


	$args = array(
		'post_type' => 'aidemo',
		'posts_per_page' => -1,
		'post_status' => 'publish'
	);
	$loop = new WP_Query($args);

	if($loop->have_posts()){
		$output .= '<div id="ai_demos_wrapper">';
		while($loop->have_posts()){
			$loop->the_post();

			$categories_obj = get_the_terms( get_the_ID(), 'ai_category' );
			$categories_string = join(' ', wp_list_pluck($categories_obj, 'slug'));

			$tags_obj = get_the_terms( get_the_ID(), 'ai_tag' );
			$tags_string = join(' ', wp_list_pluck($tags_obj, 'slug'));

			$output .= '<div class="ai_demos_item '. $categories_string .' '. $tags_string .'">';
				$output .= '<div class="ai_demo_thumb">'. get_the_post_thumbnail() .'</div>';
				$output .= '<div class="ai_demos_post_content">';
					$output .= '<h3>'. get_the_title() .'</h3>';
				$output .= '</div>';
				$output .= '<div class="ai_demo_content_hover">';
					$output .= '<h3>'. get_the_title() .'</h3>';
					$output .= '<p>'. get_the_excerpt() .'</p>';
					$output .= '<a class="ai_demo_readmore" href="'. get_the_permalink() .'">Read More</a>';
				$output .= '</div>';
			$output .= '</div>';
		}
		wp_reset_query();
		$output .= '</div>';
	} 

	$output .= '</div>';

	return $output;
}
add_shortcode( 'aidemos', 'aidemos_shortcode_func' );
