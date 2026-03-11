const { addFilter } = wp.hooks;
const { createElement } = wp.element;
const { __experimentalNumberControl: NumberControl, SelectControl, ColorPicker } = wp.components;

const { registerBlockType } = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, TextControl } = wp.components;
const { Fragment } = wp.element;
const { MediaUpload, MediaUploadCheck } = wp.blockEditor;
const { Button } = wp.components;

/* ----------------------------------------------------------
   1. AGGIUNGI ATTRIBUTI A TUTTI I BLOCCHI
---------------------------------------------------------- */
addFilter(
    'blocks.registerBlockType',
    'block-margin-control/add-attributes',
    function (settings, name) {

        settings.attributes = {
            ...settings.attributes,
            margin: { type: 'string', default: '10' },
            padding: { type: 'string', default: '10' },
        };

        return settings;
    }
);

/* ----------------------------------------------------------
   2. AGGIUNGI I CONTROLLI NELL’INSPECTOR
---------------------------------------------------------- */
addFilter(
    'editor.BlockEdit',
    'block-margin-control/add-margin-field',
    function (BlockEdit) {
        return function (props) {
            const { attributes, setAttributes } = props;

            return createElement(
                Fragment,
                {},
                createElement(BlockEdit, props),
                createElement(
                    InspectorControls,
                    {},
                    createElement(
                        PanelBody,
                        { title: 'Layout' },
                        createElement(NumberControl, {
                            label: 'padding (px)',
                            value: attributes.padding,
                            onChange: (value) => setAttributes({ padding: value }),
                            min: 0
                        }),
                        createElement(NumberControl, {
                            label: 'Margin (px)',
                            value: attributes.margin,
                            onChange: (value) => setAttributes({ margin: value }),
                            min: 0
                        }),
                    )
                )
            );
        };
    }
);

/* ----------------------------------------------------------
   3. APPLICA I MARGINI NELL'EDITOR (SOLO PER VISUALIZZAZIONE, NON NEL MARKUP SALVATO)
---------------------------------------------------------- */
addFilter(
    'editor.BlockListBlock',
    'block-margin-control/add-margins',
    (BlockListBlock) => {
        return (props) => {
            const { attributes } = props;

            const style = {
                margin: (attributes.margin || 0) + 'px',
                padding: (attributes.padding || 0) + 'px',
            };

            return wp.element.createElement(BlockListBlock, {
                ...props,
                wrapperProps: {
                    ...props.wrapperProps,
                    style: {
                        ...(props.wrapperProps?.style || {}),
                        ...style
                    }
                }
            });
        };
    }
);




/* ----------------------------------------------------------
   4. APPLICA I MARGINI NELLA PAGINA GENERATA
---------------------------------------------------------- */
addFilter(
    'blocks.registerBlockType',
    'block-margin-control/override-save',
    function (settings, name) {

        // Applica solo ai blocchi core (o solo a quelli che vuoi)
        if (name.startsWith('core/')) {

            const originalSave = settings.save;

            settings.save = (props) => {
                const element = originalSave(props);

                return wp.element.cloneElement(element, {
                    style: {
                        ...(element.props.style || {}),
                        '--block-margin': props.attributes.margin + 'px',
                        '--block-padding': props.attributes.padding + 'px',
                        
                    }
                });
            };
        }

        return settings;
    }
);
