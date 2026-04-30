<?php

    $wp_customize->add_section( 'header_social_icons', array(
        'title'       => 'header social icons',
        'priority'    => 20,
        'description' => "Impostazioni icone social menu dell'header",
        'panel' => 'header'
    ) );

    
    $wp_customize->add_setting( 'soptis_header_social_icons', array( 
        'default'           => false,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'soptis_header_social_icons_control', array(
        'label'    => 'social icons',
        'section'  => 'header_social_icons',
        'settings' => 'soptis_header_social_icons',
        'type'     => 'checkbox',
    ) );


    $allowed_justify_content = array(
        'flex-start' => 'flex-start',
        'center' => 'center',
        'flex-end' => 'flex-end',
        'space-between' => 'space-between',
        'space-around' => 'space-around',
        'space-evenly' => 'space-evenly',
    );
    $wp_customize->add_setting( 'soptis_header_social_align', array(
        'default'           => 'center',
        'sanitize_callback' => function( $value ) use ( $allowed_justify_content ) {
            return array_key_exists( $value, $allowed_justify_content ) ? $value : 'no_justify';
        },
        'transport' => 'refresh', // per anteprima live
    ) );
    $wp_customize->add_control( 'soptis_header_socials_justify_control', array(
        'label'    => 'socials icons alignment',
        'section'  => 'header_social_icons',
        'settings' => 'soptis_header_social_align',
        'type'     => 'select',
        'choices'  => $allowed_justify_content
    ) );

    $socials = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' );
    foreach ( $socials as $handle ) {
        // checkbox setting
        $wp_customize->add_setting( "soptis_social_{$handle}_enable", array(
        'default'           => '',
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( "soptis_social_{$handle}_enable_control", array(
        'label'    => ucfirst( $handle ) . ' Enable',
        'section'  => 'header_social_icons',
        'settings' => "soptis_social_{$handle}_enable",
        'type'     => 'checkbox',
        ) );

        // url setting
        $wp_customize->add_setting( "soptis_social_{$handle}_url", array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( "soptis_social_{$handle}_url_control", array(
        'label'    => ucfirst( $handle ) . ' URL',
        'section'  => 'header_social_icons',
        'settings' => "soptis_social_{$handle}_url",
        'type'     => 'url',
        ) );
    }



?>