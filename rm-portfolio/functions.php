<?php
/**
 * RM Portfolio theme functions.
 *
 * @package rm-portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme supports.
 */
function rm_portfolio_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/editor.css' );
}
add_action( 'after_setup_theme', 'rm_portfolio_setup' );

/**
 * Enqueue Google font (Space Grotesk) and the reveal script.
 */
function rm_portfolio_assets() {
	// Theme stylesheet (block themes do not reliably auto-load style.css).
	wp_enqueue_style(
		'rm-portfolio-style',
		get_stylesheet_uri(),
		array(),
		(string) wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'rm-portfolio-fonts',
		'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&display=swap',
		array(),
		null
	);

	wp_enqueue_script(
		'rm-portfolio-reveal',
		get_theme_file_uri( 'assets/rm.js' ),
		array(),
		(string) wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'rm_portfolio_assets' );

/**
 * Automatically append the child-page cards (Work cascade) to any page
 * that has child pages — mirrors the static site's Work page.
 */
function rm_append_child_pages( $content ) {
	if ( ! is_page() || is_admin() || is_feed() ) {
		return $content;
	}

	$children = get_pages(
		array(
			'parent'      => get_the_ID(),
			'sort_column' => 'menu_order',
			'sort_order'  => 'ASC',
		)
	);

	if ( empty( $children ) ) {
		return $content;
	}

	$out  = '<div class="rm-cards">';
	// Card meta + description lines, matching the static site's Work page.
	$meta_map = array(
		'cellulant' => array(
			'meta' => 'Cellulant · Senior QA Engineer in Test · 2025–present',
			'desc' => 'Customer-reported issues converted into preventive regression coverage and automated safeguards — 20% fewer recurring production defects in six months.',
		),
		'aza'       => array(
			'meta' => 'AZA Finance · QA Engineer · 2020–2024',
			'desc' => 'Regression and API validation built into CI/CD across payments and FX platforms.',
		),
		'tracom'    => array(
			'meta' => 'Tracom Services · Service Management Specialist · 2017–2020',
			'desc' => 'Escalation ownership, centralised tracking, and structured workflows — resolution turnaround down 70%.',
		),
	);
	foreach ( $children as $child ) {
		$slug = get_post_field( 'post_name', $child );
		$card = isset( $meta_map[ $slug ] ) ? $meta_map[ $slug ] : array();
		$out .= '<a class="rm-card rm-card--link" href="' . esc_url( get_permalink( $child ) ) . '">';
		$out .= '<h3>' . esc_html( get_the_title( $child ) ) . '</h3>';
		if ( ! empty( $card['meta'] ) ) {
			$out .= '<div class="rm-card__meta">' . esc_html( $card['meta'] ) . '</div>';
		}
		if ( ! empty( $card['desc'] ) ) {
			$out .= '<p>' . esc_html( $card['desc'] ) . '</p>';
		}
		$out .= '</a>';
	}
	$out .= '</div>';

	return $content . $out;
}
add_filter( 'the_content', 'rm_append_child_pages', 20 );
