<?php
    function soptis_customize_register_header( $wp_customize ) {

        $wp_customize->add_panel( 'header', array(
            'title'       => 'Header',
            'priority'    => 160,
            'description' => "Impostazioni dell'header del sito",
        ) );

        define( 'CUSTOMIZE', plugin_dir_path( __FILE__ ) . '/customize' );
        require_once CUSTOMIZE . '/header_setting.php';
        require_once CUSTOMIZE . '/header_menu.php';
        require_once CUSTOMIZE . '/header_heading.php';
        require_once CUSTOMIZE . '/header_social_icons.php';
        require_once CUSTOMIZE . '/header_logo.php';

    }
    add_action( 'customize_register', 'soptis_customize_register_header' );

    function soptis_header_render() {

        $header_menu_align_value = get_theme_mod( 'header_menu_justify_content', "center" );
        $header_menu_align="--header-navbar-align:$header_menu_align_value;";
        
        
        $header_menu_style='style=" '.$header_menu_align.' "';


        $selected_menu_name = get_theme_mod( 'soptis_header_menu');
        $menu = wp_get_nav_menu_object( $selected_menu_name );
        if ( $menu && isset($menu->term_id) ) { 
            $menu_id = $menu->term_id; 
            $items = wp_get_nav_menu_items( $menu_id ); 
            
        } else { 
            $menu_id = null; 
            $items = []; 
        }

        if ( (!empty( $items )) ) {
            echo '<nav id="header_navbar" '. $header_menu_style .'>';
                echo '<button id="mobile_button" aria-label="mobile_button" onClick="toggleMenu()">
                        <i class="fas fa-bars fa-2x"></i>
                    </button>';
                echo '<ul id="desktop_menu">';
                    foreach ( $items as $item ) {
                        // titolo e link
                        $title = esc_html( $item->title );
                        $url   = esc_url( $item->url );
                        echo '<li><a href="' . $url . '">' . $title . '</a></li>';
                    };
                echo' </ul>';
                echo '<ul id="mobile_menu" class="mobile_menu_close">';
                    foreach ( $items as $item ) {
                        // titolo e link
                        $title = esc_html( $item->title );
                        $url   = esc_url( $item->url );
                        echo '<li><a href="' . $url . '">' . $title . '</a></li>';
                    };
                echo' </ul>';
            echo '</nav>';
        }


        $heading_enable = (bool) get_theme_mod( 'soptis_header_heading', true);
        if ($heading_enable){
            
            $heading_align_value_db = get_theme_mod( 'soptis_header_heading_align', "center" );
            if ( in_array( $heading_align_value_db, ['flex-start', 'center', 'flex-end'] , true ) ) {
                $heading_align_value = $heading_align_value_db;
            } else {
                $heading_align_value = 'center';
            }
            $heading_align= "--header-heading-align:$heading_align_value;";
            
            $heading_style = 'style="'. $heading_align .' "';

            $site_title = get_bloginfo("name");
            if($site_title){
                echo '<h1 id="header_heading" '.$heading_style.'> '. get_bloginfo("name") .' </h1>';
            } else {
                echo '<h1 id="header_heading" '.$heading_style.'> inserire titolo </h1>';
            }

           

        }



        $social_enable = (bool) get_theme_mod( 'soptis_header_social_icons', true);
        if ($social_enable) {

            $social_icons_align_value_db = get_theme_mod( 'soptis_header_social_align', "center");
            if ( in_array( $social_icons_align_value_db, ['flex-start', 'center', 'flex-end','space-between','space-around','space-evenly'] , true ) ) {
                $social_icons_align_value = $social_icons_align_value_db;
            } else {
                $social_icons_align_value = 'center';
            }
            $social_icons_align= " --header-social-icons-align: $social_icons_align_value; ";

            $social_icons_style='style="'.$social_icons_align.' "';


            echo '<div id="header_social_icons" '.$social_icons_style.'"> ';

                $socials = array( 'facebook', 'twitter', 'instagram' );
                foreach ( $socials as $handle ) {

                    $enabled = (bool) get_theme_mod("soptis_social_{$handle}_enable", true);
                    $url     = get_theme_mod("soptis_social_{$handle}_url", "/");

                    if ( $enabled && $url ) {
                        echo "
                        <a href='".esc_url( home_url() )."{$url}'>
                            <i class='fab fa-{$handle}'></i>
                            <span>{$handle}</span>
                        </a>";
                    }
                }

                $socials = array( 'linkedin', 'youtube' );
                foreach ( $socials as $handle ) {

                    $enabled = (bool) get_theme_mod("soptis_social_{$handle}_enable", false);
                    $url     = get_theme_mod("soptis_social_{$handle}_url", "/");

                    if ( $enabled && $url ) {
                        echo "
                        <a href='".esc_url( home_url() )."{$url}'>
                            <i class='fab fa-{$handle}'></i>
                            <span>{$handle}</span>
                        </a>";
                    }
                }

            echo ' </div>';

            
        };


        $site_icons_enable = (bool) get_theme_mod( 'soptis_header_logo', true);
        if($site_icons_enable){

            $logo_align_value_bd = get_theme_mod( 'soptis_header_logo_align', "center");
            if ( in_array( $logo_align_value_bd, ['flex-start', 'center', 'flex-end'] , true ) ) {
                $logo_align_value = $logo_align_value_bd;
            } else {
                $logo_align_value = 'center';
            }
            $logo_align= "--header-logo-align: $logo_align_value;";

            $logo_style = 'style="'. $logo_align .' "';

            echo '<a id="header_logo" '. $logo_style .'  href='.esc_url( home_url() ).' >';

                if ( get_site_icon_url() ) {
                    echo '<img src="' . get_site_icon_url() . '" loading="eager" alt="icon site" width="64" height="32" title=" icon site">';
                } else {
                    echo '<img src="' . esc_url( get_stylesheet_directory_uri() . '/image/deafult_Image.webp' ) . '" loading="eager" alt="icon site" width="64" height="32" title=" icon site">';
                }

            echo  '</a>';

        }
    }
        
    

    function soptis_get_header_style(){

        $header_bg_color = get_theme_mod( 'soptis_header_bg_color', '#ffffff' );
        $header_link_color = get_theme_mod( 'soptis_header_link_color', 'black');
        $header_link_hover_color = get_theme_mod( 'soptis_header_link_hover_color', 'grey');
        

        $combined = trim('--header-background-color:'. $header_bg_color .';' .'--header-link-color:'. $header_link_color .';'.'--header-link-hover-color:'. $header_link_hover_color .';');

        return esc_attr( $combined );
    }

?>