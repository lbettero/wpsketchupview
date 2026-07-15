<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

$src = isset($attributes['src']) && is_string($attributes['src'])
	? trim($attributes['src'])
	: '';

if ($src === '') {
	return;
}

wp_enqueue_script('wpsketchupview-model-viewer');
wp_enqueue_style('wpsketchupview-viewer');
?>

<model-viewer
	class="wpsketchupview-viewer"
	src="<?php echo esc_url($src); ?>"
	alt="<?php echo esc_attr__(
		'Interactive 3D model',
		'wpsketchupview'
	); ?>"
	camera-controls
	touch-action="pan-y">
</model-viewer>
