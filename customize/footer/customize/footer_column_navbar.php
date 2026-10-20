<?php

    for($i = 1; $i <= 4; $i++){
        ////////////////////////// NAVBAR CONTENT ///////////////////////////////

        if($i === 3){
            $wp_customize->add_setting( "soptis_footer_column_3_navbar", array(
                'default'           => true,
                'sanitize_callback' => 'rest_sanitize_boolean',
                'transport'         => 'refresh',
            ));
            $wp_customize->add_control( "soptis_footer_column_3_navbar_control", array(
                'label'    => "column 3 navbar",
                'section'  => "tema_footer_column_3",
                'settings' => "soptis_footer_column_3_navbar",
                'type'     => 'checkbox',
            ) );
        } else {
            $wp_customize->add_setting( "soptis_footer_column_{$i}_navbar", array(
                'default'           => false,
                'sanitize_callback' => 'rest_sanitize_boolean',
                'transport'         => 'refresh',
            ));
            $wp_customize->add_control( "soptis_footer_column_{$i}_navbar_control", array(
                'label'    => "column {$i} navbar",
                'section'  => "tema_footer_column_{$i}",
                'settings' => "soptis_footer_column_{$i}_navbar",
                'type'     => 'checkbox',
            ) );
        }

        // numero navbar footer
        $wp_customize->add_setting( "soptis_footer_column_{$i}_navbar_number", array(
            'default'           => 1,
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ));
        $wp_customize->add_control( "soptis_footer_column_{$i}_navbar_number_control", array(
            'label'       => 'Numero navbar footer',
            'section'     => "tema_footer_column_{$i}",
            'settings'    => "soptis_footer_column_{$i}_navbar_number", // deve corrispondere allo setting
            'type'        => 'range',
            'input_attrs' => array(
                'min'  => 1,
                'max'  => 3,
                'step' => 1,
            ),
            'active_callback' => function() use ( $i ) { return show_navbar_container( $i ); },
        ));

        for ($y = 1; $y <= 3; $y++) {

            $allowed_footer_navbar_align = array(
                'flex-start'  => 'start',
                'center'      => 'center',
                'flex-end'    => 'end',
            );
            $wp_customize->add_setting( "soptis_footer_column_{$i}_navbar_number_{$y}_align", array(
                'default'           => 'center',
                'sanitize_callback' => function( $value ) use ( $allowed_footer_navbar_align) {
                    return array_key_exists( $value, $allowed_footer_navbar_align ) ? $value : 'no_align';
                },
                'transport' => 'refresh',
            ) );
            $wp_customize->add_control( "soptis_footer_column_{$i}_navbar_number_{$y}_align_control", array(
                'label'    => " navbar align",
                'section'  => "tema_footer_column_{$i}",
                'settings' => "soptis_footer_column_{$i}_navbar_number_{$y}_align",
                'type'     => 'select',
                'choices'  => $allowed_footer_navbar_align,
                'active_callback' => function() use ( $i,$y ) { return show_navbar( $i, $y ); },
            ) );

            $wp_customize->add_setting( "soptis_footer_column_{$i}_navbar_number_{$y}_title", array(
            'default'           => 'inserisci titolo',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
            ));
            $wp_customize->add_control( "soptis_footer_column_{$i}_navbar_number_{$y}_title_control", array(
                'label'    => "footer_column_{$i}_navbar_number_{$y}",
                'section'  => "tema_footer_column_{$i}",
                'settings' => "soptis_footer_column_{$i}_navbar_number_{$y}_title", 
                'type'     => 'text',
                'active_callback' => function() use ( $i,$y ) { return show_navbar( $i, $y ); },
            ));

            $wp_customize->add_setting( "soptis_footer_column_{$i}_navbar_number_{$y}_navbar_link", array(
                'default'           => '<li><a href="#">Sample Page</a></li>',
                'sanitize_callback' => 'wp_kses_post',
                'transport'         => 'refresh',
            ) );
            $wp_customize->add_control( "soptis_footer_column_{$i}_navbar_number_{$y}_navbar_link_control", array(
                'label'    => "column {$i} navbar link",
                'section'  => "tema_footer_column_{$i}",
                'settings' => "soptis_footer_column_{$i}_navbar_number_{$y}_navbar_link",
                'type'     => 'textarea',
                'active_callback' => function() use ( $i,$y ) { return show_navbar( $i, $y ); },
            ) );

            
        }
    }

    function show_navbar_container( $column ) { 
        return get_theme_mod( "soptis_footer_column_{$column}_navbar", false ) === true;
    }

    function show_navbar($column, $navbar){

        $navbar_boolean = get_theme_mod( "soptis_footer_column_{$column}_navbar", false );

        $navbar_number = get_theme_mod( "soptis_footer_column_{$column}_navbar_number", 1 );


        if($navbar_boolean===true && $navbar_number>=$navbar ){
            return true;
        } else {
            return false;
        }
        

    }

?>