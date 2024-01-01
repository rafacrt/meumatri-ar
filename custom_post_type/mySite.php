<?php
// Register Custom Post Type
function custom_post_type_my_site() {

	$labels = array(
		'name'                  => _x( 'Meu Site', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'MeuSite', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Meu Site', 'text_domain' ),
		'name_admin_bar'        => __( 'Meu Site', 'text_domain' ),
		'archives'              => __( 'MeuSite Archives', 'text_domain' ),
		'attributes'            => __( 'MeuSite Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent MeuSite:', 'text_domain' ),
		'all_items'             => __( 'All Meu Site', 'text_domain' ),
		'add_new_item'          => __( 'Add New Meu Site', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New MeuSite', 'text_domain' ),
		'edit_item'             => __( 'Edit MeuSite', 'text_domain' ),
		'update_item'           => __( 'Update MeuSite', 'text_domain' ),
		'view_item'             => __( 'View MeuSite', 'text_domain' ),
		'view_items'            => __( 'View MeuSite', 'text_domain' ),
		'search_items'          => __( 'Search MeuSite', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'MeuSite list', 'text_domain' ),
		'items_list_navigation' => __( 'MeuSite list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'MeuSite', 'text_domain' ),
		'description'           => __( 'MeuSite Description', 'text_domain' ),
		'labels'                => $labels,
        'supports'              => array( 'title', 'author', 'thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag', 'tipos' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
				'menu_icon' => 'dashicons-book-alt',
				'rewrite' => array('slug' => 'meu-site'),

	);
	register_post_type( 'mySite', $args );

}
add_action( 'init', 'custom_post_type_my_site', 0 );