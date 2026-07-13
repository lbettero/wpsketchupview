# WPSketchupView

A lightweight WordPress plugin that displays interactive SketchUp models exported as GLB files. Visitors can rotate, zoom, and explore 3D models directly in the browser using either a native Gutenberg block or a shortcode.

## Features

- Interactive 3D GLB model viewer
- Native Gutenberg block
- Shortcode support
- Mouse and touch controls
- Rotate, zoom and pan
- Responsive viewer
- Bundled `model-viewer` library
- No external runtime dependencies

## Requirements

- WordPress 6.0 or later
- PHP 8.1 or later
- A modern browser with WebGL support

## Installation

1. Download or clone this repository.
2. Copy the plugin folder into:

```text
wp-content/plugins/
```

3. Activate **WPSketchupView** from the WordPress Plugins page.

## Preparing your model

Export your SketchUp project as a **GLB** file.

Upload the generated file to a location that provides a direct public URL.

Example:

```text
https://example.com/models/house.glb
```

## Usage

### Gutenberg Block

1. Edit a page or post.
2. Click the **+** button.
3. Search for **WPSketchupView**.
4. Insert the block.
5. Paste the URL of your GLB model.
6. Publish or update the page.

### Shortcode

You can also display a model using the shortcode:

```text
[wpsketchupview src="https://example.com/models/house.glb"]
```

## Supported format

- `.glb`

## Notes

The GLB file must be publicly accessible through a direct URL.

Google Drive sharing links and other hosting services that do not provide direct access to the GLB file are not supported.

## Roadmap

Planned features include:

- Media Library integration
- Drag-and-drop model selection
- Protected model storage
- Fullscreen mode
- Viewer customization
- Camera configuration
- Lighting controls
- Poster image support

## Changelog

### 0.1.1

- Bundle the `model-viewer` library with the plugin
- Remove the external Google CDN dependency
- Centralize script registration and asset loading
- Share the same asset-loading mechanism between the Gutenberg block and shortcode
- Improve plugin architecture and code organization
- Improve cache busting using local asset versioning

### 0.1.0

- Initial release
- Native Gutenberg block
- Shortcode support
- Interactive GLB viewer
- Mouse and touch controls
- Responsive viewer

## License

GPL-2.0-or-later

https://www.gnu.org/licenses/gpl-2.0.html

## Author

LBettero

https://liviabettero.net/

GitHub:

https://github.com/lbettero/wpsketchupview