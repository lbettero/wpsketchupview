<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

$src = wpsketchupview_sanitize_model_url($attributes['src'] ?? '');
if ($src === '') {
    return;
}

wpsketchupview_enqueue_viewer_assets();
?>
<model-viewer
    class="wpsketchupview-viewer"
    src="<?php echo esc_url($src); ?>"
    alt="<?php echo esc_attr__('Interactive 3D model', 'wpsketchupview'); ?>"
    camera-controls
    touch-action="pan-y">
</model-viewer>
