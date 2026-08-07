const { registerBlockType } = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const { TextControl } = wp.components;
const { createElement: el } = wp.element;
const { MediaUpload, MediaUploadCheck } = wp.blockEditor;



registerBlockType('tuo-tema/contenitore', {
    apiVersion: 3,
    title: 'block container',
    icon: 'admin-generic',
    category: 'container',

    attributes: {

        '--container-margin-top': { type: 'string', default: '5px' },
        '--container-margin-right': { type: 'string', default: '5px' },
        '--container-margin-bottom': { type: 'string', default: '5px' },
        '--container-margin-left': { type: 'string', default: '5px' },

        '--container-padding-top': { type: 'string', default: '5px' },
        '--container-padding-right': { type: 'string', default: '5px' },
        '--container-padding-bottom': { type: 'string', default: '5px' },
        '--container-padding-left': { type: 'string', default: '5px' },

        '--container-background-color': { type: 'string', default: 'transparent' },

        backgroundImage:{ type: 'string', default: ''}
        
    },

    edit({ attributes, setAttributes }) {
        const { 
            '--container-margin-top': marginTop, 
            '--container-margin-right':marginRight,
            '--container-margin-bottom':marginBottom,
            '--container-margin-left':marginLeft,

            '--container-padding-top': paddingTop,
            '--container-padding-right': paddingRight,
            '--container-padding-bottom': paddingBottom,
            '--container-padding-left': paddingLeft,

            '--container-background-color': backgroundColor,

            backgroundImage,

        } = attributes;

        return el(
            Fragment,
            {},
            [
                // 🎛 Aggiungo il campo nella sezione "Avanzate"
                el(
                    InspectorControls,
                    {},
                    el(
                        PanelBody,
                        {
                            title: 'margin',
                            className: 'block-editor-block-inspector__advanced',
                            initialOpen: false
                        },
                        el(
                            TextControl, {
                                label: 'Margin top',
                                value: marginTop,
                                onChange: (value) => setAttributes({ '--container-margin-top':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        ),
                        el(
                            TextControl, {
                                label: 'Margin right',
                                value: marginRight,
                                onChange: (value) => setAttributes({ '--container-margin-right':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        ),
                        el(
                            TextControl, {
                                label: 'Margin bottom',
                                value: marginBottom,
                                onChange: (value) => setAttributes({ '--container-margin-bottom':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        ),
                        el(
                            TextControl, {
                                label: 'Margin left',
                                value: marginLeft,
                                onChange: (value) => setAttributes({ '--container-margin-left':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        )
                    ),
                    el(
                        PanelBody,
                        {
                            title: 'padding',
                            className: 'block-editor-block-inspector__advanced',
                            initialOpen: false
                        },
                        el(
                            TextControl, {
                                label: 'padding top',
                                value: paddingTop,
                                onChange: (value) => setAttributes({ '--container-padding-top':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        ),
                        el(
                            TextControl, {
                                label: 'padding right',
                                value: paddingRight,
                                onChange: (value) => setAttributes({ '--container-padding-right':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        ),
                        el(
                            TextControl, {
                                label: 'padding bottom',
                                value: paddingBottom,
                                onChange: (value) => setAttributes({ '--container-padding-bottom':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        ),
                        el(
                            TextControl, {
                                label: 'padding left',
                                value: paddingLeft,
                                onChange: (value) => setAttributes({ '--container-padding-left':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        )
                    ),
                    el(
                        PanelBody,
                        {
                            title: 'background',
                            className: 'block-editor-block-inspector__advanced',
                            initialOpen: false
                        },
                        el(
                            wp.components.ColorPicker, { 
                                label: 'color',
                                color: attributes['--container-background-color'], 
                                onChangeComplete: (value) => setAttributes({ '--container-background-color': value.hex }), 
                                disableAlpha: false 
                            }
                        ),
                        el(
                            MediaUploadCheck,
                            {},
                            el(
                                MediaUpload,
                                {
                                    onSelect: (media) => setAttributes({ backgroundImage: media.url }),
                                    allowedTypes: ['image'],
                                    render: ({ open }) =>
                                        el(
                                            wp.components.Button,
                                            { onClick: open, isPrimary: true },
                                            'Seleziona immagine'
                                        )
                                }
                            )
                        )

                    )
                ),

                // 🧱 Contenuto del blocco
                el(
                    'div',
                    {  
                        style:{

                            '--container-margin-top': marginTop,
                            '--container-margin-right':marginRight,
                            '--container-margin-bottom':marginBottom,
                            '--container-margin-left':marginLeft,

                            '--container-padding-top': paddingTop,
                            '--container-padding-right': paddingRight,
                            '--container-padding-bottom': paddingBottom,
                            '--container-padding-left': paddingLeft,

                            '--container-background-color': backgroundColor,
                        }, 
                        className: `BlockContainer layoutContainer`, 
                    },
                    [ backgroundImage && el('img', { src: backgroundImage, className: 'BackgroundImage' }) ],
                    el(wp.blockEditor.InnerBlocks),

                )
            ]
        );
    },

    save({ attributes }) {
        const {

            '--container-margin-top': marginTop, 
            '--container-margin-right':marginRight,
            '--container-margin-bottom':marginBottom,
            '--container-margin-left':marginLeft,
            
            '--container-padding-top': paddingTop,
            '--container-padding-right': paddingRight,
            '--container-padding-bottom': paddingBottom,
            '--container-padding-left': paddingLeft,

            '--container-background-color': backgroundColor,

            backgroundImage,


        } = attributes;


        return el(
            'div',
            {   
                style:{

                    '--container-margin-top': marginTop,
                    '--container-margin-right':marginRight,
                    '--container-margin-bottom':marginBottom,
                    '--container-margin-left':marginLeft,

                    '--container-padding-top': paddingTop,
                    '--container-padding-right': paddingRight,
                    '--container-padding-bottom': paddingBottom,
                    '--container-padding-left': paddingLeft,

                    '--container-background-color': backgroundColor


                }, 
                className:`BlockContainer layoutContainer`
            },
            [ backgroundImage && el('img', { src: backgroundImage, className: 'BackgroundImage' }) ],
            el(wp.blockEditor.InnerBlocks.Content)
        );
    }
});
