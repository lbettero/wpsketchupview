=== WPSketchupView ===
Contributors: lbettero
Tags: sketchup, glb, 3d, model-viewer, gutenberg
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 8.1
Stable tag: 0.2.0
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Display interactive SketchUp GLB models and inspect uploaded meshes in WordPress administration.

== Description ==

WPSketchupView displays interactive GLB models with the bundled Model Viewer library.

The Meshes administration screen discovers GLB files in the configured subdirectory of the WordPress uploads directory. The default subdirectory is `mesh` and can be changed with the `wpsketchupview_models_directory` filter.

== Installation ==

1. Upload the plugin to the `/wp-content/plugins/` directory.
2. Activate it through the **Plugins** screen in WordPress.
3. Upload GLB files to the `mesh` subdirectory of the WordPress uploads directory.
4. Open **Meshes** in the WordPress administration menu.

== Frequently Asked Questions ==

= Which formats are supported? =

The gallery currently discovers GLB files.

= Can the model directory be changed? =

Yes. Use the `wpsketchupview_models_directory` filter to return another uploads subdirectory name.

== Changelog ==

= 0.2.0 =

* Added the read-only Meshes administration screen.
* Added responsive model cards.
* Added configurable uploads subdirectory discovery.
* Removed the remote front-end dependency.

= 0.1.1 =

* Improved WordPress.org documentation.
* General maintenance.

== Third-Party Libraries ==

Model Viewer
Copyright Google LLC and contributors.
License: Apache License 2.0
Source: https://github.com/google/model-viewer
