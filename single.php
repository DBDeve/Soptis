<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    
    <?php get_header(); ?>

    <main id="content" class="site-main">

        <?php 
        if ( have_posts() ) : 
            while ( have_posts() ) : the_post(); 
            ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <!-- IMMAGINE IN EVIDENZA: Aggiunta qui per risolvere l'avviso -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail( 'large' ); ?>
                        </div>
                    <?php endif; ?>
                    
                    <header class="entry-header">
                        <!-- Titolo semplice senza link -->
                        <h1><?php the_title(); ?></h1>
                        <div class="entry-meta">
                            <span class="posted-on">Pubblicato il: <?php echo get_the_date(); ?></span>
                        </div>
                    </header>

                    <div class="entry-content">
                        <?php 
                        the_content(); 
                        
                        wp_link_pages( array( 
                            'before' => '<div class="page-links">' . esc_html__( 'Pagine:', 'soptis' ), 
                            'after' => '</div>', 
                        ) ); 
                        ?>
                    </div>

                    <!-- I TAG: Richiesti obbligatoriamente su single.php -->
                    <footer class="entry-footer">
                        <?php 
                        if ( has_tag() ) {
                            echo '<div class="post-tags">';
                            the_tags( esc_html__( 'Tag: ', 'soptis' ), ', ', '' ); 
                            echo '</div>';
                        }
                        ?>
                    </footer>

                </article>

                <?php 
                // I COMMENTI: Carica il template comments.php (Obbligatorio)
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
                ?>

            <?php 
            endwhile; 

            // NAVIGAZIONE: Aggiunta qui per mostrare il link all'articolo precedente/successivo
            the_posts_navigation( array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Precedente:', 'soptis' ) . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Successivo:', 'soptis' ) . '</span> <span class="nav-title">%title</span>',
            ) );

        endif; 
        ?>

    </main>

    <?php get_footer(); ?>
</body>
</html>
