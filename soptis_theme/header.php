<body class="body" <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <a class="skip-link screen-reader-text" href="#content"> 
                <?php echo esc_html__( 'Skip to content', 'soptis' ); ?> 
        </a>
        <header id="header" style="<?php echo soptis_get_header_style()?>">
                <?php soptis_header_render()?>
        </header>