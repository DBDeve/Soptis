<?php

    function soptis_setup() { 
        add_theme_support( 'title-tag' );
        add_theme_support( 'automatic-feed-links' );
    } 
    add_action( 'after_setup_theme', 'soptis_setup' );

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


    function soptis_enqueue_assets() {
        wp_enqueue_style(
            'soptis-body',
            get_template_directory_uri() . '/css/body.min.css',
            array(),
            '1.0'
        );
        wp_enqueue_style(
            'soptis-footer',
            get_template_directory_uri() . '/css/footer.min.css',
            array(),
            '1.0'
        );
        wp_enqueue_style(
            'soptis-header',
            get_template_directory_uri() . '/css/header.min.css',
            array(),
            '1.0'
        );
        wp_enqueue_style(
            'soptis-font',
            get_template_directory_uri() . '/css/fontAwesome/css/all.min.css',
            array(),
            '1.0'
        );

        wp_enqueue_script(
            'soptis-script',
            get_template_directory_uri() . '/js/mobileMenu.min.js',
            array(),
            '1.0',
            true
        );
    }
    add_action('wp_enqueue_scripts', 'soptis_enqueue_assets');




    define( 'HEAD', plugin_dir_path( __FILE__ ) );
    require_once HEAD . '/head.php';


    define( 'SMI_INCLUDES', plugin_dir_path( __FILE__ ) . '/customize' );
    require_once SMI_INCLUDES . '/footer/wp_theme_footer.php';
    require_once SMI_INCLUDES . '/header/wp_theme_header.php';

    function soptis_create_homepage_on_activation() {

        // 1. Crea la pagina Home se non esiste
        $home = get_page_by_title( 'Home', OBJECT, 'page' );

        if ( ! $home || $home->post_status === 'trash' ) {

            $image_url = esc_url( get_stylesheet_directory_uri() . '/image/profile.jpg' );
            $background_image_url = esc_url( get_stylesheet_directory_uri() . '/image/background-image-default.jpg' );

            $home_id = wp_insert_post( array(
                'post_title'   => 'Home',
                'post_content' =>  "<!-- wp:cover {\"overlayColor\":\"vivid-cyan-blue\",\"isUserOverlayColor\":true,\"layout\":{\"type\":\"constrained\"}} -->\n<div class=\"wp-block-cover\"><span aria-hidden=\"true\" class=\"wp-block-cover__background has-vivid-cyan-blue-background-color has-background-dim-100 has-background-dim\"></span><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"verticalAlignment\":null} -->\n<div class=\"wp-block-columns\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:image {\"id\":10,\"sizeSlug\":\"full\",\"linkDestination\":\"none\",\"align\":\"center\"} -->\n<figure class=\"wp-block-image aligncenter size-full\"><img src=\"$image_url\" alt=\"\" class=\"wp-image-10\"/></figure>\n<!-- /wp:image --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"verticalAlignment\":\"center\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:heading {\"level\":1,\"style\":{\"typography\":{\"textAlign\":\"center\",\"fontSize\":\"50px\"}}} -->\n<h1 class=\"wp-block-heading has-text-align-center\" style=\"font-size:50px\">Titolo di prova</h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"style\":{\"typography\":{\"textAlign\":\"center\",\"fontSize\":\"35px\"}}} -->\n<p class=\"has-text-align-center\" style=\"font-size:35px\">testo di prova</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"style\":{\"typography\":{\"textAlign\":\"center\",\"fontSize\":\"35px\"}}} -->\n<p class=\"has-text-align-center\" style=\"font-size:35px\">testo di prova</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph {\"style\":{\"typography\":{\"textAlign\":\"center\",\"fontSize\":\"35px\"}}} -->\n<p class=\"has-text-align-center\" style=\"font-size:35px\">testo di prova</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:group {\"layout\":{\"type\":\"flex\",\"flexWrap\":\"nowrap\",\"justifyContent\":\"center\"}} -->\n<div class=\"wp-block-group\"><!-- wp:buttons {\"layout\":{\"type\":\"flex\",\"justifyContent\":\"center\"}} -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"backgroundColor\":\"white\",\"textColor\":\"black\",\"style\":{\"typography\":{\"textAlign\":\"center\"},\"elements\":{\"link\":{\"color\":{\"text\":\"var:preset|color|black\"}}}}} -->\n<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-black-color has-white-background-color has-text-color has-background has-link-color has-text-align-center wp-element-button\"><strong>pulsante prova</strong></a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons -->\n\n<!-- wp:buttons {\"layout\":{\"type\":\"flex\",\"justifyContent\":\"center\"}} -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"backgroundColor\":\"white\",\"textColor\":\"black\",\"style\":{\"typography\":{\"textAlign\":\"center\"},\"elements\":{\"link\":{\"color\":{\"text\":\"var:preset|color|black\"}}}}} -->\n<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-black-color has-white-background-color has-text-color has-background has-link-color has-text-align-center wp-element-button\"><strong>pulsante prova</strong></a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:group --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover -->",
                'post_status'  => 'publish',
                'post_type'    => 'page'
            ) );
        } else {
            $home_id = $home->ID;
        }

        // 2. Assegna il template custom alla pagina Home
        update_post_meta( $home_id, '_wp_page_template', 'template-home.php' );

        // 3. Crea la pagina Blog se non esiste
        $blog = get_page_by_title( 'Blog' );

        if ( ! $blog ) {
            $blog_id = wp_insert_post( array(
                'post_title'   => 'Blog',
                'post_status'  => 'publish',
                'post_type'    => 'page'
            ) );
        } else {
            $blog_id = $blog->ID;
        }

        // 4. Imposta la homepage statica
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_id );
        update_option( 'page_for_posts', $blog_id );
    }
    add_action( 'after_switch_theme', 'soptis_create_homepage_on_activation' );


?>