<?php

    ///////////////////////// MAPS ///////////////////////////
    for ( $i = 1; $i <= 4; $i++ ) {

        $wp_customize->add_setting( "soptis_footer_column_{$i}_maps", array(
            'default'           => false,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport'         => 'refresh',
        ));
        $wp_customize->add_control( "soptis_footer_column_{$i}_maps_control", array(
            'label'    => "column {$i} maps",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "soptis_footer_column_{$i}_maps",
            'type'     => 'checkbox',
        ) );

        $allowed_justify_content_footer_maps = array(
            'flex-start'  => 'start',
            'center'      => 'center',
            'flex-end'    => 'end',
        );
        $wp_customize->add_setting( "soptis_footer_column_{$i}_maps_align", array(
            'default'           => 'center',
            'sanitize_callback' => function( $value ) use ( $allowed_justify_content_footer_maps ) {
                return array_key_exists( $value, $allowed_justify_content_footer_maps ) ? $value : 'no_justify';
            },
            'transport' => 'refresh',
        ) );
        $wp_customize->add_control( "soptis_footer_column_{$i}_maps_align_control", array(
            'label'    => " column {$i} maps alignment ",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "soptis_footer_column_{$i}_maps_align",
            'type'     => 'select',
            'choices'  => $allowed_justify_content_footer_maps,
            'active_callback' => "show_maps_{$i}",
        ) );

        $wp_customize->add_setting( "soptis_footer_column_{$i}_maps_link", array(
            'default'           => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12367353.697823416!2d2.1183282868056765!3d40.81975990771308!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12d4fe82448dd203%3A0xe22cf55c24635e6f!2sItalia!5e0!3m2!1sit!2sit!4v1771685477293!5m2!1sit!2sit',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "soptis_footer_column_{$i}_maps_link_control", array(
            'label'    => "column {$i} maps link",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "soptis_footer_column_{$i}_maps_link",
            'type'     => 'textarea',
            'active_callback' => "show_maps_{$i}",
        ) );
        
    }

    //// FUNZIONA////
    function show_maps_1() { 
        return get_theme_mod( "soptis_footer_column_1_maps", false ) === true;
    };
    function show_maps_2() { 
        return get_theme_mod( "soptis_footer_column_2_maps", false ) === true;
    };
    function show_maps_3() { 
        return get_theme_mod( "soptis_footer_column_3_maps", false ) === true;
    };
    function show_maps_4() { 
        return get_theme_mod( "soptis_footer_column_4_maps", false ) === true;
    };

?>