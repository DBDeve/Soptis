<?php
    
    for( $i = 1; $i <= 4; $i++ ){
        /////////////////////////// SOCIAL ICONS ////////////////////////////////
        $wp_customize->add_setting( "footer_column_{$i}_social_icons", array(
            'default'           => false,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport'         => 'refresh',
        ));
        $wp_customize->add_control( "footer_column_{$i}_social_icons_control", array(
            'label'    => "column {$i} social icons",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "footer_column_{$i}_social_icons",
            'type'     => 'checkbox',
        ) );

        $allowed_justify_content_footer_social_icons = array(
            'flex-start'  => 'start',
            'center'      => 'center',
            'flex-end'    => 'end',
            'space-between' => 'space-between',
            'space-around' => 'space-around',
            'space-evenly' => 'space-evenly',
        );
        $wp_customize->add_setting( "footer_column_{$i}_social_icons_align", array(
            'default'           => 'center',
            'sanitize_callback' => function( $value ) use ( $allowed_justify_content_footer_social_icons ) {
                return array_key_exists( $value, $allowed_justify_content_footer_social_icons ) ? $value : 'no_justify';
            },
            'transport' => 'refresh',
        ) );
        $wp_customize->add_control( "footer_column_{$i}_social_icons_align_control", array(
            'label'    => " column {$i} address alignment ",
            'section'  => "tema_footer_column_{$i}",
            'settings' => "footer_column_{$i}_social_icons_align",
            'type'     => 'select',
            'choices'  => $allowed_justify_content_footer_social_icons,
            'active_callback' => "show_social_{$i}",
        ) );

        $socials = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' );
        foreach ( $socials as $handle ) {
            // checkbox setting
            $wp_customize->add_setting( "footer_column_{$i}_social_{$handle}_enable", array(
                'default'           => '',
                'transport'         => 'refresh',
            ) );
            $wp_customize->add_control( "footer_column_{$i}_social_{$handle}_enable_control", array(
                'label'    => ucfirst( $handle ) . ' Enable',
                'section'  => "tema_footer_column_{$i}",
                'settings' => "footer_column_{$i}_social_{$handle}_enable",
                'type'     => 'checkbox',
                'active_callback' => "show_social_{$i}",
            ) );

            // url setting
            $wp_customize->add_setting( "footer_column_{$i}_social_{$handle}_url", array(
                'default'           => '',
                'transport'         => 'refresh',
            ) );
            $wp_customize->add_control( "footer_column_{$i}_social_{$handle}_url_control", array(
                'label'    => ucfirst( $handle ) . ' URL',
                'section'  => "tema_footer_column_{$i}",
                'settings' => "footer_column_{$i}_social_{$handle}_url",
                'type'     => 'url',
                'active_callback' => "show_social_{$i}",
            ) );
        }
    }


    function show_social_1() { 
        return get_theme_mod( "footer_column_1_social_icons", false ) === true;
    };
    function show_social_2() { 
        return get_theme_mod( "footer_column_2_social_icons", false ) === true;
    };
    function show_social_3() { 
        return get_theme_mod( "footer_column_3_social_icons", false ) === true;
    };
    function show_social_4() { 
        return get_theme_mod( "footer_column_4_social_icons", false ) === true;
    };

?>