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


    define( 'SMI_INCLUDES', plugin_dir_path( __FILE__ ) . '/customize' );
    require_once SMI_INCLUDES . '/footer/wp_theme_footer.php';
    require_once SMI_INCLUDES . '/header/wp_theme_header.php';


    ####################################### FUNZIONI PER IL FUNZIONAMENTO DI WORLDPRESS ################################################# 

    function mio_tema_registra_stili_blocco() {
        register_block_style(
            'core/image',
            array(
                'name'  => 'immagine-arrotondata',
                'label' => __( 'Bordi Molto Arrotondati', 'soptis' ),
            )
        );
    }
    add_action( 'init', 'mio_tema_registra_stili_blocco' );

    /**
     * Registra i block pattern del tema.
     */
    function mio_tema_register_block_patterns() {
        if ( function_exists( 'register_block_pattern' ) ) {
            register_block_pattern(
                'mio-tema/test-pattern',
                array(
                    'title'       => __( 'Pattern di Test', 'soptis' ),
                    'description' => __( 'Un pattern di esempio per il tema.', 'soptis' ),
                    'content'     => '<!-- wp:paragraph --><p>Contenuto del pattern</p><!-- /wp:paragraph -->',
                    'categories'  => array( 'text' ),
                )
            );
        }
    }
    add_action( 'init', 'mio_tema_register_block_patterns' );



    /**
     * Configura le funzionalità supportate dal tema.
     */
    function mio_tema_setup_funzionalita() {
        
        // Supporto per i tag del titolo automatici (consigliato per la pubblicazione)
        add_theme_support( 'title-tag' );
        
        // Supporto per le immagini in evidenza (consigliato per la pubblicazione)
        add_theme_support( 'post-thumbnails' );

        // 1. Rende i video incorporati (YouTube, Vimeo, ecc.) reattivi sui dispositivi mobili
        add_theme_support( 'responsive-embeds' );

        // 2. Forza WordPress a usare tag HTML5 puliti per moduli di ricerca, commenti, gallerie, ecc.
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ) );

        // 3. Permette all'utente di caricare un logo personalizzato dal pannello "Personalizza"
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );

        // 4. Permette all'utente di cambiare l'immagine della testata (Header) dal pannello di controllo
        add_theme_support( 'custom-header', array(
            'default-image' => '',
            'width'         => 2000,
            'height'        => 1200,
            'flex-height'   => true,
            'flex-width'    => true,
        ) );

        // 5. Permette all'utente di impostare un colore o un'immagine di sfondo personalizzata per il sito
        add_theme_support( 'custom-background', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) );

        // 6. Abilita il supporto per i blocchi a larghezza ampia e piena (Wide e Full width) nell'editor
        add_theme_support( 'align-wide' );
        
        // 7. Mantiene attivo il supporto agli stili dei blocchi (risolto nel passaggio precedente)
        add_theme_support( 'wp-block-styles' );

        add_theme_support( 'post-thumbnails' );
    }
    add_action( 'after_setup_theme', 'mio_tema_setup_funzionalita' );


    function il_tuo_tema_setup() {
        // ... altre configurazioni del tuo tema (es. add_theme_support('title-tag');) ...

        // Abilità il supporto per gli stili dell'editor
        add_theme_support( 'editor-styles' );

        // Indica a WordPress quale file CSS caricare nell'editor
        add_editor_style( 'style-editor.css' );
    }
    add_action( 'after_setup_theme', 'il_tuo_tema_setup' );

    function il_tuo_tema_scripts() {
        // ... qui ci saranno già i tuoi fogli di stile, ad esempio:
        // wp_enqueue_style( 'soptis', get_stylesheet_uri() );

        // ABILITA LO SCRIPT PER LE RISPOSTE AI COMMENTI (Risolve l'avviso!)
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
    add_action( 'wp_enqueue_scripts', 'il_tuo_tema_scripts' );

    function il_tuo_tema_widgets_init() {
        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar Principale', 'soptis' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Aggiungi qui i widget per la barra laterale.', 'soptis' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
    add_action( 'widgets_init', 'il_tuo_tema_widgets_init' );

    function mio_tema_carica_stili() {
        // Carica il file style.css principale del tema
        wp_enqueue_style( 'mio-tema-stile-principale', get_stylesheet_uri() );
    }
    add_action( 'wp_enqueue_scripts', 'mio_tema_carica_stili' );






?>