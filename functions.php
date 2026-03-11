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



    define( 'HEAD', plugin_dir_path( __FILE__ ) );
    require_once HEAD . '/head.php';


    define( 'PAGE_EDIT', plugin_dir_path( __FILE__ ) . '/page_edit' );
    require_once PAGE_EDIT . '/metabox.php';
    require_once PAGE_EDIT . '/remove-title-form.php';
    require_once PAGE_EDIT . '/edit.php';


    define( 'SMI_INCLUDES', plugin_dir_path( __FILE__ ) . '/customize' );
    require_once SMI_INCLUDES . '/footer/wp_theme_footer.php';
    require_once SMI_INCLUDES . '/header/wp_theme_header.php';

?>