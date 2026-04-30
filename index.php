<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <!-- meta_tag -->
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php soptis_get_head(); ?>
        <!-- wp_head() tag -->
        <?php wp_head(); ?>
    </head>
    
    <?php get_header(); ?>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <main id="post-content" <?php post_class(); ?>>

                    <?php the_content(); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'soptis' ), 'after' => '</div>', ) ); ?>
                    
                </main>
            <?php endwhile; ?>
        <?php else : ?>
            <?php
                // Carica il template 404.php del tema
                get_template_part( '404' );
            ?>
        <?php endif; ?>
    

    <?php get_footer(); ?>
    
</html>
