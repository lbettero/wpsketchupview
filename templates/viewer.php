<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

if (!isset($src) || $src === '') {
    return;
}
?>

<model-viewer
    class="wpsketchupview-viewer"
    src="<?php echo esc_url($src); ?>"
    alt="<?php echo esc_attr__('Interactive 3D model', 'wpsketchupview'); ?>"
    camera-controls
    touch-action="pan-y">
</model-viewer>
