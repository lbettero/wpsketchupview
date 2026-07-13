<?php
/**
 * Plugin Name:       WPSketchupView
 * Plugin URI:        https://github.com/lbettero/wpsketchupview
 * Description:       Display interactive SketchUp GLB models in WordPress.
 * Version:           0.1.0
 * Requires at least: 6.0
 * Requires PHP:      8.1
 * Author:            LBettero
 * Author URI:        https://liviabettero.net/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wpsketchupview
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * Loads the shortcode implementation.
 */
require_once __DIR__ . '/includes/shortcode.php';

/**
 * Returns the model-viewer script handle.
 */
function wpsketchupview_model_viewer_handle(): string
{
	return 'wpsketchupview-model-viewer';
}

/**
 * Registers the local model-viewer library.
 */
function wpsketchupview_register_model_viewer(): void
{
	$handle = wpsketchupview_model_viewer_handle();

	if (wp_script_is($handle, 'registered')) {
		return;
	}

	$relative_path = 'assets/js/model-viewer.min.js';
	$script_path   = plugin_dir_path(__FILE__) . $relative_path;
	$script_url    = plugin_dir_url(__FILE__) . $relative_path;

	$version = is_file($script_path)
		? (string) filemtime($script_path)
		: false;

	wp_register_script(
		$handle,
		$script_url,
		[],
		$version,
		true
	);
}

/**
 * Registers the plugin assets and Gutenberg block.
 */
function wpsketchupview_register(): void
{
	wpsketchupview_register_model_viewer();

	register_block_type(__DIR__ . '/block');
}

add_action('init', 'wpsketchupview_register');

/**
 * Enqueues the local model-viewer library.
 *
 * This function is shared by the block renderer, shortcode and editor.
 */
function wpsketchupview_enqueue_model_viewer(): void
{
	wpsketchupview_register_model_viewer();

	wp_enqueue_script(wpsketchupview_model_viewer_handle());
}

/**
 * Loads model-viewer in the WordPress block editor.
 */
function wpsketchupview_enqueue_editor_assets(): void
{
	wpsketchupview_enqueue_model_viewer();
}

add_action(
	'enqueue_block_editor_assets',
	'wpsketchupview_enqueue_editor_assets'
);

/**
 * Adds type="module" to the local model-viewer script tag.
 *
 * @param string $tag    Generated script tag.
 * @param string $handle Registered script handle.
 *
 * @return string
 */
function wpsketchupview_script_loader_tag(
	string $tag,
	string $handle
): string {
	if (wpsketchupview_model_viewer_handle() !== $handle) {
		return $tag;
	}

	$filtered_tag = preg_replace(
		'/\s+type=(["\'])[^"\']*\1/i',
		'',
		$tag
	);

	if (!is_string($filtered_tag)) {
		return $tag;
	}

	return preg_replace(
		'/<script\b/i',
		'<script type="module"',
		$filtered_tag,
		1
	) ?: $tag;
}

add_filter(
	'script_loader_tag',
	'wpsketchupview_script_loader_tag',
	10,
	2
);