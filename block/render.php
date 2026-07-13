<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

$src = isset($attributes['src']) && is_string($attributes['src'])
	? trim($attributes['src'])
	: '';

if ($src === '') {
	return;
}

if (function_exists('wpsketchupview_enqueue_model_viewer')) {
	wpsketchupview_enqueue_model_viewer();
}
?>

<model-viewer
	src="<?php echo esc_url($src); ?>"
	alt="<?php echo esc_attr__(
		'Interactive 3D model',
		'wpsketchupview'
	); ?>"
	camera-controls
	touch-action="pan-y"
	style="display:block;width:100%;height:100%;background:#eeeeee;">
</model-viewer>