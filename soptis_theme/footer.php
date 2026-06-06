    <footer id="footer" style="<?php echo soptis_get_background_footer_style()?>">
        <?php soptis_footer_render()?>
        <p class="credits">
            <?php echo esc_html__( 'Icons by', 'soptis' ); ?>
            <a href="https://fontawesome.com/" target="_blank" rel="noopener">
                <?php echo esc_html__( 'Font Awesome', 'soptis' ); ?>
            </a>.
        </p>
        <p class="theme_link">
            <a href="https://github.com/DBDeve/Soptis" target="_blank" rel="noopener">
                <?php echo esc_html__( '(created with Soptis theme)', 'soptis' ); ?>
            </a>.
        </p>
    </footer>

    <?php wp_footer(); ?>
</body>