

/* ----------------------------------------------------------
   1. AGGIUNGI ATTRIBUTI A TUTTI I BLOCCHI
---------------------------------------------------------- */
addFilter(
    'blocks.registerBlockType',
    'block-margin-control/add-attributes',
    function (settings, name) {

        settings.attributes = {
            ...settings.attributes,
            paddingTop: { type: 'string', default: '10' },
            paddingBottom: { type: 'string', default: '10' },
            paddingLeft: { type: 'string', default: '10' },
            paddingRight: { type: 'string', default: '10' }
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
                        { title: 'Padding' },
                        createElement(NumberControl, {
                            label: 'padding top (px)',
                            value: attributes.paddingTop,
                            onChange: (value) => setAttributes({ paddingTop: value }),
                            min: 0
                        }),
                        createElement(NumberControl, {
                            label: 'padding bottom (px)',
                            value: attributes.paddingBottom,
                            onChange: (value) => setAttributes({ paddingBottom: value }),
                            min: 0
                        }),
                        createElement(NumberControl, {
                            label: 'padding left (px)',
                            value: attributes.paddingLeft,
                            onChange: (value) => setAttributes({ paddingLeft: value }),
                            min: 0
                        }),
                        createElement(NumberControl, {
                            label: 'padding right (px)',
                            value: attributes.paddingRight,
                            onChange: (value) => setAttributes({ paddingRight: value }),
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

                paddingTop: (attributes.paddingTop || 0) + 'px',
                paddingBottom: (attributes.paddingBottom || 0) + 'px',
                paddingLeft: (attributes.paddingLeft || 0) + 'px',
                paddingRight: (attributes.paddingRight || 0) + 'px',
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
                        '--block-padding-top': props.attributes.paddingTop + 'px',
                        '--block-padding-bottom': props.attributes.paddingBottom + 'px',
                        '--block-padding-left': props.attributes.paddingLeft + 'px',
                        '--block-padding-right': props.attributes.paddingRight + 'px',
                    }
                });
            };
        }

        return settings;
    }
);
