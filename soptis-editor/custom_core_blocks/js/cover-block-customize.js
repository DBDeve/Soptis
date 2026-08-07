addFilter(
    'blocks.registerBlockType',
    'image/add-attributes',
    function (settings, name) {

        // Applica gli attributi SOLO al blocco core/image
        if (name !== 'core/cover') {
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
            if (name !== 'core/cover') {
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
                            label: 'Fetch Priority',
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

        if (name === 'core/cover') {

            const originalSave = settings.save;

            settings.save = (props) => {
                const element = originalSave(props);
                if (!element) return element;

                const childs = React.Children.toArray(element.props.children);

                const img = childs.find(child => child.type === 'img');
                if (img) {

                    img.props.loading = props.attributes.loading || 'lazy';
                    img.props.fetchPriority = props.attributes.fetchPriority || 'auto';

                }

                // Ricrea l'elemento originale con i nuovi children
                return wp.element.cloneElement(element, {}, childs);
            };
        }

        return settings;
    }
);

