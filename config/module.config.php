<?php

return [

    'view_helpers' => [
        'invokables' => [
            'SRSFormSelect' => \SRS\Forms\View\Helper\SRSFormSelect::class,
        ],
        'shared' => [
            'formRenderer' => false,
        ],
        'factories' => [
            'formRenderer' => \SRS\Forms\Factory\View\Helper\FormRendererFactory::class
        ]
    ],

    'view_manager' => [
        'template_path_stack' => [
            'ReverseFormElements' => __DIR__ . '/../view/element',
            'RootElemebts' => '/',
        ],
    ],

    'srs_form' => [
        'settings' => [
            'jsPlaceholderName' => 'srs_form-js-placeholder'
        ],
        'SRS\Forms\Element\SheepItDuplicator' => [
            'js' => [
                
            ],
            'css' => [
                
            ],
            'template' => 'sheepitduplicator',
            'inlineJs' => " $(document).ready(function() {
                                if(window.%1\$s_sheepit_obj === undefined) window.%1\$s_sheepit_obj = $('#%1\$s').sheepIt(%2\$s);
                            });",
            'inlineJsConfig' => [
                "separator" => '""',
                "allowRemoveLast" => true,
                "allowRemoveCurrent" => true,
                "allowRemoveAll" => true,
                "allowAdd" => true,
                "allowAddN" => true,
                "maxFormsCount" => 10,
                "insertNewForms" => '"before"',
                //"afterAdd" => 'function(source, newForm){ $("input", newForm).not(".noStyle").iCheck(window.icheck);}',
                "afterRemoveCurrent" => '""',
                "indexFormat" => "'m_index_m'",
            ]
        ],
        
        
    ],
    'service_manager' => [
        'shared' => [
            'renderer.bootstrap' => false
        ],
        'invokables' => [
            'renderer.bootstrap' => SRS\Forms\Renderer\Bootstrap::class,
        ],
    ],
];