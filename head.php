<?php
// functions.php


if ( ! function_exists( 'wp_theme_head' ) ) {

    function get_head() {

        $url_page = get_permalink();
        $post_id = url_to_postid( $url_page ); 

        // Titolazione/descrizione/author da post meta o funzioni WP

        $front_page_id = get_option( 'page_on_front' ); 

        $description = $post_id ? get_post_meta( $post_id, '_meta_description', true ) : '';
        $author = $post_id ? get_post_meta( $post_id, '_meta_author', true ) : '';
        $robots = $post_id ? get_post_meta( $post_id, '_meta_robots', true ) : '';

        $og_type = $post_id ? get_post_meta( $post_id, '_meta_og_type', true ) : '';
        $og_description = $description? $description : '';

        $twitter_card = $post_id ? get_post_meta( $post_id, '_meta_twitter_card', true ) : '';
        $twitter_description = $description? $description  : '';

        $personal_tag = $post_id ? get_post_meta( $post_id, '_meta_personal_tag', true ) : '';


        
        echo '<meta name="theme-color" content="#ffffff">';
        

        if ( $post_id == $front_page_id ) {
            $title = $post_id ? get_bloginfo( 'name' ) : '';
            $og_title = $title? $title : '';
            $twitter_title = $title? $title : '';
            $site_tagline = get_bloginfo( 'description' );
            echo '<title>' . esc_html( $title ) . ' - ' . esc_html( $site_tagline ) . '</title>';
        } else {
            $title = $post_id ? get_post_meta( $post_id, '_title_seo', true ) : '';
            $og_title = $title? $title : '';
            $twitter_title = $title? $title : '';
            echo '<title>' . esc_html( $title ) . '</title>';
        }

        if ( $description ) {
            echo '<meta name="description" content="' . esc_attr( $description ) . '">';
        } else {
            echo '<!-- meta tag description not valid -->';
        }

        if($author){
            echo '<meta name="author" content="' . esc_attr( $author ) . '">';
        } else {
            echo '<!-- meta tag author not valid -->';
        }

        if($robots==="true"){
            echo '<meta name="robots" content="index,follow">';
        } else {
            echo '<meta name="robots" content="noindex,nofollow">';
        }

        if($og_type){
            echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">';
        } else {
            echo '<!-- meta tag og:type not valid-->';
        }

        if($og_title){
            echo '<meta property="og:title" content="' . esc_attr( $og_title ) . '">';
        } else {
            echo '<!-- meta tag og:title not valid-->';
        }

        if($og_description){
            echo '<meta property="og:description" content="' . esc_attr( $og_description ) . '">';
        } else {
            echo '<!-- meta tag og:description not valid-->';
        }


        if(get_site_icon_url()){
            echo '<meta property="og:image" content="'. get_site_icon_url() .'">'; 
        } else {
            $img_url = get_template_directory_uri() . '/image/deafult_Image.webp';
            echo '<meta property="og:image" content="'. $img_url .'">';
        }

        echo '<meta property="og:url" content="'.esc_attr( $url_page ).'">';
        
        echo '<meta name="twitter:card" content="summary_large_image">';
        
        echo '<meta name="twitter:title" content="' . esc_attr( $twitter_title ) . '">';

        echo '<meta name="twitter:description" content="' . esc_attr( $twitter_description ) . '">';

        if($personal_tag){
            echo $personal_tag;
        } else {
            echo '<!-- meta personal tag not valid-->';
        }


        echo '<!-- link tag -->';
        echo '<link rel="canonical" href='.esc_attr( $url_page ).'>';
        echo '<link rel="apple-touch-icon" href="' . esc_url( get_stylesheet_directory_uri() . '/image/deafult_Image.webp' ) . '">';
        echo '<!-- link tag stylesheet-->';

        echo '
            <link rel="preload" href="' . esc_url( get_stylesheet_directory_uri() . '/css/body.css' ) . '" as="style" onload="this.rel=\'stylesheet\'">
            <noscript>
                <link rel="stylesheet" href="' . esc_url( get_stylesheet_directory_uri() . '/css/body.css' ) . '">
            </noscript>
        ';

        echo '
            <link rel="preload" href="' . esc_url( get_stylesheet_directory_uri() . '/css/header.css' ) . '" as="style" onload="this.rel=\'stylesheet\'">
            <noscript>
                <link rel="stylesheet" href="' . esc_url( get_stylesheet_directory_uri() . '/css/header.css' ) . '">
            </noscript>
        ';

        echo '
            <link rel="preload" href="' . esc_url( get_stylesheet_directory_uri() . '/css/footer.css' ) . '" as="style" onload="this.rel=\'stylesheet\'">
            <noscript>
                <link rel="stylesheet" href="' . esc_url( get_stylesheet_directory_uri() . '/css/footer.css' ) . '">
            </noscript>
        ';

        //// scaricare il pacchetto e installarlo
        echo '
            <link rel="preload" href="' . esc_url( get_stylesheet_directory_uri() . '/css/fontAwesome/css/all.min.css' ) . '" as="style" onload="this.rel=\'stylesheet\'">
            <noscript>
                <link rel="stylesheet" href="' . esc_url( get_stylesheet_directory_uri() . '/css/fontAwesome/css/all.min.css' ) . '">
            </noscript>
        ';

        echo '<!-- tag script -->';
        echo'<script defer>

            let aperto = false; 

            function toggleMenu() { 
                if (!aperto) { 
                    apriMenu(); // prima funzione 
                    aperto = true; 
                } 
                else { 
                    chiudiMenu(); // seconda funzione 
                    aperto = false; 
                } 
            }

            function apriMenu() {
                const height = document.querySelector("#header").getBoundingClientRect().height;
                const mobileMenu = document.querySelector("#mobile_menu");

                mobileMenu.style.setProperty(\'--height-mobile-menu\', `${height}px`);
                mobileMenu.classList.remove(\'mobile_menu_close\');
                mobileMenu.classList.add(\'mobile_menu_open\');

                
                
                const mobileButton = document.querySelector("#mobile_button");
                mobileButton.innerHTML = "<i class=\"fas fa-times fa-2x\"></i>";
                
            }

            function chiudiMenu(){
                const mobileMenu = document.querySelector("#mobile_menu"); 
                mobileMenu.classList.remove(\'mobile_menu_open\');
                mobileMenu.classList.add(\'mobile_menu_close\');


                const mobileButton = document.querySelector("#mobile_button");
                mobileButton.innerHTML = "<i class=\"fas fa-bars fa-2x\"></i>";
            }

        </script>';

    }
}

?>