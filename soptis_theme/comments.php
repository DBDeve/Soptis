<?php
/**
 * Il modello per la visualizzazione dei commenti
 */

/*
 * Se l'articolo corrente è protetto da password e
 * il visitatore non ha inserito la password, interrompiamo l'esecuzione.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ( 1 === $comment_count ) {
                printf( esc_html__( 'Un commento', 'soptis' ) );
            } else {
                printf( esc_html__( '%d commenti', 'soptis' ), $comment_count );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            // Questa è la funzione che inserisce gli avatar e risolve il tuo errore!
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50, 
            ) );
            ?>
        </ol>

        <?php 
        // Navigazione dei commenti se ce ne sono troppi
        the_comments_navigation(); 
        ?>

    <?php endif; ?>

    <?php
    // Se i commenti sono chiusi, mostra un messaggio di avviso
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php esc_html_e( 'I commenti sono chiusi.', 'soptis' ); ?></p>
    <?php endif; ?>

    <?php 
    // Mostra il modulo standard per scrivere un nuovo commento
    comment_form(); 
    ?>

</div>
