<?php

return [

    'view_helpers' => [
        'aliases' => [
            'formRenderer' => \SRS\Forms\View\Helper\FormRenderer::class
        ],
        'invokables' => [
            'slugify' => \Makersoft\Forms\View\Helper\Slugify::class,
            'SRSFormSelect' => \SRS\Forms\View\Helper\SRSFormSelect::class,
        ],
        'shared' => [
            'formRenderer' => false,
        ],
        'factories' => [
            \SRS\Forms\View\Helper\FormRenderer::class => \SRS\Forms\Factory\View\Helper\FormRendererFactory::class
        ]
    ],
    'form_elements' => [
        'factories' => [
            //\SRS\Forms\Element\DatePicker::class => 
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'ReverseFormElements' => __DIR__ . '/../view/element',
            'RootElements' => '/',
        ],
    ],

    'srs_form' => [
        'settings' => [
            'jsPlaceholderName' => 'srs_form-js-placeholder'
        ],
        \SRS\Forms\Element\SheepItDuplicator::class => [
            'js' => [
                
            ],
            'css' => [
                
            ],
            'template' => 'sheepitduplicator',
            'inlineJs' => "
                if(window.%1\$s_sheepit_obj === undefined) window.%1\$s_sheepit_obj = $('#%1\$s').sheepIt(%2\$s);
            ",
            'inlineJsConfig' => [
                "separator" => '""',
                "allowRemoveLast" => true,
                "allowRemoveCurrent" => true,
                "allowRemoveAll" => true,
                "allowAdd" => true,
                "allowAddN" => true,
                "maxFormsCount" => 10,
                "insertNewForms" => '"before"',
                "afterRemoveCurrent" => '""',
                "indexFormat" => "'m_index_m'",
            ]
        ],
        \SRS\Forms\Element\TinyMCE::class => [
            'js' => [
                
            ],
            'css' => [
                
            ],
            'template' => 'textarea',
            'inlineJs' => "
                tinymce.init(%2\$s);
            ",
            'inlineJsConfig' => [
                
            ]
        ],
        \SRS\Forms\Element\DatePicker::class => [
            'template' => 'datepicker',
            'extended' => [
                'date-format' => 'MM/DD/YYYY'
            ],
            'inlineJs' => "
            $('#%1\$s').periodpicker({
                withoutBottomPanel: true,
                resizeButton: false,
                fullsizeButton: false,
                norange: true,
                cells: [1, 1],
                hideOnBlur: true,
                likeXDSoftDateTimePicker: true,
                formatDecoreDateWithYear: $('#%1\$s').attr('data-date-format'),
                fullsizeOnDblClick: false,
                formatDate: $('#%1\$s').attr('data-date-format')
            });"
        ]
        
    ],
    'service_manager' => [
        'shared' => [
            'renderer.bootstrap' => false
        ],
        'invokables' => [
            'renderer.bootstrap' => SRS\Forms\Renderer\Bootstrap::class,
        ],
    ],
    'asset_manager' => [
        'resolver_configs' => [
            'paths' => [
                __DIR__ . '/../assets/'
            ],
        ],
    ],
];