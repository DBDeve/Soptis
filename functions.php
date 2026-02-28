<?php


    define( 'HEAD', plugin_dir_path( __FILE__ ) );
    require_once HEAD . '/head.php';


    define( 'PAGE_EDIT', plugin_dir_path( __FILE__ ) . '/page_edit' );
    require_once PAGE_EDIT . '/metabox.php';


    define( 'SMI_INCLUDES', plugin_dir_path( __FILE__ ) . '/customize' );
    require_once SMI_INCLUDES . '/footer/wp_theme_footer.php';
    require_once SMI_INCLUDES . '/header/wp_theme_header.php';

?>