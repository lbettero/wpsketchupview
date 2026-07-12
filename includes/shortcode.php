<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

add_shortcode('wpsketchupview', 'wpsketchupview_shortcode');

/**
 * Renders the WPSketchupView shortcode.
 *
 * Usage:
 * [wpsketchupview src="https://example.com/model.glb"]
 */
function wpsketchupview_shortcode(array $atts = []): string
{
    $atts = shortcode_atts(
        [
            'src' => '',
        ],
        $atts,
        'wpsketchupview'
    );

    $src = esc_url(trim((string) $atts['src']));

    if ($src === '') {
        return '';
    }

    ob_start();

    require plugin_dir_path(__DIR__) . 'templates/viewer.php';

    return (string) ob_get_clean();
}