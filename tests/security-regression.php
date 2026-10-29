<?php
declare(strict_types=1);

define('ABSPATH', __DIR__ . '/wordpress/');

$registered_scripts = [];
$registered_styles = [];
$enqueued_scripts = [];
$enqueued_styles = [];

function plugin_dir_path(string $file): string { return dirname($file) . DIRECTORY_SEPARATOR; }
function plugin_dir_url(string $file): string { return 'https://example.test/wp-content/plugins/wpsketchupview/'; }
function plugin_basename(string $file): string { return 'wpsketchupview/' . basename($file); }
function load_plugin_textdomain(string $domain, bool $deprecated, string $path): bool { return true; }
function add_action(string $hook, callable|string $callback): void {}
function add_filter(string $hook, callable|string $callback, int $priority = 10, int $arguments = 1): void {}
function add_shortcode(string $tag, callable|string $callback): void {}
function register_block_type(string $path): bool { return is_file($path . '/block.json'); }
function wp_register_script(string $handle, string $src, array $dependencies, string $version, bool $footer): void {
    $GLOBALS['registered_scripts'][$handle] = compact('src', 'dependencies', 'version', 'footer');
}
function wp_register_style(string $handle, string $src, array $dependencies, string $version): void {
    $GLOBALS['registered_styles'][$handle] = compact('src', 'dependencies', 'version');
}
function wp_enqueue_script(string $handle): void { $GLOBALS['enqueued_scripts'][$handle] = true; }
function wp_enqueue_style(string $handle): void { $GLOBALS['enqueued_styles'][$handle] = true; }
function wp_parse_url(string $url): array|false { return parse_url($url); }
function esc_url_raw(string $url, array $protocols = []): string {
    $scheme = strtolower((string) parse_url($url, PHP_URL_SCHEME));
    return filter_var($url, FILTER_VALIDATE_URL) && in_array($scheme, $protocols, true) ? $url : '';
}
function esc_url(string $url): string { return htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); }
function esc_attr__(string $text, string $domain): string { return htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); }
function shortcode_atts(array $defaults, array $values, string $shortcode): array { return array_merge($defaults, $values); }

function assert_true(bool $condition, string $message): void
{
    if (!$condition) {
        fwrite(STDERR, "FAIL: {$message}\n");
        exit(1);
    }
}

require dirname(__DIR__) . '/wpsketchupview.php';
wpsketchupview_register();

$script = $registered_scripts['wpsketchupview-model-viewer'] ?? null;
assert_true(is_array($script), 'Local model-viewer must be registered.');
assert_true(str_starts_with($script['src'], 'https://example.test/'), 'Runtime must use the plugin URL.');
assert_true($script['version'] === '4.1.0', 'Runtime version must be pinned to 4.1.0.');
assert_true(!str_contains($script['src'], 'ajax.googleapis.com'), 'Runtime must not use the old CDN.');

assert_true(wpsketchupview_sanitize_model_url('javascript:alert(1)') === '', 'JavaScript URLs must be rejected.');
assert_true(wpsketchupview_sanitize_model_url('//example.com/model.glb') === '', 'Protocol-relative URLs must be rejected.');
assert_true(
    wpsketchupview_sanitize_model_url('https://models.example/model.glb') === 'https://models.example/model.glb',
    'Absolute HTTPS model URLs must be accepted.'
);

$attributes = ['src' => 'javascript:alert(1)'];
ob_start();
include dirname(__DIR__) . '/block/render.php';
$invalid_render = (string) ob_get_clean();
assert_true($invalid_render === '', 'Invalid block URLs must render nothing.');

$attributes = ['src' => 'https://models.example/model.glb'];
ob_start();
include dirname(__DIR__) . '/block/render.php';
$valid_render = (string) ob_get_clean();
assert_true(str_contains($valid_render, '<model-viewer'), 'Valid block URLs must render the viewer.');
assert_true(!str_contains($valid_render, '<script'), 'Block templates must not emit script tags.');
assert_true(!str_contains($valid_render, 'ajax.googleapis.com'), 'Block output must not reference the old CDN.');
assert_true(isset($enqueued_scripts['wpsketchupview-model-viewer']), 'Block render must enqueue the local runtime.');
assert_true(isset($enqueued_styles['wpsketchupview-viewer']), 'Block render must enqueue local styles.');

$shortcode = wpsketchupview_shortcode(['src' => 'https://models.example/model.glb']);
assert_true(str_contains($shortcode, '<model-viewer'), 'Valid shortcode URLs must render the viewer.');
assert_true(wpsketchupview_shortcode(['src' => 'data:text/html,test']) === '', 'Data URLs must be rejected.');

$module_tag = wpsketchupview_script_loader_tag(
    '<script src="local.js" id="wpsketchupview-model-viewer-js"></script>',
    'wpsketchupview-model-viewer'
);
assert_true(str_contains($module_tag, 'type="module"'), 'The local runtime must be emitted as a module.');

echo "Security regression tests passed.\n";
