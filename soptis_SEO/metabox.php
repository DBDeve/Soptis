<?php

/**
 * Plugin Name: Soptis SEO
 * Plugin URI: 
 * Description: a plugin designed to allow users to edit web page metadata
 * Version: 1.0.1
 * Author: DBDeve(Dario)
 * Author URI: 
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: soptis-seo
 */

if ( ! defined( 'ABSPATH' ) ) exit;


// Aggiunge il metabox
function mio_plugin_aggiungi_metabox() {
    add_meta_box(
        'mio_plugin_metabox_id',
        'Impostazioni SEO Personalizzate',
        'mio_plugin_mostra_metabox',
        array( 'post', 'page' ),
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'mio_plugin_aggiungi_metabox' );

// Callback: mostra i campi
function mio_plugin_mostra_metabox( $post ) {
    // nonce per sicurezza
    wp_nonce_field( 'mio_plugin_salva_metabox', 'mio_plugin_nonce' );

    $post_id = isset( $post->ID ) ? (int) $post->ID : 0;

    // preleva i meta esistenti
    $front_page_id = get_option( 'page_on_front' ); 
    if($post_id != $front_page_id){
        $title = $post_id ? get_post_meta( $post_id, '_title_seo', true ) : '';
    }
    $description = $post_id ? get_post_meta( $post_id, '_meta_description', true ) : '';
    $author = $post_id ? get_post_meta( $post_id, '_meta_author', true ) : '';

    $og_type = $post_id ? get_post_meta( $post_id, '_meta_og_type', true ) : '';
    $og_image = $post_id ? get_post_meta( $post_id, '_meta_og_image', true ) : '';

    $twitter_card = $post_id ? get_post_meta( $post_id, '_meta_twitter_card', true ) : '';
    

    $personal_tag = $post_id ? get_post_meta( $post_id, '_meta_personal_tag', true ) : '';

    // campi HTML (nota: non mettere <form> dentro il metabox: l'edit form principale gestisce l'invio)
    ?>
    <div id="form_container" style=" margin-right: 20%; margin-left: 20%;">


        <?php 
            $front_page_id = get_option( 'page_on_front' ); 

            if ( $post->ID != $front_page_id ) {
                echo 
                '<p>
                    <label for="title_seo"><strong> title page </strong></label><br>
                    <textarea id="title_seo" name="title_seo" rows="3" style="width:100%;">'
                    . esc_textarea( $title ) .
                    '</textarea>
                </p>';
            }

        ?>


        <p>
            <label for="descrizione_seo"><strong>Description</strong></label><br>
            <textarea id="descrizione_seo" name="descrizione_seo" rows="3" style="width:100%;"><?php echo esc_textarea( $description ); ?></textarea>
        </p>

      <br>
      <p><strong>ROBOTS</strong></p>
      <fieldset>
        <legend>Index</legend>
        <label><input type="radio" name="robots_value" value="true" <?php checked( $robots_raw, true ); ?> /> index</label>
        <label><input type="radio" name="robots_value" value="false" <?php checked( $robots_raw, false ); ?> /> noindex</label>
      </fieldset>

      <br>

      <p><strong> PERSONAL TAG </strong></p>
      <p>
        <label for="personal_tag"><strong> personal tag </strong></label><br>
        <textarea id="personal_tag" name="personal_tag" rows="3" style="width:100%;"><?php echo esc_kses($personal_tag) ; ?></textarea>
      </p> 


    </div>
    <?php
}

// Salva i metadati in modo sicuro
function mio_plugin_salva_metabox( $post_id ) {
    // Non salvare durante autosave o in revision
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
        return;
    }

    // Controllo nonce
    if ( ! isset( $_POST['mio_plugin_nonce'] ) || ! wp_verify_nonce( $_POST['mio_plugin_nonce'], 'mio_plugin_salva_metabox' ) ) {
        return;
    }

    // Permessi
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $front_page_id = get_option( 'page_on_front' ); 
    if($post_id != $front_page_id){
        if ( isset( $_POST['title_seo'] ) ) {
            $val = sanitize_textarea_field( wp_unslash( $_POST['title_seo'] ) );
            update_post_meta($post_id, '_title_seo', $val);

        } else {
            update_post_meta($post_id, '_title_seo');
        }
    }

    // Sanitizza e salva description
    if ( isset( $_POST['descrizione_seo'] ) ) {
        $val = sanitize_textarea_field( wp_unslash( $_POST['descrizione_seo'] ) );
        update_post_meta( $post_id, '_meta_description', $val );
    } else {
        delete_post_meta( $post_id, '_meta_description' );
    }
    
    if ( isset( $_POST['robots_value'] ) ) {
        $val = wp_validate_boolean( wp_unslash( $_POST['robots_value'] ) );
        update_post_meta( $post_id, '_meta_robots_value', $val );
    } else {
        delete_post_meta( $post_id, '_meta_robots_value' );
    }
    
    if ( isset( $_POST['personal_tag'] ) ) {
        $val = sanitize_text_field(wp_unslash( $_POST['personal_tag'] ) );
        update_post_meta( $post_id, '_meta_personal_tag', $val );
    } else {
        delete_post_meta( $post_id, '_meta_personal_tag' );
    }
}
add_action( 'save_post', 'mio_plugin_salva_metabox' );

add_filter( 'pre_get_document_title', 'soptis_seo_custom_title' );
function soptis_seo_custom_title( $title ) {

    if (is_front_page() || is_home()){
        return $title;
    }

    $post_id = get_queried_object_id();
    $title_seo = get_post_meta( $post_id, '_title_seo', true );

    if ( ! empty( $title_seo ) ) {
        return esc_html( $title_seo );
    }

    return $title;
}

add_filter( 'wp_robots', 'soptis_custom_robots' );
function soptis_custom_robots( $robots ) {

    $post_id = get_queried_object_id();
    $robots_tag = get_post_meta( $post_id, '_meta_robots_value', true );
    if ( (! empty( $robots_tag  )) && $robots_tag===true ) {
        $robots['index'] = true;
        $robots['follow'] = true;
    } else {
        $robots['noindex'] = true;
        $robots['nofollow'] = true;
    }

    return $robots;
}


add_action( 'wp_head', 'soptis_seo_output_meta_description' );
function soptis_seo_output_meta_description() {

    if ( ! is_singular() ) {
        return; // solo su pagine e post singoli
    }

    $post_id = get_queried_object_id();

    $description = get_post_meta( $post_id, '_meta_description', true );
    if ( ! empty( $description ) ) {
        echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
    }

    $allowed_tags = [
        'meta' => [
            'name'     => true,
            'content'  => true,
        ],
    ];
    $personal_tag = get_post_meta( $post_id, '_meta_personal_tag', true );
    if ( ! empty( $personal_tag ) ) {
        echo wp_kses( $personal_tag, $allowed_tags ) . "\n";
    }

}


add_action( 'wp_enqueue_scripts', 'soptis_plugin_scripts' );
function soptis_plugin_scripts() {

    wp_enqueue_script(
        'soptis-plugin-js',
        plugins_url( 'js/metabox.js', __FILE__ ),
        array('jquery'),
        filemtime( plugin_dir_path(__FILE__) . 'js/metabox.js' ),
        true
    );
}