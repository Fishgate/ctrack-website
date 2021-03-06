<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

/**
 * enqueue scripts and styles for the frontend of the child theme
 */
function fg_enqueue(){
    wp_register_style('fg-styles', get_stylesheet_directory_uri() . '/css/main.css', array(), '1.0', 'all');
    wp_enqueue_style('fg-styles');

    wp_register_script('fg-scripts', get_stylesheet_directory_uri() . '/js/scripts.min.js', array(), '1.0', true);
    wp_enqueue_script('fg-scripts');
}
add_action('wp_print_styles', 'fg_enqueue');


/**
 * include child-theme shortcodes
 */
require_once('includes/shortcodes.php');

/**
 * include child-theme metaboxes/custom fields
 */
require_once('includes/metaboxes/ct_dark_light_header.php');
require_once('includes/metaboxes/ct_woocommerce_meta.php');

/**
 * removes the auto <br> and <p> from nested shortcodes
 * http://wordpress.stackexchange.com/a/130185
 */

function the_content_filter($content) {
    $block = join("|",array("ct_toggle", "ct_accordian"));
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
	return $rep;
}
add_filter("the_content", "the_content_filter");
