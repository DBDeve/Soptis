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
            $home_id = wp_insert_post( array(
                'post_title'   => 'Home',
                'post_content' => '<!-- wp:cover {
                        "url":"'.esc_url( get_stylesheet_directory_uri()).'/image/background-image-default.jpg",
                        "id":8,
                        "dimRatio":50,
                        "customOverlayColor":"#28357b",
                        "isUserOverlayColor":false,
                        "sizeSlug":"full",
                        "metadata":{
                            "patternName":"hero sections",
                            "name":"mio-blocco",
                            "categories":["hero sections"]
                        },
                        "layout":{"type":"constrained"}
                    } -->
                    <div class="wp-block-cover">
                        <img 
                            class="wp-block-cover__image-background wp-image-8 size-full" 
                            alt=""
                            src="'.esc_url( get_stylesheet_directory_uri()).'/image/background-image-default.jpg"
                            data-object-fit="cover"
                        />
                        <span 
                            aria-hidden="true" 
                            class="wp-block-cover__background has-background-dim" 
                            style="background-color:#28357b">
                        </span>

                        <div class="wp-block-cover__inner-container">
                            <!-- wp:columns -->
                            <div class="wp-block-columns">

                                <!-- wp:column {"verticalAlignment":"center"} -->
                                <div class="wp-block-column is-vertically-aligned-center">
                                    <!-- wp:image {"id":9,"sizeSlug":"full","linkDestination":"none","align":"center"} -->
                                    <figure class="wp-block-image aligncenter size-full">
                                        <img 
                                            src="'.esc_url( get_stylesheet_directory_uri()).'/image/profile.jpg"
                                            alt="hero section image"
                                            title="hero section image"
                                            class="wp-image-9"
                                        />
                                    </figure>
                                    <!-- /wp:image -->
                                </div>
                                <!-- /wp:column -->

                                <!-- wp:column -->
                                <div class="wp-block-column">
                                    <!-- wp:heading {"textAlign":"center","level":1,"font-size":"50px"} -->
                                    <h1 class="wp-block-heading has-text-align-center">
                                        chi sono
                                    </h1>
                                    <!-- /wp:heading -->

                                    <!-- wp:paragraph {"align":"center","font-size":"35px"} -->
                                    <p class="has-text-align-center">
                                        Sviluppatore front-end orientato al web con i framework react e angular e i linguaggi HTML, CSS, javascript e Typescript.
                                    </p>
                                    <!-- /wp:paragraph -->

                                    <!-- wp:paragraph {"align":"center","font-size":"35px"} -->
                                    <p class="has-text-align-center">
                                        Sviluppatore temi wordpress con liguaggio php.
                                    </p>
                                    <!-- /wp:paragraph -->

                                    <!-- wp:paragraph {"align":"center","font-size":"35px"} -->
                                    <p class="has-text-align-center">
                                        sviluppatore back-end con framework Django e linguaggio Python e database di tipo relazionale.
                                    </p>
                                    <!-- /wp:paragraph -->
                                </div>
                                <!-- /wp:column -->

                            </div>
                            <!-- /wp:columns -->
                        </div>
                    </div>
                    <!-- /wp:cover -->',
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