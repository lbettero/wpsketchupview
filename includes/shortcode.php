<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Renders the WPSketchupView shortcode.
 *
 * Usage:
 * [wpsketchupview src="https://example.com/model.glb"]
 *
 * @param array<string, mixed>|string $atts Shortcode attributes.
 *
 * @return string
 */
function wpsketchupview_shortcode(array|string $atts = []): string
{
	if (!is_array($atts)) {
		$atts = [];
	}

	$attributes = shortcode_atts(
		[
			'src' => '',
		],
		$atts,
		'wpsketchupview'
	);

	$src = esc_url(trim((string) $attributes['src']));

	if ('' === $src) {
		return '';
	}

	if (function_exists('wpsketchupview_enqueue_model_viewer')) {
		wpsketchupview_enqueue_model_viewer();
	}

	$template_file = dirname(__DIR__)
		. DIRECTORY_SEPARATOR
		. 'templates'
		. DIRECTORY_SEPARATOR
		. 'viewer.php';

	if (!is_readable($template_file)) {
		return '';
	}

	ob_start();

	require $template_file;

	$output = ob_get_clean();

	return is_string($output) ? $output : '';
}

add_shortcode('wpsketchupview', 'wpsketchupview_shortcode');