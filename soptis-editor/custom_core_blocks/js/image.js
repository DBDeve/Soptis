addFilter(
    'blocks.registerBlockType',
    'image/add-attributes',
    function (settings, name) {

        // Applica gli attributi SOLO al blocco core/image
        if (name !== 'core/image') {
            return settings;
        }

        settings.attributes = {
            ...settings.attributes,

            fetchPriority: { type: 'string', default: 'auto' },
            loading: { type: 'string', default: 'lazy' }
        };

        return settings;
    }
);



addFilter(
    'editor.BlockEdit',
    'image/add-attr-image',
    function (BlockEdit) {
        return function (props) {
            const { attributes, setAttributes, name } = props;

            // MOSTRA i controlli SOLO per core/image
            if (name !== 'core/image') {
                return createElement(BlockEdit, props);
            }

            return createElement(
                Fragment,
                {},
                createElement(BlockEdit, props),
                createElement(
                    InspectorControls,
                    {},
                    createElement(
                        PanelBody,
                        { title: 'Attr immagine' },

                        createElement(SelectControl, {
                            label: 'Fetch priority',
                            value: attributes.fetchPriority,
                            options: [
                                { label: 'high', value: 'high' },
                                { label: 'low', value: 'low' },
                                { label: 'auto', value: 'auto' }
                            ],
                            onChange: (value) => setAttributes({ fetchPriority: value }),
                        }),

                        createElement(SelectControl, {
                            label: 'Loading',
                            value: attributes.loading,
                            options: [
                                { label: 'Lazy', value: 'lazy' },
                                { label: 'Eager', value: 'eager' },
                                { label: 'Auto', value: 'auto' }
                            ],
                            onChange: (value) => setAttributes({ loading: value }),
                        }),
                    )
                )
            );
        };
    }
);


addFilter(
    'blocks.registerBlockType',
    'block-margin-control/override-save',
    function (settings, name) {

        if (name === 'core/image') {

            const originalSave = settings.save;

            settings.save = (props) => {
                const element = originalSave(props);
                if (!element) return element;

                // Trova il tag <img> dentro <figure>
                const img = element.props.children;

                console.log("image",img);

                console.log("props",props.attributes.loading)

                const source = img?.props?.children?.[0]?.props  || img?.props || {};

                const img1 = wp.element.createElement('img', {
                    ...source,
                    loading: props.attributes.loading || source.loading || 'lazy',
                    fetchPriority: props.attributes.fetchPriority || 'auto'
                });

                return img1;
            };
        }

        return settings;
    }
);

