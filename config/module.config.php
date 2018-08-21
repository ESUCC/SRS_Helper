<?php

require_once __DIR__.'/../../../../config/configurations.local.php';

return [

    'view_helpers' => [
        'invokables' => [
            'slugify' => \Makersoft\Forms\View\Helper\Slugify::class,
            'reverseFormSelect' => \Makersoft\Forms\View\Helper\ReverseFormSelect::class,
            'reverseFormSelectSearch' => \Makersoft\Forms\View\Helper\ReverseFormSelectSearch::class,
            'captchaInputs' => \Makersoft\Forms\View\Helper\CaptchaInputs::class,
        ],
        'shared' => [
            'formRenderer' => false,
        ],
        'factories' => [
            'formRenderer' => \Makersoft\Forms\Factory\View\Helper\FormRendererFactory::class
        ]
    ],

    'view_manager' => [
        'template_path_stack' => [
            'ReverseFormElements' => __DIR__ . '/../view/element',
            'RootElemebts' => BASE_DIR,
        ],
    ],

    'reverse_form' => [

        'settings' => [
            'jsPlaceholderName' => 'reverse-js-placeholder'
        ],

        'Makersoft\Forms\Renderer\Uniform' => [
            'css' => [
                '/uni-form/css/uni-form.css',
                '/uni-form/css/default.uni-form.css'
            ]
        ],

        'Makersoft\Forms\Element\GoogleMapAPI' => [
            'js' => ['https://maps.googleapis.com/maps/api/js?v=3.20'],
            'template' => 'googlemap',
            'inlineJsConfig' => [
                
            ]
        ],
		
        'Makersoft\Forms\Element\SheepItDuplicator' => [
            'js' => [
                //BASE_URL.'/resource/Makersoft/libs/sheepit/jquery.sheepItPlugin.js'
            ],
            'css' => [
                //BASE_URL.'/resource/Makersoft/css/SheepItDuplicator.css'
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
                "afterAdd" => 'function(source, newForm){ $("input", newForm).not(".noStyle").iCheck(window.icheck);}',
                "afterRemoveCurrent" => '""',
                "indexFormat" => "'m_index_m'",
            ]
        ],
        
        'Makersoft\Forms\Element\AutoComplete' => [
            'js' => [
                BASE_URL.'/$-Autocomplete-master/src/jquery.autocomplete.js',
            ],
            'template' => 'auto_complete',
            'inlineJs' => "MyAutocomplete.initialize('#%1\$s', %2\$s);"
            
        ],

        'Makersoft\Forms\Element\JqueryUiDatepicker' => [
            'js' => [
                '/jquery-ui/dist/minified/jquery.ui.core.min.js',
                '/jquery-ui/dist/minified/jquery.ui.datepicker.min.js'
            ],
            'css' => [
                '/jquery-ui/dist/jquery-ui.css'
            ],
            'template' => 'input',
            'inlineJs' => "$('#%1\$s').datepicker(%2\$s);\n"
        ],

        'Makersoft\Forms\Element\JqueryUiDateRangePicker' => [
            'js' => [
                '/jquery-ui/dist/minified/jquery.ui.core.min.js',
                '/jquery-ui/dist/minified/jquery.ui.datepicker.min.js',
                '/$-UI-Date-Range-Picker/js/daterangepicker.$.compressed.js'
            ],
            'css' => [
                '/jquery-ui/dist/jquery-ui.css',
                '/$-UI-Date-Range-Picker/css/ui.daterangepicker.css'
            ],
            'template' => 'input',
            'inlineJs' => "$('#%1\$s').daterangepicker(%2\$s);\n"
        ],

        'Makersoft\Forms\Element\BootstrapDatepicker' => [
            'js' => [
                //BASE_URL.'/resource/Makersoft/libs/datepicker/js/bootstrap-datepicker.js'
            ],
            'css' => [
                //BASE_URL.'/resource/Makersoft/libs/datepicker/css/datepicker.css'
            ],
            'template' => 'input',
            'inlineJs' => "",
            'inlineJsConfig' => [
                'format'	=> 'mm/dd/yy',
                'weekstart'	=> new \Zend\Json\Expr(1),
            ],
        ],

        'Makersoft\Forms\Element\JqueryUiDatetimepicker' => [
            'js' => [
                '/$-Timepicker-Addon/jquery-ui-timepicker-addon.js',
                '/jquery-ui/dist/minified/jquery.ui.widget.min.js',
                '/jquery-ui/dist/minified/jquery.ui.mouse.min.js',
                '/jquery-ui/dist/minified/jquery.ui.slider.min.js'
            ],
            'css' => [
                '/$-Timepicker-Addon/jquery-ui-timepicker-addon.css'
            ],
            'template' => 'input',
            'inlineJs' => "$('#%1\$s').datetimepicker(%2\$s);\n",
            'inlineJsConfig' => [
                'closeText' 	=> 'Zapri',
                'currentText'	=> 'Zdaj',
                'hourText'		=> 'Ura',
                'minuteText'	=> 'Minuta'
            ]
        ],
        
        'Makersoft\Forms\Element\JqueryUiSpinner' => [
            'js' => [
                '/jquery.ui.spinner/ui.spinner.js',
                '/jquery-ui/dist/minified/jquery.ui.widget.min.js',
                '/jquery-ui/dist/minified/jquery.ui.position.min.js',
                '/jquery-ui/dist/minified/jquery.ui.button.min.js',
                '/jquery-ui/dist/minified/jquery.ui.mouse.min.js',
                '/jquery-ui/dist/minified/jquery.ui.slider.min.js'
            ],
            'css' => [
                '/jquery.ui.spinner/ui.spinner.css'
            ],
            'template' => 'input',
            'inlineJs' => "$('#%1\$s').spinner(%2\$s);\n",
            /*
            'inlineJsConfig' => [
                'min' 	    => '',
                'max'	    => '',
                'places'    => '',
                'step'	    => '',
                'largeStep'	=> '',
                'group'	    => '',
                'point'	    => '',
                'prefix'	=> '',
                'suffix'	=> '',
                'className'	=> '',
                'showOn'	=> '',
                'width'	    => '',
                'increment'	=> '',
                'count'	    => '',
                'mult'	    => '',
                'delay'	    => '',
                'mouseWheel'=> '',
                'allowNull'	=> '',
                'format'	=> '',
                'parse'	    => ''
            )
            */
        ],
        
        'Makersoft\Forms\Element\ChosenSelect' => [
            'js' => [
                    '/chosen/chosen/chosen.jquery.min.js'
            ],
            'css' => [
                    '/chosen/chosen/chosen.css'
            ],
            'template' => 'select',
            'inlineJs' => "$('#%1\$s').chosen(%2\$s);\n",
            'inlineJsConfig' => [
                    'no_results_text' => 'No results matched !!!'
            ]
        ],
        
        'Makersoft\Forms\Element\CodeMirror' => [
            'js' => [
                    '/CodeMirror/lib/codemirror.js',
                '/CodeMirror/mode/xml/xml.js',
                '/CodeMirror/mode/javascript/javascript.js',
                '/CodeMirror/mode/css/css.js',
                '/CodeMirror/mode/clike/clike.js',
                '/CodeMirror/mode/php/php.js'
            ],
            'css' => [
                    '/CodeMirror/lib/codemirror.css'
            ],
            'template' => 'textarea',
            'inlineJs' => "var %1\$s = CodeMirror.fromTextArea(document.getElementById('%1\$s'], %2\$s);\n",
            'inlineJsConfig' => [
                'lineNumbers'    => true,
                'matchBrackets'  => true,
                'mode'           => new \Zend\Json\Expr('"application/x-httpd-php"'),
                'indentUnit'     => 4,
                'indentWithTabs' => true,
                'enterMode'      => 'keep',
                'tabMode'        => 'shift'
            ]
        ],
        
        'Makersoft\Forms\Element\TinyMce' => [
            'js' => [
                    //BASE_URL.'/resource/Makersoft/libs/tinymce/js/tinymce/tinymce.min.js'
            ],
            'css' => [
                //BASE_URL.'/resource/Makersoft/libs/dashicons/css/dashicons.css',
                //BASE_URL.'/resource/Makersoft/libs/tinymce/css/editor.min.css'
            ],
            'template' => 'textarea',
            'inlineJs' => " $(document).ready(function() {
                            tinymce.init({
                                relative_urls : false,
                                autoresize_min_height: 400,
                                remove_script_host : false,
                                document_base_url : window.base_url+'/assets/tinymce/js/tinymce/',
                                selector: '#%1\$s',
                                mode : 'exact',
                                oninit : function(ed) {
                                        ed.setContent('\"'+$('#%1\$s').val().replace(/(\\r\\n|\\n|\\r)/gm, \"\")+'\" html', {format : 'raw'});
                                },
                                theme_advanced_font_sizes: '10px,12px,13px,14px,16px,18px,20px',
                                font_size_style_values: '12px,13px,14px,16px,18px,20px',
                                font_formats : 'Nanum Barun Gothic=Nanum Barun Gothic;Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;',
                                plugins: [
                                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                    'searchreplace visualblocks visualchars code fullscreen',
                                    'insertdatetime media nonbreaking save table contextmenu directionality',
                                    'emoticons template paste textcolor colorpicker textpattern autoresize'
                                ],
                                theme_advanced_buttons3_add : 'tablecontrols',
                                table_styles : 'Header 1=header1;Header 2=header2;Header 3=header3',
                                table_cell_styles : 'Header 1=header1;Header 2=header2;Header 3=header3;Table Cell=tableCel1',
                                table_row_styles : 'Header 1=header1;Header 2=header2;Header 3=header3;Table Row=tableRow1',
                                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink image | bootstrap table',
                                toolbar2: 'fontsizeselect fontselect | print preview media | forecolor backcolor emoticons code fullscreen',
                                image_advtab: true,
                                file_picker_callback: function(field_name, url, type, win) {
                                    if(type.filetype =='image'){ $('#upload_mce_form input[type=\"file\"]').click(); $('#upload_mce_form input[name=\"key\"]').val($('input[name=\"key\"]', $('#%1\$s').closest('.form-group')).val());}
                                },
                                valid_elements : \"*[*]\",
                                extended_valid_elements : \"*[*]\",
                                autoresize_bottom_margin : 10,
                                menubar: false,
                                 bootstrapConfig: {
                                 'bootstrapElements': {
                                    'btn': true,
                                    'icon': true,
                                    'template': true,
                                    'panel':true
                                },
                                'imagesPath': '".PUBLIC_DIR."/images/' // replace with your images folder path
                            }
                            });
                        });",
            'inlineJsConfig' => [

            ]
        ],
        'Makersoft\Forms\Element\AjaxUploader' => [
            'js' => [
                BASE_URL.'/libs/mini-upload-form/assets/js/jquery.fileupload.js',
                BASE_URL.'/libs/mini-upload-form/assets/js/jquery.iframe-transport.js',
                BASE_URL.'/libs/mini-upload-form/assets/js/jquery.knob.js',
                BASE_URL.'/libs/mini-upload-form/assets/js/script.js',
            ],
            'css' => [
                BASE_URL.'/libs/mini-upload-form/assets/css/style.css',
            ],
            'template' => 'ajax_uploader',
            'inlineJs' => "",
            'inlineJsConfig' => [

            ]
        ],
        'Makersoft\Forms\Element\JqueryMultiSelect' => [
            'js' => [
                //BASE_URL.'/resource/Makersoft/plugins/forms/dual-list-box/jquery.bootstrap-duallistbox.min.js',
                //BASE_URL.'/libs/quicksearch/jquery.quicksearch.js',
                
            ],
            'css' => [
                //BASE_URL.'/libs/lou-multi-select/css/multielect.css',
            ],
            'template' => 'multiSelect',
            'inlineJs' => "
                $(document).ready(function() {
                    $('#%1\$s').bootstrapDualListbox({
                            nonselectedlistlabel: 'Non-selected',
                            selectedlistlabel: 'Selected',
                            preserveselectiononmove: 'moved',
                            moveonselect: false,
                            iconMove: 'en-arrow-right8 s16',
                            iconMoveAll: 'fa-double-angle-right s16',
                            iconRemove: 'en-arrow-left8 s16',
                            iconRemoveAll: 'fa-double-angle-left s16'
                        });
                    });",
            'inlineJsConfig' => [

            ]
        ],
        'Makersoft\Forms\Element\Croppic' => [
            'js' => [
                BASE_URL.'/resource/Makersoft/plugins/forms/croppic/js/croppic.js',
                
            ],
            'css' => [
                BASE_URL.'/resource/Makersoft/plugins/forms/croppic/css/croppic.css',
            ],
            'template' => 'croppic',
            'inlineJs' => "",
            'inlineJsConfig' => [

            ]
        ],                
        'Makersoft\Forms\Element\JquerySelectSearch' => [
            'js' => [
                //BASE_URL.'/resource/Makersoft/plugins/forms/select2-4.0.0/dist/js/select2.full.min.js',  
            ],
            'css' => [
                //BASE_URL.'/resource/Makersoft/plugins/forms/select2-4.0.0/dist/css/select2.min.css',  
            ],
            'template' => 'selectsearch',
            'inlineJs' => "$('#%1\$s').select2(%2\$s);",
            'inlineJsConfig' => [
            "escapeMarkup" => "function (markup) { return markup; }", // let our custom formatter work
                //"templateResult" =>   "function formatRepo (repo) { if (repo.loading) return repo.text; return '<div>'+repo.name+'</div>';   }",
                //"templateSelection" => "function formatRepoSelection (repo) { return repo.name; }"
            ]
        ],
    ],
    'service_manager' => [
        'shared' => [
            'renderer.bootstrap' => false
        ],
        'invokables' => [
            //'renderer.uniform' => 'Makersoft\Forms\Renderer\Uniform',
            'renderer.bootstrap' => Makersoft\Forms\Renderer\Bootstrap::class,
        ],
    ],
];