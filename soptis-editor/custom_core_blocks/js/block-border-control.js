let allowed_blocks = [
    'core/group',
    'core/columns',
    'core/column',
    'core/cover',
    'core/media-text',
    'core/row',
    'core/stack',
    'core/grid',
];

/* ----------------------------------------------------------
   1. AGGIUNGI ATTRIBUTI A TUTTI I BLOCCHI
---------------------------------------------------------- */
addFilter(
    'blocks.registerBlockType',
    'block-margin-control/add-attributes',
    function (settings, name) {

        if (!allowed_blocks.includes(name)) {
            return settings; // NON aggiungere attributi
        }

        settings.attributes = {
            ...settings.attributes,
            borderWidth: { type: 'string', default: '0' },
            borderRadius: { type: 'string', default: '0' },
            borderColor: { type: 'string', default: 'black' },
            borderStyle: { type: 'string', default: 'solid' }
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

            if (!allowed_blocks.includes(props.name)) {
                return createElement(BlockEdit, props);
            }

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
                        { title: 'Border' },
                        createElement(NumberControl, {
                            label: 'Border width (px)',
                            value: attributes.borderWidth,
                            onChange: (value) => setAttributes({ borderWidth: value }),
                            min: 0
                        }),
                        createElement(NumberControl, {
                            label: 'Border radius (px)',
                            value: attributes.borderRadius,
                            onChange: (value) => setAttributes({ borderRadius: value }),
                            min: 0
                        }),
                        //rivedere
                        createElement(ColorPicker, {
                            color: attributes.borderColor,
                            onChangeComplete: (value) => setAttributes({ borderColor: value.hex }),
                            disableAlpha: false,
                        }),
                        createElement(SelectControl, {
                            label: 'Border style',
                            value: attributes.borderStyle,
                            onChange: (value) => setAttributes({ borderStyle: value }),
                            options: [
                                { label: 'Solid', value: 'solid' },
                                { label: 'Dashed', value: 'dashed' },
                                { label: 'Dotted', value: 'dotted' }
                            ]
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

            if (!allowed_blocks.includes(props.name)) {
                return createElement(BlockListBlock, props);
            }

            const { attributes } = props;

            const style = {
                borderWidth: (attributes.borderWidth || 0) + 'px',
                borderRadius: (attributes.borderRadius || 0) + 'px',
                borderColor: attributes.borderColor || 'black',
                borderStyle: attributes.borderStyle || 'solid'
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

        if (!allowed_blocks.includes(name)) {
            return settings;
        }

        const originalSave = settings.save;

        settings.save = (props) => {
            const element = originalSave(props);

            return wp.element.cloneElement(element, {
                style: {
                    ...(element.props.style || {}),
                    '--block-border-width': props.attributes.borderWidth + 'px',
                    '--block-border-radius': props.attributes.borderRadius + 'px',
                    '--block-border-color': props.attributes.borderColor || 'black',
                    '--block-border-style': props.attributes.borderStyle || 'solid'
                }
            });
        };
        

        return settings;
    }
);