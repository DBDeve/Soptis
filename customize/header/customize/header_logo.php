<?php

    $wp_customize->add_section( 'header_site_icon', array(
        'title'       => 'header site icon',
        'priority'    => 30,
        'description' => "Impostazioni icona sito dell'header",
        'panel' => 'header'
    ) );


    $wp_customize->add_setting( 'icon_set', array(
        'default'           => false,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'icon_set_control', array(
        'label'    => 'site icon',
        'section'  => 'header_site_icon',
        'settings' => 'icon_set',
        'type'     => 'checkbox',
    ) );


    $allowed_justify_content = array(
        'start' => 'start',
        'center' => 'center',
        'end' => 'end',
    );
    $wp_customize->add_setting( 'header_logo_align', array(
        'default'           => 'center',
        'sanitize_callback' => function( $value ) use ( $allowed_justify_content ) {
            return array_key_exists( $value, $allowed_justify_content ) ? $value : 'no_justify';
        },
        'transport' => 'refresh', // per anteprima live
    ) );
    $wp_customize->add_control( 'header_icon_justify_control', array(
        'label'    => 'site icon alignment',
        'section'  => 'header_site_icon',
        'settings' => 'header_logo_align',
        'type'     => 'select',
        'choices'  => $allowed_justify_content
    ) );


    // setting (URL immagine)
    $wp_customize->add_setting( 'header_image_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    // control immagine (mostra uploader)
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_image_url_control', array(
        'label'    => __( 'Header image', 'textdomain' ),
        'section'  => 'header_site_icon',
        'settings' => 'header_image_url',
    ) ) );

?>