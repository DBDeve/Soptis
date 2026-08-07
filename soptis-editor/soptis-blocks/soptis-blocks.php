<?php

    if ( ! defined( 'ABSPATH' ) ) exit;

    function mytheme_register_block() {

        wp_register_script(
            'mytheme-custom-block',
            plugin_dir_url(__FILE__) . 'js/block.js',
            array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-block-editor' ),
            filemtime( plugin_dir_path(__FILE__) . 'js/block.js' ),
            array( 'strategy' => 'defer' )
        );

        wp_register_style( 
            'contenitore-editor-style', 
            plugin_dir_url(__FILE__) . 'css/container.css', 
            array(), 
            filemtime(plugin_dir_url(__FILE__) . 'css/container.css') 
        );

        register_block_type( 'mytheme/custom-block', array(
            'editor_script' => 'mytheme-custom-block',
            'editor_style' => 'contenitore-editor-style',
        ) );
    }
    add_action( 'init', 'mytheme_register_block' );

    function mytheme_register_block_hero() {
        wp_register_script(
            'mytheme-custom-block-hero',
            plugin_dir_url(__FILE__) . 'js/HeroSection.js',
            array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-block-editor' ),
            filemtime( plugin_dir_path(__FILE__) . 'js/HeroSection.js' ),
            array( 'strategy' => 'defer' )
        );

        wp_register_style( 
            'contenitore-editor-style-hero', 
            plugin_dir_url(__FILE__) . 'css/HeroSection.css', 
            array(), 
            filemtime(plugin_dir_url(__FILE__) . 'css/HeroSection.css') 
        );

        register_block_type( 'mytheme/custom-block-hero', array(
            'editor_script' => 'mytheme-custom-block-hero',
            'editor_style' => 'contenitore-editor-style-hero',
        ) );
    }
    add_action( 'init', 'mytheme_register_block_hero' );


    add_action( 'wp_enqueue_scripts', function() {

        wp_enqueue_style(
            'container-style',
            plugin_dir_url(__FILE__) . 'css/container.css',
            [],
            filemtime( plugin_dir_path(__FILE__) . 'css/container.css' )
        );

        wp_enqueue_style(
            'HeroSection-style',
            plugin_dir_url(__FILE__) . 'css/HeroSection.css',
            [],
            filemtime( plugin_dir_path(__FILE__) . 'css/HeroSection.css' )
        );
        
    });

?>