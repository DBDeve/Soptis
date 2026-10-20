<?php

    $active_form = (int) get_theme_mod( 'footer_content_number', 1 );
    for ( $i = 1; $i <= 4; $i++ ) {
        $wp_customize->add_section( "tema_footer_column_{$i}", array(
            'title'       => "Footer column {$i}",
            'priority'    => 150,
            'description' => "Impostazioni colonna {$i} del footer",
            'panel'       => 'footer',
        ) );
    }

?>