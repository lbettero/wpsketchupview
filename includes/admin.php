<?php
/** WordPress administration screen. */

declare(strict_types=1);

defined('ABSPATH') || exit;

add_action('admin_menu', 'wpsketchupview_register_admin_page');

/** Registers the read-only Meshes administration page. */
function wpsketchupview_register_admin_page(): void
{
    $hook_suffix = add_menu_page(
        __('3D Models', 'wpsketchupview'),
        __('3D Models', 'wpsketchupview'),
        'upload_files',
        'wpsketchupview-meshes',
        'wpsketchupview_render_admin_page',
        'dashicons-screenoptions'
    );

    add_action(
        'load-' . $hook_suffix,
        'wpsketchupview_load_admin_page_assets'
    );
}

/** Loads assets only on the plugin administration page. */
function wpsketchupview_load_admin_page_assets(): void
{
    wp_enqueue_script('wpsketchupview-model-viewer');
    wp_enqueue_style('wpsketchupview-viewer');
}

/** Renders the read-only Meshes administration page. */
function wpsketchupview_render_admin_page(): void
{
    if (!current_user_can('upload_files')) {
        wp_die(
            esc_html__('You are not allowed to view uploaded models.', 'wpsketchupview')
        );
    }

    $location = wpsketchupview_get_models_location();
    $models = $location === []
        ? []
        : wpsketchupview_find_models($location['path'], $location['url']);

    require plugin_dir_path(__DIR__) . 'templates/admin-gallery.php';
}
