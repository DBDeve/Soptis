<?php

    if ( ! defined( 'ABSPATH' ) ) exit;

    //applica le classi solo ai blocchi selezionati
    add_filter('render_block', function($block_content, $block) {

        // Lista dei blocchi "design"
        $design_blocks = [
            'core/group',
            'core/columns',
            'core/column',
            'core/cover',
            'core/media-text',
            'core/row',
            'core/stack',
            'core/grid',
            'core/paragraph',
            'core/title'
        ];

        // Se il blocco è nella lista, aggiungi le classi
        if (in_array($block['blockName'], $design_blocks, true)) {

            $block_content = preg_replace(
                '/class="/',
                'class="block-margin block-padding block-border ',
                $block_content,
                1
            );
        }

        return $block_content;

    }, 10, 2);




    add_action( 'wp_enqueue_scripts', function() {

        wp_enqueue_style(
            'core-blocks-style',
            plugin_dir_url(__FILE__) . 'css/block.css',
            [],
            filemtime( plugin_dir_path(__FILE__) . 'css/block.css' )
        );
        
    });



    add_action('enqueue_block_editor_assets', function() {
        
        wp_enqueue_script(
            'block-margin-control',
            plugin_dir_url(__FILE__)  . 'js/block-margin-control.js',
            ['wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-hooks', 'wp-block-editor'],
            filemtime( plugin_dir_path( __FILE__ ) . 'js/block-margin-control.js' ),
            array( 'in_footer' => true )
        );

        wp_enqueue_script(
            'block-border-control',
            plugin_dir_url(__FILE__)  . 'js/block-border-control.js',
            ['wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-hooks', 'wp-block-editor'],
            filemtime( plugin_dir_path( __FILE__ ) . 'js/block-border-control.js' ),
            array( 'in_footer' => true )
        );

        wp_enqueue_script(
            'block-padding-control',
            plugin_dir_url(__FILE__)  . 'js/block-padding-control.js',
            ['wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-hooks', 'wp-block-editor'],
            filemtime( plugin_dir_path( __FILE__ ) . 'js/block-padding-control.js' ),
            array( 'in_footer' => true )
        );

        wp_enqueue_script(
            'image',
            plugin_dir_url(__FILE__)  . 'js/image.js',
            ['wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-hooks', 'wp-block-editor'],
            filemtime( plugin_dir_path( __FILE__ ) . 'js/image.js' ),
            array( 'in_footer' => true )
        );

        wp_enqueue_script(
            'cover-block-customize',
            plugin_dir_url(__FILE__)  . 'js/cover-block-customize.js',
            ['wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-hooks', 'wp-block-editor'],
            filemtime( plugin_dir_path( __FILE__ ) . 'js/cover-block-customize.js' ),
            array( 'in_footer' => true )
        );

    });


?>