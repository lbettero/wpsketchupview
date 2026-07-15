=== WPSketchupView ===
Contributors: lbettero
Tags: sketchup, glb, 3d, model-viewer, gutenberg
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 8.1
Stable tag: 0.2.0
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Display interactive SketchUp models exported as GLB files using a native Gutenberg block.

== Description ==

WPSketchupView is a lightweight WordPress plugin that lets you display interactive SketchUp models exported as GLB files directly in your posts and pages.

Built on the open-source Model Viewer web component maintained by Google and contributors, it allows visitors to rotate, zoom, and inspect 3D models in modern browsers without requiring additional software or plugins.

== Features ==

* Native Gutenberg block.
* Interactive 3D viewer with camera controls.
* Responsive layout for desktop and mobile devices.
* Simple configuration through the WordPress Block Editor.
* Supports GLB (Binary glTF) models.
* Read-only Meshes screen in the WordPress administration area.

== Installation ==

1. Upload the plugin to the `/wp-content/plugins/` directory, or install it through the WordPress Plugins screen.
2. Activate the plugin through the **Plugins** screen in WordPress.
3. Edit a post or page using the Block Editor.
4. Add the **WPSketchupView** block.
5. Select or enter the URL of a GLB model.
6. Publish or update the page.

== Frequently Asked Questions ==

= Which file formats are supported? =

Currently, WPSketchupView supports GLB (Binary glTF) files.

= Can visitors interact with the model? =

Yes. Visitors can rotate, zoom, and inspect the model using mouse, touch, or trackpad gestures.

= Does this plugin work with the Classic Editor? =

No. WPSketchupView is designed for the WordPress Block Editor (Gutenberg).

== Screenshots ==

1. WPSketchupView block in the WordPress Block Editor.
2. Interactive GLB model displayed on the front end.

== Changelog ==

= 0.2.0 =

* Added a Meshes administration screen.
* Added automatic GLB discovery in the configured uploads subdirectory.
* Added a responsive interactive model gallery.
* Replaced the remote front-end dependency with the bundled library.

= 0.1.1 =

* Improved plugin documentation for WordPress.org.
* Updated readme to the official WordPress.org format.
* Added third-party library information.
* General maintenance and submission preparation.

= 0.1.0 =

* Initial release.
* Display SketchUp models exported as GLB files.
* Interactive 3D viewer with camera controls.
* Responsive layout for desktop and mobile devices.

== Upgrade Notice ==

= 0.1.1 =

Documentation improvements and maintenance release.

== Third-Party Libraries ==

This plugin includes Model Viewer.

Model Viewer
Copyright Google LLC and contributors.

License: Apache License 2.0

Source:
https://github.com/google/model-viewer
