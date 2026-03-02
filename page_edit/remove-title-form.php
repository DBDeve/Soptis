<?php
    add_action('init', function() { remove_post_type_support('post', 'title'); remove_post_type_support('page', 'title'); });

?>