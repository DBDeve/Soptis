<?php

    for ( $i = 1; $i <= 4; $i++ ) {
        //////////////////////// TEXT //////////////////////////////
        $wp_customize->add_setting( "soptis_footer_column_{$i}_text_boolean", array(
            'default'           => false,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport'         => 'refresh',
        ));
        $wp_customize->add_control( "soptis_footer_column_{$i}_text_control", array(
            'label'    => "column {$i} text",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "soptis_footer_column_{$i}_text_boolean",
            'type'     => 'checkbox',
        ) );

        $allowed_justify_content_footer_text = array(
            'flex-start'  => 'start',
            'center'      => 'center',
            'flex-end'    => 'end',
        );
        $wp_customize->add_setting( "soptis_footer_column_{$i}_text_align", array(
            'default'           => 'center',
            'sanitize_callback' => function( $value ) use ( $allowed_justify_content_footer_text ) {
                return array_key_exists( $value, $allowed_justify_content_footer_text ) ? $value : 'no_justify';
            },
            'transport' => 'refresh',
        ) );
        $wp_customize->add_control( "soptis_footer_column_{$i}_text_align_control", array(
            'label'    => " column {$i} text alignment ",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "soptis_footer_column_{$i}_text_align",
            'type'     => 'select',
            'choices'  => $allowed_justify_content_footer_text,
            'active_callback' => "show_text_{$i}",
        ) );
        
        
        $wp_customize->add_setting( "soptis_footer_col_{$i}_text_content", array(
            'default'           => 'testo/html di prova',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "soptis_footer_col_{$i}_text_content_control", array(
            'label'    => sprintf( 'added text or html to column %d', $i ),
            'section'  => "tema_footer_column_{$i}",
            'settings' => "soptis_footer_col_{$i}_text_content",
            'type'     => 'textarea',
            'input_attrs' => array(
                'style' => 'min-height:200px; font-family:monospace; overflow-x:auto; white-space:nowrap;',
            ),
            'active_callback' => "show_text_{$i}",
        ) );
    }

    //// FUNZIONA////
    function show_text_1() { 
        return get_theme_mod( "soptis_footer_column_1_text_boolean", false ) === true;
    };
    function show_text_2() { 
        return get_theme_mod( "soptis_footer_column_2_text_boolean", false ) === true;
    };
    function show_text_3() { 
        return get_theme_mod( "soptis_footer_column_3_text_boolean", false ) === true;
    };
    function show_text_4() { 
        return get_theme_mod( "soptis_footer_column_4_text_boolean", false ) === true;
    };

?>