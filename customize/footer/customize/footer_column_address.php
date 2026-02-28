<?php
     
    //////////////////////////// ADDRESS DATA ///////////////////////////////////

    for ( $i = 1; $i <= 4; $i++ ) {
        $wp_customize->add_setting( "footer_column_{$i}_address", array(
            'default'           => false,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport'         => 'refresh',
        ));
        $wp_customize->add_control( "footer_column_{$i}_location_control", array(
            'label'    => "column {$i} address",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "footer_column_{$i}_address",
            'type'     => 'checkbox',
        ) );

        $allowed_justify_content_footer_address = array(
            'flex-start'  => 'start',
            'center'      => 'center',
            'flex-end'    => 'end',
        );
        $wp_customize->add_setting( "footer_column_{$i}_address_align", array(
            'default'           => 'center',
            'sanitize_callback' => function( $value ) use ( $allowed_justify_content_footer_address ) {
                return array_key_exists( $value, $allowed_justify_content_footer_address ) ? $value : 'no_justify';
            },
            'transport' => 'refresh',
        ) );
        $wp_customize->add_control( "footer_column_{$i}_address_align_control", array(
            'label'    => " column {$i} address alignment ",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "footer_column_{$i}_address_align",
            'type'     => 'select',
            'choices'  => $allowed_justify_content_footer_address,
            'active_callback' => "show_address_{$i}",
        ) );

        $wp_customize->add_setting( "footer_column_{$i}_address_name", array(
            'default'           => 'inserisci nome',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ));
        $wp_customize->add_control( "footer_column_{$i}_address_name_control", array(
            'label'    => "column {$i} address name",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "footer_column_{$i}_address_name",
            'type'     => 'text',
            'active_callback' => "show_address_{$i}",
        ) );

        $wp_customize->add_setting( "footer_column_{$i}_address_location", array(
            'default'           => 'inserisci luogo',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ));
        $wp_customize->add_control( "footer_column_{$i}_address_location_control", array(
            'label'    => "column {$i} address location",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "footer_column_{$i}_address_location",
            'type'     => 'text',
            'active_callback' => "show_address_{$i}",
        ) );

        $wp_customize->add_setting( "footer_column_{$i}_address_phone", array(
        'default'           => 'inserisci numero',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
        ));
        $wp_customize->add_control( "footer_column_{$i}_address_phone_control", array(
            'label'    => "column {$i} address phone",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "footer_column_{$i}_address_phone",
            'type'     => 'text',
            'active_callback' => "show_address_{$i}",
        ) );

        $wp_customize->add_setting( "footer_column_{$i}_address_mail", array(
        'default'           => 'inserisci mail',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
        ));
        $wp_customize->add_control( "footer_column_{$i}_address_mail_control", array(
            'label'    => "column {$i} address phone",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "footer_column_{$i}_address_mail",
            'type'     => 'text',
            'active_callback' => "show_address_{$i}",
        ) );
    }

    //// FUNZIONA////
    function show_address_1() { 
        return get_theme_mod( "footer_column_1_address", false ) === true;
    };
    function show_address_2() { 
        return get_theme_mod( "footer_column_2_address", false ) === true;
    };
    function show_address_3() { 
        return get_theme_mod( "footer_column_3_address", false ) === true;
    };
    function show_address_4() { 
        return get_theme_mod( "footer_column_4_address", false ) === true;
    };

?>