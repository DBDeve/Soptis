<?php

    /*
    * Plugin Name:       Soptis_editor
    * Plugin URI:        https://github.com/DBDeve/Soptis
    * Description:       This plugin modifies the wordpress editor.
    * Version:           1.0.0
    * Requires at least: 5.2
    * Requires PHP:      7.2
    * Author:            DBDeve
    * Author URI:        www.linkedin.com/in/dbdeve
    * License:           GPL v2 or later
    * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
    */


    add_action( 'enqueue_block_editor_assets', function() {
        wp_enqueue_style(
            'my-editor-style',
            plugin_dir_url( __FILE__ ) . 'editor-style.css',
            array(), // dipendenze
            filemtime( plugin_dir_path( __FILE__ ) . 'editor-style.css' )
        );
    });

?>
