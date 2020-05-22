<?php
class Wiki_Post_Type{
	
	
	public function __construct() {
		
		add_action( 'init', array( &$this, 'init' ) );
	}
	

public function init() {
	
	$labels = array(
	'name' 					=> 'Wiki',
	'singular_name' 		=> 'Wiki Question',
	'add_new' 				=> 'Add Wiki Question',
	'add_new_item' 			=> 'Add New Wiki Question',
	'edit_item' 			=> 'Edit Wiki Question',
	'new_item' 				=> 'Add New Question',
	'view_item'				=> 'View Item',
	'search_items' 			=> 'Search Wiki',
	'not_found' 			=> 'No wiki items found',
	'not_found_in_trash' 	=> 'No wiki items found in trash',
	);

	$args = array(
	'labels' 				=> $labels,
	'public' 				=> true,
	'menu_icon'             => plugins_url('/wiki/images/wiki.png'),
	'publicly_queryable'    => true,
	'show_ui'               => true,
	'query_var'             => true,
	'permalink_epmask'      => true,
	'supports' 				=> array( 'title','editor','page-attributes','author' ),
	'rewrite'               => array( 'slug' => 'wiki', 'with_front' => false ),
	'menu_position' 		=> 5,
	'show_in_menu'          => true,
	'has_archive' 			=> true

	);
	
	register_post_type( 'wiki', $args);
	
	$labels = array(
	'name'                          => 'Categories',
	'singular_name'                 => 'Category',
	'search_items'                  => 'Search Categories',
	'popular_items'                 => 'Popular Categories',
	'all_items'                     => 'All Categories',
	'parent_item'                   => 'Parent Category',
	'edit_item'                     => 'Edit Category',
	'update_item'                   => 'Update Category',
	'add_new_item'                  => 'Add New Category',
	'new_item_name'                 => 'New Category',
	'separate_items_with_commas'    => 'Separate Categories with commas',
	'add_or_remove_items'           => 'Add or remove Categories',
	'choose_from_most_used'         => 'Choose from most used Categories',
	);

	$args = array(
	'label'                         => 'Categories',
	'labels'                        => $labels,
	'public'                        => true,
	'hierarchical'                  => true,
	'show_ui'                       => true,
	'show_in_nav_menus'             => true,
	'args'                          => array( 'orderby' => 'term_order' ),
	'rewrite'                       => array( 'slug' => 'wiki_cat', 'with_front' => false ),
	'query_var'                     => true
	);

	register_taxonomy( 'wiki_cat', 'wiki', $args );
	
	
}
	
}

$GLOBALS['wiki_post_type'] = new Wiki_Post_Type();
