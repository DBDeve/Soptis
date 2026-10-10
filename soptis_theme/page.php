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
                    
                    <header class="entry-header">
                        <!-- Titolo semplice senza link e senza date -->
                        <h1><?php the_title(); ?></h1>
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

                </article>

                <?php 
                // Nelle pagine fisse i commenti sono rari, ma se l'admin li abilita il tema deve supportarli
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
                ?>

            <?php 
            endwhile; 
        endif; 
        ?>

    </main>

    <?php get_footer(); ?>
</body>
</html>
