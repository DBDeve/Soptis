<?php

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
        ];

        // Se il blocco è nella lista, aggiungi le classi
        if (in_array($block['blockName'], $design_blocks, true)) {

            $block_content = preg_replace(
                '/class="/',
                'class="block-margin block-padding ',
                $block_content,
                1
            );
        }

        return $block_content;

    }, 10, 2);


    function mytheme_register_block() {

        wp_register_script(
            'mytheme-custom-block',
            get_stylesheet_directory_uri() . '/custom_core_blocks/js/block-margin-control.js',
            array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-block-editor', 'wp-dom-ready', 'wp-edit-post','wp-components','wp-hooks' ),
            filemtime( get_template_directory() . '/custom_core_blocks/js/block-margin-control.js' )
        );

        register_block_type( 'mytheme/custom-block', array(
            'editor_script' => 'mytheme-custom-block',
        ) );
    }
    add_action( 'init', 'mytheme_register_block' );


?>