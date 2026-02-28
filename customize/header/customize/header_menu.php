<?php

    $wp_customize->add_section( 'header_menu', array(
        'title'       => 'header menu',
        'priority'    => 7,
        'description' => "Impostazioni menu dell'header",
        'panel' => 'header'
    ) );


    ///////////////////////////// header_menu controls ///////////////////////
    $menus = wp_get_nav_menus();
    $names = wp_list_pluck( $menus, 'name' );
    $allowed_menu = array_combine( $names, $names ); 
    
    $wp_customize->add_setting( 'header_menu', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'header_menu_control', array(
        'label'    => 'Seleziona il menu da visualizzare nell\'header',
        'section'  => 'header_menu',
        'settings' => 'header_menu',
        'type'     => 'select',
        'choices'  => $allowed_menu,
    ) );

    //////////////////////////// JUSTIFY CONTENT ////////////////////////////
    $allowed_justify_content = array(
        'start' => 'start',
        'center' => 'center',
        'end' => 'end',
    );

    $wp_customize->add_setting( 'header_menu_justify_content', array(
        'default'           => 'justify_start',
        'sanitize_callback' => function( $value ) use ( $allowed_justify_content ) {
            return array_key_exists( $value, $allowed_justify_content ) ? $value : 'no_justify';
        },
        'transport' => 'refresh', // per anteprima live
    ) );

    $wp_customize->add_control( 'header_menu_justify_control', array(
        'label'    => 'nav bar alignment',
        'section'  => 'header_menu',
        'settings' => 'header_menu_justify_content',
        'type'     => 'select',
        'choices'  => $allowed_justify_content
    ) );

?>