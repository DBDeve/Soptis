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

        $personal_tag = $post_id ? get_post_meta( $post_id, '_meta_personal_tag', true ) : '';


        
        echo '<meta name="theme-color" content="#ffffff">';
        

        if ( $post_id == $front_page_id ) {
            $title = $post_id ? get_bloginfo( 'name' ) : '';
            $og_title = $title? $title : '';
            $twitter_title = $title? $title : '';
            $site_tagline = get_bloginfo( 'description' );
        } else {
            $title = $post_id ? get_post_meta( $post_id, '_title_seo', true ) : '';
            $og_title = $title? $title : '';
            $twitter_title = $title? $title : '';
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

        if($personal_tag){
            echo $personal_tag;
        } else {
            echo '<!-- meta personal tag not valid-->';
        }


        echo '<!-- link tag -->';
        echo '<link rel="apple-touch-icon" href="' . esc_url( get_stylesheet_directory_uri() . '/image/deafult_Image.webp' ) . '">';

    }
}

?>