<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <!-- meta_tag -->
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php get_head(); ?>
        <!-- wp_head() tag -->
        <?php wp_head(); ?>
    </head>
    
    <?php get_header(); ?>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <main id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php the_content(); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Soptis' ), 'after' => '</div>', ) ); ?>
                    
                </main>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Contenuto non trovato.</p>
        <?php endif; ?>
    

    <?php get_footer(); ?>
    
</html>
