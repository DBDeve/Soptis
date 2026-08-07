const { addFilter } = wp.hooks;
const { createElement } = wp.element;
const { __experimentalNumberControl: NumberControl, SelectControl, ColorPicker } = wp.components;

/* ----------------------------------------------------------
   1. AGGIUNGI ATTRIBUTI A TUTTI I BLOCCHI
---------------------------------------------------------- */
addFilter(
    'blocks.registerBlockType',
    'block-margin-control/add-attributes',
    function (settings, name) {

        settings.attributes = {
            ...settings.attributes,
            marginTop: { type: 'string', default: '10' },
            marginBottom: { type: 'string', default: '10' },
            marginLeft: { type: 'string', default: '10' },
            marginRight: { type: 'string', default: '10' }
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
                        { title: 'Margine' },
                        createElement(NumberControl, {
                            label: 'Margin top (px)',
                            value: attributes.marginTop,
                            onChange: (value) => setAttributes({ marginTop: value }),
                            min: 0
                        }),
                        createElement(NumberControl, {
                            label: 'Margin bottom (px)',
                            value: attributes.marginBottom,
                            onChange: (value) => setAttributes({ marginBottom: value }),
                            min: 0
                        }),
                        createElement(NumberControl, {
                            label: 'Margin left (px)',
                            value: attributes.marginLeft,
                            onChange: (value) => setAttributes({ marginLeft: value }),
                            min: 0
                        }),
                        createElement(NumberControl, {
                            label: 'Margin right (px)',
                            value: attributes.marginRight,
                            onChange: (value) => setAttributes({ marginRight: value }),
                            min: 0
                        })
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
                marginTop: (attributes.marginTop || 0) + 'px',
                marginBottom: (attributes.marginBottom || 0) + 'px',
                marginLeft: (attributes.marginLeft || 0) + 'px',
                marginRight: (attributes.marginRight || 0) + 'px',
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
                        '--block-margin-top': props.attributes.marginTop + 'px',
                        '--block-margin-bottom': props.attributes.marginBottom + 'px',
                        '--block-margin-left': props.attributes.marginLeft + 'px',
                        '--block-margin-right': props.attributes.marginRight + 'px',
                    }
                });
            };
        }

        return settings;
    }
);
