# WPSketchupView

A lightweight WordPress plugin that displays interactive SketchUp models exported as GLB files. Visitors can rotate, zoom, and explore 3D models directly in the browser using a native Gutenberg block.

## Features

- Interactive 3D GLB model viewer
- Native Gutenberg block
- Mouse and touch controls
- Rotate, zoom and pan
- Lightweight and easy to use
- Responsive viewer
- No external dependencies required by the user

## Requirements

- WordPress 6.0 or later
- PHP 8.1 or later
- A modern browser with WebGL support

## Installation

1. Download or clone this repository.
2. Copy the plugin folder into:

```
wp-content/plugins/
```

3. Activate **WPSketchupView** from the WordPress Plugins page.

## Preparing your model

Export your SketchUp project as a **GLB** file.

Upload the generated file to a location that provides a direct public URL.

Example:

```
https://example.com/models/house.glb
```

## Usage

1. Edit a page or post.
2. Click the **+** button.
3. Search for **WPSketchupView**.
4. Insert the block.
5. Paste the URL of your GLB model.
6. Publish or update the page.

The model will be displayed automatically.

## Supported format

- `.glb`

## Notes

The current version expects the GLB file to be publicly accessible through a direct URL.

Google Drive sharing links and other hosting services that do not provide direct access to the GLB file are not supported.

## Roadmap

Planned features include:

- Media Library integration
- Protected model storage
- Fullscreen mode
- Viewer customization
- Camera configuration
- Lighting controls
- Poster image support

## Changelog

### 0.1.0

- Initial release.
- Native Gutenberg block.
- Display SketchUp models exported as GLB files.
- Interactive 3D viewer.
- Mouse and touch controls.
- Rotate, zoom and pan support.
- Responsive viewer.

## License

GPL-2.0-or-later

https://www.gnu.org/licenses/gpl-2.0.html

## Author

LBettero

https://liviabettero.net/

GitHub:

https://github.com/lbettero/wpsketchupview