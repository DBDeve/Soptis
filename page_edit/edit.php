<?php

    add_action( 'enqueue_block_editor_assets', function() {
        wp_enqueue_style(
            'my-editor-style',
            get_stylesheet_directory_uri() . '/page_edit/editor-style.css',
            array(), // dipendenze
            filemtime( get_stylesheet_directory() . '/page_edit/editor-style.css' )
        );
    });

?>
