=== WPSketchupView ===
Contributors: lbettero
Tags: sketchup, glb, 3d, model-viewer, gutenberg
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 8.1
Stable tag: 0.2.1
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Display interactive SketchUp models exported as GLB files and inspect uploaded models in WordPress administration.

== Description ==

WPSketchupView displays interactive GLB models with a native Gutenberg block, shortcode and a read-only administration gallery.

The Meshes screen discovers GLB files in the configured subdirectory of WordPress uploads. The default subdirectory is `mesh` and can be changed with the `wpsketchupview_models_directory` filter.

== Features ==

* Native Gutenberg block and shortcode.
* Interactive 3D viewer with camera controls.
* Read-only Meshes screen in WordPress administration.
* Responsive model gallery.
* Local, pinned Model Viewer runtime.
* Localized administration interface.

== Installation ==

1. Upload the plugin to the `/wp-content/plugins/` directory.
2. Activate it through the **Plugins** screen in WordPress.
3. Upload GLB files to the `mesh` subdirectory of WordPress uploads or add a block with an HTTP(S) model URL.
4. Open **3D Models** in WordPress administration or add the WPSketchupView block to a post.

== Frequently Asked Questions ==

= Which formats are supported? =

The viewer and gallery currently support GLB files.

= Can the model directory be changed? =

Yes. Use the `wpsketchupview_models_directory` filter to return another uploads subdirectory name.

== Changelog ==

= 0.2.1 =

* Replaced the invalid local asset with the official Model Viewer 4.1.0 bundle and license.
* Removed direct CDN script injection and centralized WordPress asset loading.
* Restricted block and shortcode sources to absolute HTTP(S) URLs.
* Added security regression tests and deployment guidance.

= 0.2.0 =

* Added a read-only Meshes administration screen.
* Added automatic GLB discovery in the configured uploads subdirectory.
* Added a responsive interactive model gallery and localization support.

= 0.1.1 =

* Improved WordPress.org documentation and third-party library information.

= 0.1.0 =

* Initial interactive GLB viewer release.

== Upgrade Notice ==

= 0.2.1 =

Security and reliability update. Upgrade to use the verified local viewer runtime and consistent URL validation.

== Third-Party Libraries ==

Model Viewer
Copyright Google LLC and contributors.

Bundled version: 4.1.0
License: Apache License 2.0
Bundled license: `assets/js/model-viewer.LICENSE.txt`
Source: https://github.com/google/model-viewer
