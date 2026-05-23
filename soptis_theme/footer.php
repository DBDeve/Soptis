    <footer id="footer" style="<?php echo soptis_get_background_footer_style()?>">
        <?php soptis_footer_render()?>
        <p class="credits">
            <?php echo esc_html__( 'Icons by', 'soptis' ); ?>
            <a href="https://fontawesome.com/" target="_blank" rel="noopener">
                <?php echo esc_html__( 'Font Awesome', 'soptis' ); ?>
            </a>.
        </p>
    </footer>

    <?php wp_footer(); ?>
</body>