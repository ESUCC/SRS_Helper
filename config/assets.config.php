<?php
/**
 * This configuration should be put in your module `configs` directory.
 */
return [
    'assetic_configuration' => [
        'default' => [
            'assets' => [
               '@head_forms_css',
               '@head_forms_js'
            ],
            'options' => [
                'mixin' => true
            ]
        ],
        
        'modules' => [
            'forms' => [
                'root_path' => __DIR__ . '/../assets',
                'collections' => [
                    'head_forms_css' => [
                        'assets' => [
                            'css/bootstrap.css',
                            'css/forms.css'
                        ],
                        'filters' => [
                            'CssRewriteFilter' => [
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ],
                            '?CssMinFilter' => [
                                'name' => 'Assetic\Filter\CssMinFilter'
                            ]
                        ],
                            
                    ],
                    
                    'head_forms_js' => [
                        'assets' => [
                            
                        ],
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            ),
                        ),
                    ],
                    
                    'base_css' => [
                        'assets' => [
                            'css/forms.css'
                        ]
                    ],
                    
                    'base_images' => [
                        'assets' => [
                            'img/*.png',
                            'img/*.ico',
                        ],
                        'options' => [
                            'move_raw' => true,
                        ]
                    ],
                ],
            ],
        ],
    ],
];
