<?php

    $wp_customize->add_section( 'header_site_icon', array(
        'title'       => 'header site icon',
        'priority'    => 30,
        'description' => "Impostazioni icona sito dell'header",
        'panel' => 'header'
    ) );


    $wp_customize->add_setting( 'soptis_header_logo', array(
        'default'           => false,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'soptis_header_logo_control', array(
        'label'    => 'site icon',
        'section'  => 'header_site_icon',
        'settings' => 'soptis_header_logo',
        'type'     => 'checkbox',
    ) );


    $allowed_justify_content = array(
        'flex-start' => 'start',
        'center' => 'center',
        'flex-end' => 'end',
    );
    $wp_customize->add_setting( 'soptis_header_logo_align', array(
        'default'           => 'center',
        'sanitize_callback' => function( $value ) use ( $allowed_justify_content ) {
            return array_key_exists( $value, $allowed_justify_content ) ? $value : 'no_justify';
        },
        'transport' => 'refresh', // per anteprima live
    ) );
    $wp_customize->add_control( 'soptis_header_icon_justify_control', array(
        'label'    => 'site icon alignment',
        'section'  => 'header_site_icon',
        'settings' => 'soptis_header_logo_align',
        'type'     => 'select',
        'choices'  => $allowed_justify_content
    ) );

?>