<?php
/**
 * Il modello per la visualizzazione della barra laterale (Sidebar)
 */

// Se non ci sono widget attivi in questa sidebar, non mostrare nulla
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
