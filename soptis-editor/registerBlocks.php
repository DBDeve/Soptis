<?php
    /**
    * Plugin Name: Soptis Editor
    * Plugin URI: 
    * Description: a plugin designed to allow users to edit web page metadata
    * Version: 1.0.0
    * Author: d4rkbl00d
    * Author URI: 
    * License: GPLv2 or later
    * License URI: https://www.gnu.org/licenses/gpl-2.0.html
    * Text Domain: soptis-editor
    */

    if ( ! defined( 'ABSPATH' ) ) exit;

    function mytheme_register_block() {

        wp_register_script(
            'mytheme-custom-block',
            get_template_directory_uri() . '/container/block.js',
            array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-block-editor' ),
            filemtime( get_template_directory() . '/container/block.js' ),
            array( 'strategy' => 'defer' )
        );

        wp_register_style( 
            'contenitore-editor-style', get_stylesheet_directory_uri() . '/css/container.css', 
            array(), 
            filemtime(get_stylesheet_directory() . '/css/container.css') 
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
            get_template_directory_uri() . '/container/HeroSection.js',
            array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-block-editor' ),
            filemtime( get_template_directory() . '/container/HeroSection.js' ),
            array( 'strategy' => 'defer' )
        );

        wp_register_style( 
            'contenitore-editor-style-hero', get_stylesheet_directory_uri() . '/css/HeroSection.css', 
            array(), 
            filemtime(get_stylesheet_directory() . '/css/HeroSection.css') 
        );

        register_block_type( 'mytheme/custom-block-hero', array(
            'editor_script' => 'mytheme-custom-block-hero',
            'editor_style' => 'contenitore-editor-style-hero',
        ) );
    }
    add_action( 'init', 'mytheme_register_block_hero' );

    add_action( 'enqueue_block_assets', function() {

        wp_enqueue_style(
            'mio-editor-style',
            get_template_directory_uri() . '/editor.css',
            [],
            filemtime( get_template_directory() . '/editor.css' )
        );

    });

?>