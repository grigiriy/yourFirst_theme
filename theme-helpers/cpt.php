<?php

// Our custom post type function
function create_posttype() {
 
    register_post_type( 'memories',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Memory' ),
                'singular_name' => __( 'Memory' )
            ),
            'public' => true,
            'hierarchical' => true,
            'has_archive' => true,
            // 'rewrite' => array('slug' => 'lessons'),
            // 'show_in_rest' => true,
            // 'show_in_graphql' => true,
            // 'graphql_single_name' => 'Memory',
            // 'graphql_plural_name' => 'Memories',
            'supports' => array(
                'page-attributes',
                'author',
                'editor',
                'title',
                'thumbnail',
                'excerpt'
                )
 
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );