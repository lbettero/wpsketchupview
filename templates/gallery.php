<?php
/** Gallery template. */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!isset($models) || !is_array($models)) {
    return;
}
?>
<?php if ($models === []) : ?>
    <p class="wpsketchupview-message">
        <?php esc_html_e('No GLB models were found.', 'wpsketchupview'); ?>
    </p>
<?php else : ?>
    <div class="wpsketchupview-gallery">
        <?php foreach ($models as $model) : ?>
            <article class="wpsketchupview-card">
                <model-viewer
                    src="<?php echo esc_url($model['url']); ?>"
                    alt="<?php
                    echo esc_attr(
                        sprintf(
                            /* translators: %s: model name. */
                            __('Interactive 3D model: %s', 'wpsketchupview'),
                            $model['name']
                        )
                    );
                    ?>"
                    camera-controls
                    touch-action="pan-y"
                    loading="lazy">
                </model-viewer>
                <h3 class="wpsketchupview-card__title">
                    <?php echo esc_html($model['name']); ?>
                </h3>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
