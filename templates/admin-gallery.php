<?php
/** Administration gallery template. */

declare(strict_types=1);

defined('ABSPATH') || exit;
?>
<div class="wrap wpsketchupview-admin">
    <h1><?php esc_html_e('SketchUp 3D Models', 'wpsketchupview'); ?></h1>

    <p class="description">
        <?php
        echo esc_html(
            sprintf(
                /* translators: %s: directory relative to WordPress uploads. */
                __('GLB models found in the uploads directory: %s', 'wpsketchupview'),
                isset($location['relative']) ? $location['relative'] : '-'
            )
        );
        ?>
    </p>

    <p>
        <?php
        echo esc_html(
            sprintf(
                /* translators: %d: number of models. */
                _n('%d model found.', '%d models found.', count($models), 'wpsketchupview'),
                count($models)
            )
        );
        ?>
    </p>

    <?php require __DIR__ . '/gallery.php'; ?>
</div>
