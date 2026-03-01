<?php
    add_action('init', function() { remove_post_type_support('post', 'title'); remove_post_type_support('page', 'title'); });
    add_action( 'init', function() { remove_action( 'wp_head', 'wp_robots', 1 ); });
    add_action( 'init', function() { remove_action( 'wp_head', 'rel_canonical' ); });
?>