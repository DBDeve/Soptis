<?php

    function mytheme_setup() { 
        add_theme_support( 'title-tag' ); 
        add_theme_support( 'automatic-feed-links' ); 
    } 
    add_action( 'after_setup_theme', 'mytheme_setup' );

    add_filter( 'document_title_parts', function( $title ) {

        if ( !is_front_page() && is_singular() ) {
            $post_id = get_queried_object_id();
            $custom_title = get_post_meta( $post_id, '_title_seo', true );

            if ( ! empty( $custom_title ) ) {
                return [ 'title' => $custom_title ];
            }
        } 
        else if ( is_front_page() ) {
            $site_name     = get_bloginfo( 'name' );
            $site_tagline  = get_bloginfo( 'description' );
            $custom_title = "$site_name - $site_tagline";

            return [ 'title' => $custom_title ];

        }

        return $title;
    });


    function mytheme_enqueue_assets() {
        wp_enqueue_style(
            'mytheme-body',
            get_template_directory_uri() . '/css/body.min.css',
            array(),
            '1.0'
        );
        wp_enqueue_style(
            'mytheme-footer',
            get_template_directory_uri() . '/css/footer.min.css',
            array(),
            '1.0'
        );
        wp_enqueue_style(
            'mytheme-header',
            get_template_directory_uri() . '/css/header.min.css',
            array(),
            '1.0'
        );
        wp_enqueue_style(
            'mytheme-font',
            get_template_directory_uri() . '/css/fontAwesome/css/all.min.css',
            array(),
            '1.0'
        );

        wp_enqueue_script(
            'mytheme-script',
            get_template_directory_uri() . '/js/mobileMenu.min.js',
            array(),
            '1.0',
            true
        );
    }
    add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');




    define( 'HEAD', plugin_dir_path( __FILE__ ) );
    require_once HEAD . '/head.php';


    define( 'PAGE_EDIT', plugin_dir_path( __FILE__ ) . '/page_edit' );
    require_once PAGE_EDIT . '/metabox.php';
    require_once PAGE_EDIT . '/remove-title-form.php';
    require_once PAGE_EDIT . '/edit.php';


    define( 'SMI_INCLUDES', plugin_dir_path( __FILE__ ) . '/customize' );
    require_once SMI_INCLUDES . '/footer/wp_theme_footer.php';
    require_once SMI_INCLUDES . '/header/wp_theme_header.php';

    define( 'CUSTOM_BLOCKS', plugin_dir_path( __FILE__ ) . '/custom_core_blocks' );
    require_once CUSTOM_BLOCKS . '/custom.php';

?>