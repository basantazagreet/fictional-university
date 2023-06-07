<?php
function university_post_types()
{
    register_post_type(
        'event',
        array(
            'public' => true,
            'show_in_rest' => true,
            'supports' => array('title', 'excerpt', 'editor', 'custom-fields'),
            'has_archive' => true,
            'rewrite' => array(
                'slug' => 'events',
            ),
            'labels' => array(
                'name' => 'Events',
                'add_new_item' => 'Add New Event',
                'edit_item' => 'Edit Event',
                'all_items' => 'All Events',
                'singular_name' => 'Event'
            ),
            'menu_icon' => 'dashicons-calendar',
        )
    );
    register_post_type('Program', array(
        'supports' => array('title', 'excerpt', 'editor', 'custom-fields'),
        'menu_icon' => 'dashicons-awards',
        'has_archive' => true,
        'show_in_rest' => true,
        'rewrite' => array(
            'slug' => 'programs'
        ),
        'public' => true,
        'labels' => array(
            'name' => 'Programs',
            'plural_name' => 'Programs',
            'add_new_item' => 'Add new Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All programs'
        )

    ));

    register_post_type('Professor', array(
        'supports' => array('title', 'excerpt', 'editor', 'custom-fields', 'thumbnail'),
        'menu_icon' => 'dashicons-welcome-learn-more',
        'has_archive' => true,
        'show_in_rest' => true,
        'rewrite' => array(
            'slug' => 'professors'
        ),
        'public' => true,
        'labels' => array(
            'name' => 'Professors',
            'plural_name' => 'Professors',
            'add_new_item' => 'Add new Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All professors'
        )

    ));

        // Note Post Type
    register_post_type('note', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor'),
        'public' => false,
        'show_ui' => true,
        'labels' => array(
        'name' => 'Notes',
        'add_new_item' => 'Add New Note',
        'edit_item' => 'Edit Note',
        'all_items' => 'All Notes',
        'singular_name' => 'Note'
        ),
        'menu_icon' => 'dashicons-welcome-write-blog'
    ));

    // Like Post Type
  register_post_type('like', array(
    'supports' => array('title'),
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name' => 'Likes',
      'add_new_item' => 'Add New Like',
      'edit_item' => 'Edit Like',
      'all_items' => 'All Likes',
      'singular_name' => 'Like'
    ),
    'menu_icon' => 'dashicons-heart'
  ));
    
}

add_action('init', 'university_post_types');