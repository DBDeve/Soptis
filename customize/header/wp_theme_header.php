<?php
    function tema_customize_register_header( $wp_customize ) {

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
    add_action( 'customize_register', 'tema_customize_register_header' );

    function tema_header_render() {

        

            $header_menu_align_value = get_theme_mod( 'header_menu_justify_content', "center" );
            $header_menu_align="--header-navbar-align:$header_menu_align_value;";
            
            
            $header_menu_style='style=" '.$header_menu_align.' "';


            $selected_menu_name = get_theme_mod( 'header_menu');
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


            $heading_enable = get_theme_mod( 'heading_set', true);
            if ($heading_enable){
                
                $heading_align_value = get_theme_mod( 'header_heading_align', "center" );
                $heading_align= "--header-heading-align:$heading_align_value;";
                

                $heading_style = 'style="'. $heading_align .' "';

                echo '<h1 id="header_heading" '.$heading_style.'> '. get_bloginfo("name") .' </h1>';

            }



            $social_enable = get_theme_mod( 'social_set', false);
            if ($social_enable) {

                $social_icons_align_value = get_theme_mod( 'header_social_align', "center");
                $social_icons_align= " --header-social-icons-align: $social_icons_align_value; ";

                
                $social_icons_style='style="'.$social_icons_align.' "';


                echo '<div id="header_social_icons" '.$social_icons_style.'"> ';

                    $socials = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' ); 
                    foreach ( $socials as $handle ) {

                        $enabled = get_theme_mod("social_{$handle}_enable");
                        $url     = get_theme_mod("social_{$handle}_url");

                        if ( $enabled && $url ) {
                            echo "
                            <a href='{$url}'>
                                <i class='fab fa-{$handle}'></i>
                                <span>{$handle}</span>
                            </a>";
                        }
                    }

                echo ' </div>';

                
            };


            $site_icons_enable = get_theme_mod( 'icon_set', false);
            if($site_icons_enable){

                $logo_align_value = get_theme_mod( 'header_logo_align', "center");
                $logo_align= "--header-logo-align: $logo_align_value;";

                $logo_style = 'style="'. $logo_align .' "';

                echo '<a id="header_logo" '. $logo_style .'  href="/">';

                    if ( get_site_icon_url() ) {
                        echo '<img src="' . get_site_icon_url() . '" loading="eager" alt="icon site" width="64" height="32" title=" icon site">';
                    } else {
                        echo '<img src="' . esc_url( get_stylesheet_directory_uri() . '/image/deafult_Image.webp' ) . '" loading="eager" alt="icon site" width="64" height="32" title=" icon site">';
                    }
                    

                echo  '</a>';

            }
        }
        
    

    function get_header_style(){

        $header_bg_color = get_theme_mod( 'header_bg_color', '#ffffff' );
        $header_link_color = get_theme_mod( 'header_link_color', 'black');
        $header_link_hover_color = get_theme_mod( 'header_link_hover_color', 'grey');
        

        $combined = trim('--header-background-color:'. $header_bg_color .';' .'--header-link-color:'. $header_link_color .';'.'--header-link-hover-color:'. $header_link_hover_color .';');

        return esc_attr( $combined );
    }

?>