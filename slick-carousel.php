<?php
/**
 * Plugin Name: Elementor Slick Carousel
 * Description: Slick Carousel widget for Elementor
 * Version:     1.0.2
 * Author:      Cyrille Perois
 * Author URI:  https://github.com/drazik
 * Text Domain: elementor-addon
 */

function register_slick_carousel_widget($widgets_manager) {
	require_once(__DIR__ . "/widgets/slick-carousel-widget.php");
	$widgets_manager->register(new Elementor\Slick_Carousel_Widget());
}

add_action("elementor/widgets/register", "register_slick_carousel_widget");
add_action("elementor/frontend/after_enqueue_styles", "slick_carousel_styles");
add_action("elementor/frontend/after_register_scripts", "slick_carousel_scripts");

function slick_carousel_styles() {
	wp_register_style("slick_carousel_slick", plugins_url("assets/slick.css", __FILE__));
	wp_register_style("slick_carousel_slick_theme", plugins_url("assets/slick-theme.css", __FILE__));
	wp_register_style("slick_carousel_styles", plugins_url("assets/styles.css", __FILE__));

	wp_enqueue_style("slick_carousel_slick");
	wp_enqueue_style("slick_carousel_slick-theme");
	wp_enqueue_style("slick_carousel_styles");
}

function slick_carousel_scripts () {
	wp_register_script("slick_carousel_jquery", plugins_url("assets/jquery-3.6.1.min.js", __FILE__));
	wp_register_script("slick_carousel_slick", plugins_url("assets/slick.min.js", __FILE__));

	wp_enqueue_script("slick_carousel_jquery");
	wp_enqueue_script("slick_carousel_slick");
}
