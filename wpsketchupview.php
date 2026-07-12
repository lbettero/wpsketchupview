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
 * Registers the model-viewer library and the Gutenberg block.
 */
function wpsketchupview_register(): void
{
    $model_viewer_file = plugin_dir_path(__FILE__)
        . 'assets/js/model-viewer.min.js';

    wp_register_script(
        'wpsketchupview-model-viewer',
        plugin_dir_url(__FILE__)
            . 'assets/js/model-viewer.min.js',
        [],
        is_file($model_viewer_file)
            ? (string) filemtime($model_viewer_file)
            : null,
        true
    );

    register_block_type(__DIR__ . '/block');
}

add_action('init', 'wpsketchupview_register');

/**
 * Loads model-viewer in the WordPress block editor.
 */
function wpsketchupview_enqueue_editor_assets(): void
{
    wp_enqueue_script('wpsketchupview-model-viewer');
}

add_action(
    'enqueue_block_editor_assets',
    'wpsketchupview_enqueue_editor_assets'
);

/**
 * Adds type="module" to the model-viewer script tag.
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
    if ('wpsketchupview-model-viewer' !== $handle) {
        return $tag;
    }

	$tag = preg_replace(
		'/\s+type=(["\'])(?:text\/javascript|application\/javascript)\1/i',
		'',
		$tag
	);

    return str_replace(
        '<script ',
        '<script type="module" ',
        $tag
    );
}

add_filter(
    'script_loader_tag',
    'wpsketchupview_script_loader_tag',
    10,
    2
);