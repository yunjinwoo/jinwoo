<?php

/**
 * @package WPlook
 * @subpackage DailyPost
 * @since DailyPost 1.0.0
*/
function wplook_bar_menu() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
		$admin_dir = get_admin_url();
		
	$wp_admin_bar->add_menu( array(
	'id' => 'custom_menu',
	'title' => __( 'WPlook Panel', 'wplook' ),
	'href' => FALSE,
	'meta' => array('title' => 'WPlook Options Panel', 'class' => 'wplookpanel') ) );
	
	$wp_admin_bar->add_menu( array(
	'id' => 'wpl_option',
	'parent' => 'custom_menu',
	'title' => __( 'DailyPost Options', 'wplook' ),
	'href' => $admin_dir .'admin.php?page=fw-options.php',
	'meta' => array('title' => 'DailyPost - Theme options') ) );
	
	$wp_admin_bar->add_menu( array(
	'id' => 'wpl_themes',
	'parent' => 'custom_menu',
	'title' => __( 'WPlook Themes', 'wplook' ),
	'href' => 'http://wplook.com/wordpress-themes',
	'meta' => array('title' => 'Premium Wordpress Themes from WPlook')) );
	
	$wp_admin_bar->add_menu( array(
	'id' => 'wpl_wplook',
	'parent' => 'custom_menu',
	'title' => __( 'WPlook News', 'wplook' ),
	'href' => 'http://wplook.com/',
	'meta' => array('title' => 'News and theme updates from WPlook') ) );

	$wp_admin_bar->add_menu( array(
	'id' => 'wpl_fb',
	'parent' => 'custom_menu',
	'title' => __( 'Facebook', 'wplook' ),
	'href' => 'http://www.facebook.com/pages/wplook/217332894973977',
	'meta' => array('target' => 'blank', 'title' => 'Become a fan on Facebook') ) );
	
	$wp_admin_bar->add_menu( array(
	'id' => 'wpl_tw',
	'parent' => 'custom_menu',
	'title' => __( 'Twitter', 'wplook' ),
	'href' => 'http://twitter.com/#!/wplook',
	'meta' => array('target' => 'blank', 'title' => 'Follow us on Twitter')
		) );
}
add_action('admin_bar_menu', 'wplook_bar_menu', '1000');

function wplook_buy_menu() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;

	$wp_admin_bar->add_menu( array(
	'id' => 'custom_buymenu',
	'title' => __( 'DailyPost PRO', 'wplook' ),
	'href' => 'http://wplook.com/dailypostbuy',
	'meta' => array('title' => 'Learn more about DailyPost PRO', 'class' => 'wplookbuy') ) );


}
add_action('admin_bar_menu', 'wplook_buy_menu', '1000');
