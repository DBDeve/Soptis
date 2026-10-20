<?php

    for($i = 1; $i <= 4; $i++){
        ////////////////////////// LOGO ////////////////////////////////////////
        $wp_customize->add_setting( "soptis_footer_column_{$i}_logo", array(
        'default'           => false,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
        ));
        $wp_customize->add_control( "soptis_footer_column_{$i}_logo_control", array(
            'label'    => "column {$i} logo",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "soptis_footer_column_{$i}_logo",
            'type'     => 'checkbox',
        ) );

        $allowed_justify_content_footer_logo = array(
            'flex-start'  => 'start',
            'center'      => 'center',
            'flex-end'    => 'end',
        );
        $wp_customize->add_setting( "soptis_footer_column_{$i}_logo_align", array(
            'default'           => 'center',
            'sanitize_callback' => function( $value ) use ( $allowed_justify_content_footer_logo ) {
                return array_key_exists( $value, $allowed_justify_content_footer_logo ) ? $value : 'no_justify';
            },
            'transport' => 'refresh',
        ) );
        $wp_customize->add_control( "soptis_footer_column_{$i}_logo_align_control", array(
            'label'    => " column {$i} logo alignment ",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "soptis_footer_column_{$i}_logo_align",
            'type'     => 'select',
            'choices'  => $allowed_justify_content_footer_logo,
            'active_callback' => function() use ( $i ) { return show_logo( $i ); },
        ) );

        
    }

    function show_logo( $column ) { return get_theme_mod( "soptis_footer_column_{$column}_logo", false ) === true; }

    

?>