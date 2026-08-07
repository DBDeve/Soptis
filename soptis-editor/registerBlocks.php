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

    define( 'SOPTIS_BLOCKS', plugin_dir_path( __FILE__ ) . '/soptis-blocks' );
    require_once SOPTIS_BLOCKS . '/soptis-blocks.php';

    define( 'CUSTOM_CORE_BLOCKS', plugin_dir_path( __FILE__ ) . '/custom_core_blocks' );
    require_once CUSTOM_CORE_BLOCKS . '/custom.php';

    add_action( 'enqueue_block_assets', function() {

        wp_enqueue_style(
            'mio-editor-style',
            plugin_dir_url(__FILE__) . '/editor.css',
            [],
            filemtime( plugin_dir_path(__FILE__) . '/editor.css' )
        );

    });


?>