<?php
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
    $robots_raw = $post_id ? get_post_meta( $post_id, '_meta_robots', true ) : '';

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
        

      <p>
        <label for="author"><strong>Author</strong></label><br>
        <input type="text" id="author" name="author" value="<?php echo esc_attr( $author ); ?>" style="width:100%;">
      </p>

      <br>
      <p><strong>ROBOTS</strong></p>
      <fieldset>
        <legend>Index</legend>
        <label><input type="radio" name="robots_index_value" value="true" <?php checked( $robots_raw, true ); ?> /> index</label>
        <label><input type="radio" name="robots_index_value" value="false" <?php checked( $robots_raw, false ); ?> /> noindex</label>
      </fieldset>


      <br>
      <p><strong> SOCIAL </strong></p>

      <fieldset>
        <legend> social type </legend>
        <label><input type="radio" name="social_type_value" value="website" <?php checked( $og_type, 'website' ); ?> /> website</label>
        <label><input type="radio" name="social_type_value" value="article" <?php checked( $og_type, 'article' ); ?> /> article</label>
      </fieldset>

      <br>
      <p><strong> TWITTER </strong></p>

      <fieldset>
        <legend> twitter card </legend>
        <label><input type="radio" name="twitter_card_value" value="summary" <?php checked( $twitter_card, 'summary' ); ?> /> summary </label>
        <label><input type="radio" name="twitter_card_value" value="summary_large_image" <?php checked( $twitter_card, 'summary_large_image' ); ?> /> summary large image </label>
        <label><input type="radio" name="twitter_card_value" value="app" <?php checked( $twitter_card, 'app' ); ?> /> app </label>
        <label><input type="radio" name="twitter_card_value" value="player" <?php checked( $twitter_card, 'player' ); ?> /> player </label>
      </fieldset>

      <p><strong> PERSONAL TAG </strong></p>
      <p>
        <label for="personal_tag"><strong> personal tag </strong></label><br>
        <textarea id="personal_tag" name="personal_tag" rows="3" style="width:100%;"><?php echo $personal_tag ; ?></textarea>
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

    // author
    if ( isset( $_POST['author'] ) ) {
        $val = sanitize_text_field( wp_unslash( $_POST['author'] ) );
        update_post_meta( $post_id, '_meta_author', $val );
    } else {
        delete_post_meta( $post_id, '_meta_author' );
    }

    // author
    if ( isset( $_POST['robots_index_value'] ) ) {
        $val = sanitize_text_field( wp_unslash( $_POST['robots_index_value'] ) );
        update_post_meta( $post_id, '_meta_robots', $val );
    } else {
        delete_post_meta( $post_id, '_meta_robots' );
    }

    if ( isset( $_POST['social_type_value'] ) ) {
        $val = sanitize_text_field( wp_unslash( $_POST['social_type_value'] ) );
        update_post_meta( $post_id, '_meta_og_type', $val );
        
    } else {
        delete_post_meta( $post_id, '_meta_og_type' );
    }


    if ( isset( $_POST['twitter_card_value'] ) ) { $allowed = [ 'summary', 'summary_large_image', 'app', 'player' ]; $val = sanitize_text_field( wp_unslash( $_POST['twitter_card_value'] ) ); if ( in_array( $val, $allowed, true ) ) { update_post_meta( $post_id, '_meta_twitter_card', $val ); } } else { delete_post_meta( $post_id, '_meta_twitter_card' ); }


    
    if ( isset( $_POST['personal_tag'] ) ) {
        $val = wp_unslash( $_POST['personal_tag'] );
        update_post_meta( $post_id, '_meta_personal_tag', $val );
    } else {
        delete_post_meta( $post_id, '_meta_personal_tag' );
    }
}
add_action( 'save_post', 'mio_plugin_salva_metabox' );


add_action('admin_footer', function() {
    ?>

        <script>
            jQuery(function($){

                let frame;

                $('#open-media').on('click', function(e){
                    e.preventDefault();

                    frame = wp.media({
                        title: 'Seleziona immagine',
                        multiple: false
                    });

                    frame.on('select', function(){
                        let attachment = frame.state().get('selection').first().toJSON();
                        $('#image-url').val(attachment.url);
                    });

                    frame.open();
                });

            });
        </script>

        <script>
            jQuery(function($){

                const min = 50;
                const max = 155;

                // Creo un elemento per mostrare il messaggio
                let msg = $('<p id="descrizione_seo_msg" style="margin-top:5px;"></p>');
                $('#descrizione_seo').after(msg);

                $('#descrizione_seo').on('input', function(){

                    let length = $(this).val().length;

                    if (length < min) {
                        msg.css('color', 'red');
                        msg.text("La descrizione deve essere almeno di " + min + " caratteri (" + length + " attuali).");
                    } 
                    else if (length > max) {
                        msg.css('color', 'red');
                        msg.text("La descrizione non deve superare " + max + " caratteri (" + length + " attuali).");
                    } 
                    else {
                        msg.css('color', 'green');
                        msg.text("Lunghezza corretta (" + length + " caratteri).");
                    }

                });

            });

        </script>

    <?php
});