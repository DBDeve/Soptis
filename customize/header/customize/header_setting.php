<?php

    $wp_customize->add_section( 'header_setting', array(
        'title'       => 'header setting',
        'priority'    => 5,
        'description' => "Impostazioni dell'header",
        'panel' => 'header'
    ) );


    $wp_customize->add_setting( 'soptis_header_bg_color', array(
        'default'           => 'white',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    // Control colore (color picker)
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color_control', array(
        'label'    => 'Colore sfondo header',
        'section'  => 'header_setting',
        'settings' => 'soptis_header_bg_color',
    ) ) );


    $wp_customize->add_setting( 'soptis_header_link_hover_color', array(
        'default'           => 'grey',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_link_hover_color_control', array(
        'label'    => 'Color link hover header',
        'section'  => 'header_setting',
        'settings' => 'soptis_header_link_hover_color',
    ) ) );


    $wp_customize->add_setting( 'soptis_header_link_color', array(
        'default'           => 'black',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_link_color_control', array(
        'label'    => 'Color link header',
        'section'  => 'header_setting',
        'settings' => 'soptis_header_link_color',
    ) ) );

?>