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
