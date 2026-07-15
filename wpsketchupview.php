<?php
/**
 * Plugin Name:       WPSketchupView
 * Plugin URI:        https://github.com/lbettero/wpsketchupview
 * Description:       Display interactive SketchUp GLB models in WordPress.
 * Version:           0.2.0
 * Requires at least: 6.0
 * Requires PHP:      8.1
 * Author:            LBettero
 * Author URI:        https://liviabettero.net
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wpsketchupview
 * Domain Path:       /languages
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

require_once __DIR__ . '/includes/shortcode.php';
require_once __DIR__ . '/includes/admin.php';

/**
 * Registers the model-viewer library and the Gutenberg block.
 */
function wpsketchupview_register(): void
{
    load_plugin_textdomain(
        'wpsketchupview',
        false,
        dirname(plugin_basename(__FILE__)) . '/languages'
    );

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

    $viewer_style_file = plugin_dir_path(__FILE__) . 'assets/css/viewer.css';

    wp_register_style(
        'wpsketchupview-viewer',
        plugin_dir_url(__FILE__) . 'assets/css/viewer.css',
        [],
        is_file($viewer_style_file) ? (string) filemtime($viewer_style_file) : null
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
    wp_enqueue_style('wpsketchupview-viewer');
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
