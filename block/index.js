(function (blocks, blockEditor, components, element, i18n) {
	'use strict';

	const { registerBlockType } = blocks;
	const { useBlockProps } = blockEditor;
	const { TextControl, Placeholder } = components;
	const { createElement } = element;
	const { __ } = i18n;

	registerBlockType('wpsketchupview/viewer', {
		edit: function (props) {
			const blockProps = useBlockProps();
			const src = props.attributes.src || '';

			const urlField = createElement(TextControl, {
				label: __('GLB file URL', 'wpsketchupview'),
				help: __(
					'Paste the complete URL of the GLB file.',
					'wpsketchupview'
				),
				type: 'url',
				value: src,
				onChange: function (value) {
					props.setAttributes({
						src: value
					});
				}
			});

			if (!src) {
				return createElement(
					'div',
					blockProps,
					createElement(
						Placeholder,
						{
							label: __('WPSketchupView', 'wpsketchupview'),
							instructions: __(
								'Paste the URL of a GLB model to display it.',
								'wpsketchupview'
							)
						},
						urlField
					)
				);
			}

			return createElement(
				'div',
				blockProps,
				urlField,
				createElement('model-viewer', {
					src: src,
					alt: __('Interactive 3D model', 'wpsketchupview'),
					'camera-controls': true,
					'touch-action': 'pan-y',
					style: {
						display: 'block',
						width: '100%',
						height: '500px'
					}
				})
			);
		},

		save: function () {
			return null;
		}
	});
})(
	window.wp.blocks,
	window.wp.blockEditor,
	window.wp.components,
	window.wp.element,
	window.wp.i18n
);