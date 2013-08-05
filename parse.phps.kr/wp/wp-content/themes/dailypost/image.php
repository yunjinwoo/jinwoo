<?php
/**
 * The main template file.
 *
 * @package WPLOOK
 * @subpackage DailyPost
 * @since DailyPost 1.0
*/
get_header();
get_template_part('gallery', 'image' ) ;
get_sidebar();
get_footer(); ?>