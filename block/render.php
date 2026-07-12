<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

$src = isset($attributes['src']) && is_string($attributes['src'])
	? trim($attributes['src'])
	: '';

if ($src === '') {
	return;
}
?>

<script
	type="module"
	src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.1.0/model-viewer.min.js">
</script>

<model-viewer
	src="<?php echo esc_url($src); ?>"
	alt="<?php echo esc_attr__(
		'Interactive 3D model',
		'wpsketchupview'
	); ?>"
	camera-controls
	touch-action="pan-y"
	style="display:block;width:100%;height:500px;background:#eeeeee;">
</model-viewer>