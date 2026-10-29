<?php
/**
 * Plugin Name:       WPSketchupView
 * Plugin URI:        https://github.com/lbettero/wpsketchupview
 * Description:       Display interactive SketchUp GLB models in WordPress.
 * Version:           0.2.1
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

const WPSKETCHUPVIEW_VERSION = '0.2.1';
const WPSKETCHUPVIEW_MODEL_VIEWER_VERSION = '4.1.0';

require_once __DIR__ . '/includes/shortcode.php';
require_once __DIR__ . '/includes/admin.php';

/** Registers local assets, translations and the Gutenberg block. */
function wpsketchupview_register(): void
{
    load_plugin_textdomain(
        'wpsketchupview',
        false,
        dirname(plugin_basename(__FILE__)) . '/languages'
    );

    wp_register_script(
        'wpsketchupview-model-viewer',
        plugin_dir_url(__FILE__) . 'assets/js/model-viewer.min.js',
        [],
        WPSKETCHUPVIEW_MODEL_VIEWER_VERSION,
        true
    );

    wp_register_style(
        'wpsketchupview-viewer',
        plugin_dir_url(__FILE__) . 'assets/css/viewer.css',
        [],
        WPSKETCHUPVIEW_VERSION
    );

    register_block_type(__DIR__ . '/block');
}

add_action('init', 'wpsketchupview_register');

/** Loads the viewer in the WordPress block editor. */
function wpsketchupview_enqueue_editor_assets(): void
{
    wpsketchupview_enqueue_viewer_assets();
}

add_action('enqueue_block_editor_assets', 'wpsketchupview_enqueue_editor_assets');

/** Enqueues the local viewer runtime and styles once per page. */
function wpsketchupview_enqueue_viewer_assets(): void
{
    wp_enqueue_script('wpsketchupview-model-viewer');
    wp_enqueue_style('wpsketchupview-viewer');
}

/** Accepts only absolute HTTP(S) model URLs. */
function wpsketchupview_sanitize_model_url(mixed $value): string
{
    if (!is_string($value)) {
        return '';
    }

    $url = trim($value);
    $parts = wp_parse_url($url);
    if (!is_array($parts)
        || !isset($parts['scheme'], $parts['host'])
        || !in_array(strtolower((string) $parts['scheme']), ['http', 'https'], true)) {
        return '';
    }

    return esc_url_raw($url, ['http', 'https']);
}

/** Adds type="module" only to the bundled Model Viewer script. */
function wpsketchupview_script_loader_tag(string $tag, string $handle): string
{
    if ('wpsketchupview-model-viewer' !== $handle) {
        return $tag;
    }

    $filtered_tag = preg_replace(
        '/\s+type=(["\'])(?:text\/javascript|application\/javascript)\1/i',
        '',
        $tag
    );
    if (is_string($filtered_tag)) {
        $tag = $filtered_tag;
    }

    return str_replace('<script ', '<script type="module" ', $tag);
}

add_filter('script_loader_tag', 'wpsketchupview_script_loader_tag', 10, 2);
