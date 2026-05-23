<?php

    add_action( 'enqueue_block_editor_assets', function() {
        wp_enqueue_style(
            'my-editor-style',
            get_stylesheet_directory_uri() . '/soptis_plugin/editor-style.css',
            array(), // dipendenze
            filemtime( get_stylesheet_directory() . '/soptis_plugin/editor-style.css' )
        );
    });

?>
