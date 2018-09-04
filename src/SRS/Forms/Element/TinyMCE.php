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
                $this->setInlineJsConfig('toolbar', "'undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | print | help'");
            break;
        }
        
        $this->setInlineJsConfig('selector', "'#".$name."'");
        
    }
    
    public function setMinHeight($height){
        $this->setInlineJsConfig('min_height', $height);
    }
    
    protected $attributes = array(
        'type' => 'tinymce',
    );
}