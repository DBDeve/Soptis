<?php

    $wp_customize->add_section( 'header_heading', array(
        'title'       => 'header heading',
        'priority'    => 10,
        'description' => "Impostazioni dell'heading dell'head",
        'panel' => 'header'
    ) );


    $wp_customize->add_setting( 'heading_set', array(
        'default'           => false,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'heading_set_control', array(
        'label'    => 'header heading',
        'section'  => 'header_heading',
        'settings' => 'heading_set',
        'type'     => 'checkbox', 
    ) );

    
    $allowed_heading_align = array(
        'start'  => 'start',
        'center' => 'center',
        'end'    => 'end',
    );
    $wp_customize->add_setting( 'header_heading_align', array(
        'default'           => 'start',
        'sanitize_callback' => function( $value ) use ( $allowed_heading_align ) {
            return array_key_exists( $value, $allowed_heading_align ) ? $value : 'start';
        },
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( 'header_heading_align_control', array(
        'label'    => 'header heading align',
        'section'  => 'header_heading',
        'settings' => 'header_heading_align',
        'type'     => 'select',
        'choices'  => $allowed_heading_align
    ) );



?>