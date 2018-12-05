<?php
/**
 * Popperscores Theme Customizer
 *
 * @package Popperscores
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function popperscores_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_setting('header_color', array(
		'default' => '#000000',
		'type' => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage'
	));

	$wp_customize->add_control (
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_color', array(
				'label' => __('Header Background Color', 'popperscores'),
				'section' => 'colors',
			)
		)
	);

	// Add section to the Customizer
	$wp_customize->add_section( 'popperscores-options', array(
		'title' => __( 'Theme Options', 'popperscores' ),
		'capability' => 'edit_theme_options',
		'description' => __( 'Change the default display options for the theme.', 'popperscores' ),
	));

	// Create sidebar layout setting
	$wp_customize->add_setting(	'layout_setting',
		array(
			'default' => 'no-sidebar',
			'type' => 'theme_mod',
			'sanitize_callback' => 'popperscores_sanitize_layout', 
			'transport' => 'postMessage'
		)
	);
	// Add sidebar layout controls
	$wp_customize->add_control(	'layout_control',
		array(
			'settings' => 'layout_setting',
			'type' => 'radio',
			'label' => __( 'Sidebar position', 'popperscores' ),
			'choices' => array(
				'no-sidebar' => __( 'No sidebar (default)', 'popperscores' ),
				'sidebar-left' => __( 'Left sidebar', 'popperscores' ),
				'sidebar-right' => __( 'Right sidebar', 'popperscores' )
			),
			'section' => 'popperscores-options',
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'popperscores_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'popperscores_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'popperscores_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function popperscores_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function popperscores_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function popperscores_sanitize_layout( $value ) {
	if ( !in_array( $value, array( 'sidebar-left', 'sidebar-right', 'no-sidebar' ) ) ) {
		$value = 'no-sidebar';
	}
	return $value;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function popperscores_customize_preview_js() {
	wp_enqueue_script( 'popperscores-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'popperscores_customize_preview_js' );

function popperscores_customizer_css() {
	$header_color = get_theme_mod('header_color');
	
	?>
<style type="text/css">
	.site-header {
		background-color: <?php echo $header_color; ?>
	}
</style>
	<?php
}
add_action( 'wp_head', 'popperscores_customizer_css' );
