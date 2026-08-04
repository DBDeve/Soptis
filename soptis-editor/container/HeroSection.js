



registerBlockType('tuo-tema/hero', {
    apiVersion: 3,
    title: 'hero section',
    icon: 'admin-generic',
    category: 'container',

    attributes: {

        heroTitle:{ type: 'string', default: 'titolo di prova'},
        heroDescription:{ type: 'string', default: 'descrizione di prova'},
        heroButton1: { type: 'string', default: 'bottone di prova'},
        heroButton2: { type: 'string', default: 'bottone di prova'},

        '--hero-section-margin-top': { type: 'string', default: '0px' },
        '--hero-section-margin-right': { type: 'string', default: '0px' },
        '--hero-section-margin-bottom': { type: 'string', default: '0px' },
        '--hero-section-margin-left': { type: 'string', default: '0px' },

        '--hero-section-padding-top': { type: 'string', default: '10px' },
        '--hero-section-padding-right': { type: 'string', default: '10px' },
        '--hero-section-padding-bottom': { type: 'string', default: '10px' },
        '--hero-section-padding-left': { type: 'string', default: '10px' },

        '--hero-background-color': { type: 'string', default: 'transparent' },

        backgroundImage:{ type: 'string', default: ''}
        
    },

    edit({ attributes, setAttributes }) {
        const { 
            heroTitle,
            heroDescription,
            heroButton1,
            heroButton2,

            '--hero-section-margin-top': marginTop, 
            '--hero-section-margin-right':marginRight,
            '--hero-section-margin-bottom':marginBottom,
            '--hero-section-margin-left':marginLeft,

            '--hero-section-padding-top': paddingTop,
            '--hero-section-padding-right': paddingRight,
            '--hero-section-padding-bottom': paddingBottom,
            '--hero-section-padding-left': paddingLeft,

            '--hero-background-color': backgroundColor,

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
                    /// title setting ///
                    el(
                        PanelBody,
                        {
                            title: 'title',
                            className: 'block-editor-block-inspector__advanced',
                            initialOpen: false
                        },
                        el(
                            TextControl, {
                                label: 'content',
                                value: heroTitle,
                                onChange: (value) => setAttributes({ heroTitle:value }),
                                placeholder: 'inserisci nome'
                            }
                        ),
                    ),
                    /// description setting ///
                    el(
                        PanelBody,
                        {
                            title: 'description',
                            className: 'block-editor-block-inspector__advanced',
                            initialOpen: false
                        },
                        el(
                            TextControl, {
                                label: 'content',
                                value: heroDescription,
                                onChange: (value) => setAttributes({ heroDescription:value }),
                                placeholder: 'inserisci descrizione'
                            }
                        ),
                    ),
                    /// margin setting ///
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
                                onChange: (value) => setAttributes({ '--hero-section-margin-top':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        ),
                        el(
                            TextControl, {
                                label: 'Margin right',
                                value: marginRight,
                                onChange: (value) => setAttributes({ '--hero-section-margin-right':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        ),
                        el(
                            TextControl, {
                                label: 'Margin bottom',
                                value: marginBottom,
                                onChange: (value) => setAttributes({ '--hero-section-margin-bottom':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        ),
                        el(
                            TextControl, {
                                label: 'Margin left',
                                value: marginLeft,
                                onChange: (value) => setAttributes({ '--hero-section-margin-left':value }),
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
                                onChange: (value) => setAttributes({ '--hero-section-padding-top':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        ),
                        el(
                            TextControl, {
                                label: 'padding right',
                                value: paddingRight,
                                onChange: (value) => setAttributes({ '--hero-section-padding-right':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        ),
                        el(
                            TextControl, {
                                label: 'padding bottom',
                                value: paddingBottom,
                                onChange: (value) => setAttributes({ '--hero-section-padding-bottom':value }),
                                placeholder: 'es: 20px 10px'
                            }
                        ),
                        el(
                            TextControl, {
                                label: 'padding left',
                                value: paddingLeft,
                                onChange: (value) => setAttributes({ '--hero-section-padding-left':value }),
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
                                color: attributes['--hero-background-color'], 
                                onChangeComplete: (value) => setAttributes({ '--hero-background-color': value.hex }), 
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
                        id:'HeroSection',
                        style:{

                            '--hero-section-margin-top': marginTop,
                            '--hero-section-margin-right':marginRight,
                            '--hero-section-margin-bottom':marginBottom,
                            '--hero-section-margin-left':marginLeft,

                            '--hero-section-padding-top': paddingTop,
                            '--hero-section-padding-right': paddingRight,
                            '--hero-section-padding-bottom': paddingBottom,
                            '--hero-section-padding-left': paddingLeft,

                            '--hero-background-color': backgroundColor,
                        }, 
                
                    },
                    [heroTitle && el('h1',{},heroTitle)],
                    [heroDescription && el('p',{},heroDescription)],
                    [ backgroundImage && el('img', { id:"heroBackgroundImage", src: backgroundImage }) ],
                    el(wp.blockEditor.InnerBlocks),

                )
            ]
        );
    },

    save({ attributes }) {
        const {

            heroTitle,
            heroDescription,


            '--hero-section-margin-top': marginTop, 
            '--hero-section-margin-right':marginRight,
            '--hero-section-margin-bottom':marginBottom,
            '--hero-section-margin-left':marginLeft,
            
            '--hero-section-padding-top': paddingTop,
            '--hero-section-padding-right': paddingRight,
            '--hero-section-padding-bottom': paddingBottom,
            '--hero-section-padding-left': paddingLeft,

            '--hero-background-color': backgroundColor,

            backgroundImage,


        } = attributes;


        return el(
            'div',
            {   
                id:'HeroSection',
                style:{

                    '--hero-section-margin-top': marginTop,
                    '--hero-section-margin-right':marginRight,
                    '--hero-section-margin-bottom':marginBottom,
                    '--hero-section-margin-left':marginLeft,

                    '--hero-section-padding-top': paddingTop,
                    '--hero-section-padding-right': paddingRight,
                    '--hero-section-padding-bottom': paddingBottom,
                    '--hero-section-padding-left': paddingLeft,

                    '--hero-background-color': backgroundColor


                },
                
            },
            [heroTitle && el('h1',{},heroTitle)],
            [heroDescription && el('p',{},heroDescription)],
            [ backgroundImage && el('img', { id:"heroBackgroundImage" , src: backgroundImage, alt:"Background image", title:"Background image", fetchPriority:"high", loading:"eager", height:"auto", width:"auto" }) ],
            el(wp.blockEditor.InnerBlocks.Content)
        );
    }
});
