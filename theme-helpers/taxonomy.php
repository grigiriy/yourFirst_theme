<?php

//*******************************************************************************//
// Taxonomies
//*******************************************************************************//

/**
 * Taxonomy clinics
 */

 register_taxonomy(
     'child',
     [
         'children',
     ],
     [
         'hierarchical' => false,
         'label' => 'Child',
         'show_ui' => true,
         'query_var' => true,
         'has_archive' => false,
        //  'show_in_graphql' => true,
        //  'show_in_rest'      => true,
        //  'graphql_single_name' => 'course_type',
        //  'graphql_plural_name' => 'course_types',
         'singular_label' => 'Child'
     ]
 );
flush_rewrite_rules(false);