<?php
/*================================================
#Load the Parent theme style.css file
================================================*/
function dt_enqueue_styles() {
	$parenthandle = 'divi-style'; 
	$theme = wp_get_theme();
	wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
		array(),  // if the parent theme code has a dependency, copy it to here
		$theme->parent()->get('Version')
	);
	wp_enqueue_style( 'child-style', get_stylesheet_uri(),
		array( $parenthandle ),
		$theme->get('Version') 
	);
}
add_action( 'wp_enqueue_scripts', 'dt_enqueue_styles' );

/*================================================
#Load the translations from the child theme folder
================================================*/
function wpcninja_translation() {
	load_child_theme_textdomain( 'Divi', get_stylesheet_directory() . '/lang/theme/' );
	load_child_theme_textdomain( 'et_builder', get_stylesheet_directory() . '/lang/builder/' );
}
add_action( 'after_setup_theme', 'wpcninja_translation' );
