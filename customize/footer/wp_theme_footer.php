<?php
    function tema_customize_register_footer( $wp_customize ) {

        $wp_customize->add_panel( 'footer', array(
            'title'       => 'Footer',
            'priority'    => 160,
            'description' => 'Impostazioni del footer del sito',
        ) );

        define( 'FOOTER_CUSTOMIZE', plugin_dir_path( __FILE__ ) . '/customize' );

        require_once FOOTER_CUSTOMIZE . '/footer_setting.php';
        require_once FOOTER_CUSTOMIZE . '/footer_column.php';
        require_once FOOTER_CUSTOMIZE . '/footer_column_text.php';
        require_once FOOTER_CUSTOMIZE . '/footer_column_navbar.php';
        require_once FOOTER_CUSTOMIZE . '/footer_column_social_icons.php';
        require_once FOOTER_CUSTOMIZE . '/footer_column_maps.php';
        require_once FOOTER_CUSTOMIZE . '/footer_column_address.php';
        require_once FOOTER_CUSTOMIZE . '/footer_column_logo.php';

        
    }
    add_action( 'customize_register', 'tema_customize_register_footer' );


    function tema_footer_render() {
        $number_of_columns = (int) get_theme_mod( 'footer_content_number', 1 );

        for ( $i = 1; $i <= $number_of_columns; $i++ ) {

            echo '<div id="footer_column_'.esc_attr( $i ).'" >';

                
                    $text_boolean = get_theme_mod( "footer_column_{$i}_text_boolean", false) ;
                    if($text_boolean){

                        $text_align_value = get_theme_mod("footer_column_{$i}_text_align", "center");
                        $text_align = '--text-container-justify-align: '.$text_align_value.';';

                        $text_style='style="'. $text_align .'"';
                        
                        $text_content = get_theme_mod( "footer_col_{$i}_text_content", 'testo/html di prova' );
                        echo '<div '. $text_style .' class="text_html_container">';
                            echo '<p class="text">'.$text_content.'</p>';
                        echo '</div>';
                    }

                    $maps_boolean = get_theme_mod("footer_column_{$i}_maps", false);
                    if($maps_boolean){

                        $maps_align_value = get_theme_mod("footer_column_{$i}_maps_align", "center");
                        $maps_align = '--maps-container-justify-align: '.$maps_align_value.';';

                        $maps_style='style="'. $maps_align .'"';
                            
                        $maps_link= get_theme_mod("footer_column_{$i}_maps_link", 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12367353.697823416!2d2.1183282868056765!3d40.81975990771308!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12d4fe82448dd203%3A0xe22cf55c24635e6f!2sItalia!5e0!3m2!1sit!2sit!4v1771685477293!5m2!1sit!2sit');
                        echo '<div '. $maps_style .' class="maps_container">';
                            echo '<iframe src="'. $maps_link .'" width="100%" height="auto" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                        echo '</div>';
                    }

                    $address_boolean = get_theme_mod("footer_column_{$i}_address", false);
                    if($address_boolean){

                        $address_align_value = get_theme_mod("footer_column_{$i}_address_align", "center");
                        $address_align = '--address-container-justify-align: '.$address_align_value.';';

                        $address_style='style="'. $address_align .'"';
                        
                        $address_name = get_theme_mod("footer_column_{$i}_address_name", "inserisci nome");
                        $address_location = get_theme_mod("footer_column_{$i}_address_location", "inserisci location");
                        $address_phone = get_theme_mod("footer_column_{$i}_address_phone", "inserisci numero");
                        $address_mail = get_theme_mod("footer_column_{$i}_address_mail", "inserisci mail");
                        echo '<div '. $address_style .' class="address_container" >';
                            echo 
                                '<address class="address">
                                    <strong>'. $address_name .'</strong><br> 
                                    '. $address_location .'<br> 
                                    Tel: ' .$address_phone. '<br> 
                                    Email: <a href="mailto:'. $address_mail .'"> '. $address_mail .' </a><br> 
                                </address>'
                            ;
                        echo '</div>';
                    }

                    $navbar_boolean = get_theme_mod("footer_column_{$i}_navbar", false);
                    if($navbar_boolean){
                        echo '<div class="navbar_container">';
                        
                            $navbar_number = get_theme_mod("footer_column_{$i}_navbar_number",1);
                            for($y=1; $y <= $navbar_number; $y++){

                                ${"navbar_{$y}_align"} = get_theme_mod("footer_column_{$i}_navbar_number_{$y}_align", "center");
                                ${"navbar_{$y}_title"} = get_theme_mod("footer_column_{$i}_navbar_number_{$y}_title", "navbar title");
                                ${"navbar_{$y}_links"} = get_theme_mod("footer_column_{$i}_navbar_number_{$y}_navbar_link", '<li><a href="http://localhost/prova_sito/wordpress/sample-page/">Sample Page</a></li>' );

                                $navbar_style = ' style="--footer-navbar-align-items:'. ${"navbar_{$y}_align"} .'" ';

                                echo '<div '. $navbar_style .' class=single_navbar_container_'.$y.'>';
                                    echo ' <h4 class=navbar_heading>'. ${"navbar_{$y}_title"} .'</h4>' ;
                                    echo ' <nav> <ul>'. ${"navbar_{$y}_links"} .'</ul> </nav> ';
                                echo '</div>';
                            }

                        echo '</div>';
                    }

                    $socials_boolean = get_theme_mod("footer_column_{$i}_social_icons", false);
                    if($socials_boolean){

                        $socials_icons_align_value = get_theme_mod("footer_column_{$i}_social_icons_align", "center");
                        $socials_icons_align = '--socials-icons-container-justify-align: '.$socials_icons_align_value.';';

                        $socials_icons_style='style="'. $socials_icons_align .'"';
                        
                        echo '<div '. $socials_icons_style .' class="social_icons">';

                            $socials = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' );

                            foreach ( $socials as $handle ) {

                                ${"social_{$handle}_enabled"} = get_theme_mod("footer_column_{$i}_social_{$handle}_enable");
                                ${"social_{$handle}_url"} = get_theme_mod("footer_column_{$i}_social_{$handle}_url");

                                if(${"social_{$handle}_enabled"} && ${"social_{$handle}_url"} ){
                                    echo ' 
                                        <a href="' . ${"social_{$handle}_url"} . '">
                                            <i class="fab fa-' . $handle . '"></i>
                                            <span>' . $handle . '</span> 
                                        </a> 
                                    ';
                                }

                            }

                        echo '</div>';
                        
                    }

                    $logo_boolean = get_theme_mod("footer_column_{$i}_logo", false);
                    if($logo_boolean){

                        $logo_align_value = get_theme_mod("footer_column_{$i}_logo_align", "center");
                        $logo_align = '--logo-container-justify-align: '.$logo_align_value.';';

                        $logo_style='style="'. $logo_align .'"';

                        echo '<div '. $logo_style .' class="logo_cotainer">';

                            echo '<a id="footer_logo"  href="/">';
                                if ( get_site_icon_url() ) {
                                    echo '<img src="' . get_site_icon_url() . '" loading="lazy" alt="icon site footer" width="64" height="32" title=" icon site footer">';
                                } else {
                                    echo '<img src="' . esc_url( get_stylesheet_directory_uri() . '/image/deafult_Image.webp' ) . '" loading="eager" alt="icon site" width="64" height="32" title=" icon site">';
                                }
                            echo  '</a>';

                        echo '</div>';
                            
                    }

                }
                

            echo '</div>';
        }
        
    

    function get_background_footer_style(){
        $background_color = get_theme_mod( 'footer_background_color', '#000000' );
        $link_color = get_theme_mod( 'footer_link_color', '#ffffff' );
        $link_hover_color = get_theme_mod( 'footer_link_hover_color', '#7d7d7d' );

        $combined = trim( '--background-color:'. $background_color . ';'.'--link-color:'.$link_color.';'.'--link-hover-color:'.$link_hover_color.';');

        return esc_attr( $combined );
    }



?>