<?php

   // Aggiungi la sezione Footer
    $wp_customize->add_section( 'tema_footer_section', array(
        'title'       => 'Footer setting',
        'priority'    =>  10,
        'description' => 'Impostazioni del footer del sito',
        'panel'       => 'footer',
    ) );

    /////////////////////////////////// FOOTER LINK HOVER COLOR ///////////////////////////
    $wp_customize->add_setting( 'footer_link_hover_color', array(
        'default'           => 'grey',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh', // o 'postMessage' se aggiungi preview JS
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colore_link_hover_control', array(
        'label'    => 'Color link hover footer',
        'section'  => 'tema_footer_section',
        'settings' => 'footer_link_hover_color',
    ) ) );

    /////////////////////////////////// FOOTER LINK COLOR ///////////////////////////
    $wp_customize->add_setting( 'footer_link_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh', // o 'postMessage' se aggiungi preview JS
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colore_link_control', array(
        'label'    => 'Color link footer',
        'section'  => 'tema_footer_section',
        'settings' => 'footer_link_color',
    ) ) );


    /////////////////////////////////// FOOTER BACKGROUND COLOR ///////////////////////////
    $wp_customize->add_setting( 'footer_background_color', array(
        'default'           => 'black',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh', // o 'postMessage' se aggiungi preview JS
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colore_control', array(
        'label'    => 'Color background footer',
        'section'  => 'tema_footer_section',
        'settings' => 'footer_background_color',
    ) ) );


    // numero colonne footer
    $wp_customize->add_setting( 'footer_content_number', array(
        'default'           => 1,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control( 'footer_content_number_control', array(
        'label'       => 'Numero colonne footer',
        'section'     => 'tema_footer_section',
        'settings'    => 'footer_content_number', // deve corrispondere allo setting
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 4,
            'step' => 1,
        ),
    ));

?>