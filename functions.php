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
function dt_translation() {
    // Hook into textdomain loading to handle hyphenated filenames
    add_filter('load_textdomain_mofile', function($mofile, $domain) {
        if ($domain === 'Divi') {
            $child_mofile = get_stylesheet_directory() . '/lang/theme/Divi-' . determine_locale() . '.mo';
            if (file_exists($child_mofile)) {
                return $child_mofile;
            }
        }
        if ($domain === 'et_builder') {
            $child_mofile = get_stylesheet_directory() . '/lang/builder/et_builder-' . determine_locale() . '.mo';
            if (file_exists($child_mofile)) {
                return $child_mofile;
            }
        }
        return $mofile;
    }, 10, 2);

    // Load the textdomains
    load_child_theme_textdomain('Divi', get_stylesheet_directory() . '/lang/theme/');
    load_child_theme_textdomain('et_builder', get_stylesheet_directory() . '/lang/builder/');
}

// Run after theme setup
add_action('after_setup_theme', 'dt_translation');
