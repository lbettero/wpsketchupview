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

    $src = esc_url_raw(trim((string) $atts['src']));

    if ($src === '') {
        return '';
    }

    wp_enqueue_script('wpsketchupview-model-viewer');
    wp_enqueue_style('wpsketchupview-viewer');

    ob_start();

    require plugin_dir_path(__DIR__) . 'templates/viewer.php';

    return (string) ob_get_clean();
}

/**
 * Returns the configured models directory location.
 *
 * @return array{path: string, url: string, relative: string}|array{}
 */
function wpsketchupview_get_models_location(): array
{
    $upload = wp_upload_dir();

    if (!empty($upload['error'])) {
        return [];
    }

    /**
     * Filters the models directory below the WordPress uploads directory.
     *
     * @param string $directory Relative directory name.
     */
    $relative_directory = (string) apply_filters(
        'wpsketchupview_models_directory',
        'mesh'
    );
    $relative_directory = trim(sanitize_file_name($relative_directory), '/\\');

    if ($relative_directory === '') {
        return [];
    }

    return [
        'path' => trailingslashit((string) $upload['basedir']) . $relative_directory,
        'url' => trailingslashit((string) $upload['baseurl'])
            . rawurlencode($relative_directory),
        'relative' => $relative_directory,
    ];
}

/**
 * @return array<int, array{name: string, url: string}>
 */
function wpsketchupview_find_models(string $mesh_directory, string $mesh_url): array
{
    if (!is_dir($mesh_directory) || !is_readable($mesh_directory)) {
        return [];
    }

    $base_path = realpath($mesh_directory);
    if ($base_path === false) {
        return [];
    }

    $models = [];

    try {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($base_path, FilesystemIterator::SKIP_DOTS)
        );
    } catch (UnexpectedValueException) {
        return [];
    }

    foreach ($iterator as $file) {
        if (!$file->isFile() || strtolower($file->getExtension()) !== 'glb') {
            continue;
        }

        $relative_path = ltrim(substr($file->getPathname(), strlen($base_path)), '/\\');
        $parts = preg_split('~[/\\\\]+~', $relative_path) ?: [];
        $models[] = [
            'name' => pathinfo($file->getFilename(), PATHINFO_FILENAME),
            'url' => trailingslashit($mesh_url)
                . implode('/', array_map('rawurlencode', $parts)),
        ];
    }

    usort(
        $models,
        static fn(array $a, array $b): int => strnatcasecmp($a['name'], $b['name'])
    );

    return $models;
}
