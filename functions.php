<?php
if (!function_exists('eventre_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @since Twenty Fifteen 1.0
     */
    function eventre_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on eventre, use a find and replace
         * to change 'eventre' to the name of your theme in all the template files
         */
        load_theme_textdomain('eventre', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded  tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary' => __('Primary Menu',      'eventre'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
        ));

        // Setup the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('eventre_custom_background_args', array(
            'default-color'      => '#000',
            'default-attachment' => 'fixed',
        )));
    }
} // eventre_setup
add_action('after_setup_theme', 'eventre_setup');

/**
 * Assets
 */
if (!function_exists('eventre_assets')) {
    function eventre_assets() {
        wp_enqueue_style('event-style', get_stylesheet_uri());
    }
}
add_action('wp_enqueue_scripts', 'eventre_assets');

/**
 * Register CPT & Taxonomy
 */
if (!function_exists('eventre_custom_posts')) {
    function eventre_custom_posts() {
        register_post_type('sponsor', array(
            'labels'    =>  array(
                'name'          =>  __('Sponsors', 'eventre'),
                'singular_name' =>  __('Sponsor', 'eventre'),
                'add_new_item'  =>  __('Add Sponsor', 'eventre')
            ),
            'public'    =>  false,
            'show_ui'   =>  true,
            'supports'  => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
        ));

        register_post_type('speaker', array(
            'labels'    =>  array(
                'name'          =>  __('Speakers', 'eventre'),
                'singular_name' =>  __('Speaker', 'eventre'),
                'add_new_item'  =>  __('Add Speaker', 'eventre')
            ),
            'public'    =>  true,
            'show_ui'   =>  true,
            'supports'  => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
        ));

        register_post_type('person', array(
            'labels'    =>  array(
                'name'          =>  __('Persons', 'eventre'),
                'singular_name' =>  __('Person', 'eventre'),
                'add_new_item'  =>  __('Add Person', 'eventre')
            ),
            'public'    =>  false,
            'show_ui'   =>  true,
            'supports'  => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
        ));

        register_post_type('schedule', array(
            'labels'    =>  array(
                'name'          =>  __('Schedules', 'eventre'),
                'singular_name' =>  __('Schedule', 'eventre'),
                'add_new_item'  =>  __('Add Schedule', 'eventre')
            ),
            'public'    =>  true,
            'show_ui'   =>  true,
            'supports'  => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
        ));

        register_taxonomy('sponsor_cat', 'sponsor', array(
            'label'             =>  __('Sponsor Category', 'eventre'),
            'hierarchical'      =>  true,
            'query_var'         =>  true,
            'show_admin_column' =>  true,
            'rewrite'           =>  array(
                'slug'          =>  'sponsor-category',
                'with_front'    =>  true
            )
        ));
    }
}
add_action('init', 'eventre_custom_posts');
