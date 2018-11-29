<?php

namespace SRS\Forms\Element;

use SRS\Forms\ExtendedElement;

class TinyMCE extends ExtendedElement
{   
    public function __construct($name = null, $options = []){
        parent::__construct($name, $options);
        
        $this->setAttribute('id', $name);
        
        if(!isset($options['mode'])){
            $options['mode'] = 'basic';
        }
        
        switch($options['mode']){
            case 'basic':
                $this->setInlineJsConfig('menubar', "false");
                $this->setInlineJsConfig('plugins', "[
              'advlist autolink lists link image charmap print preview anchor textcolor',
              'searchreplace visualblocks code fullscreen',
              'insertdatetime media table contextmenu paste code help wordcount'
            ]");
                $this->setInlineJsConfig('toolbar', "'undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | print | help | nanospell'");
                $this->setInlineJsConfig('external_plugins', '{"nanospell": "/js/libs/tinymce/js/tinymce/plugins/nanospell/plugin.js"}');
                $this->setInlineJsConfig('nanospell_server', '"php"');
                $this->setInlineJsConfig('nanospell_autostart', 'true');
            break;
        }
    }
    
    public function setMinHeight($height){
        $this->setInlineJsConfig('min_height', $height);
    }
    
    protected $attributes = array(
        'type' => 'tinymce',
    );

    /**
    *
    * Override disabled attribute for TinyMCE. The rest attributes applied natively
    *
    */
    public function setAttribute($key, $value)
    {
        if ($key == 'disabled')
        {
            $this->setInlineJsConfig('readonly', $value);
        }
        else
        {
            parent::setAttribute($key, $value);
        }
    }
}