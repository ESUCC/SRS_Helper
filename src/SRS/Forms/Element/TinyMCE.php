<?php

namespace SRS\Forms\Element;

use SRS\Forms\ExtendedElement;

class TinyMCE extends ExtendedElement
{   
    public function __construct($name = null, $options = []){
        parent::__construct($name, $options);
        
        //$this->setAttribute('id', $name);
        
        if(!isset($options['mode'])){
            $options['mode'] = 'basic';
        }
        
        switch($options['mode']){
            case 'basic':
                $this->setInlineJsConfig('menubar', "false");
                $this->setInlineJsConfig('plugins', "[
              'advlist autolink lists link image charmap print preview anchor textcolor',
              'searchreplace visualblocks code fullscreen',
              'insertdatetime media table contextmenu paste code help wordcount autoresize'
            ]");
                $this->setInlineJsConfig('toolbar', "'undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | print | help | nanospell | table | image'");
                $this->setInlineJsConfig('external_plugins', '{"nanospell": "/js/libs/tinymce/js/tinymce/plugins/nanospell/plugin.js"}');
                $this->setInlineJsConfig('nanospell_server', '"php"');
                $this->setInlineJsConfig('nanospell_autostart', 'true');
                $this->setInlineJsConfig('images_upload_url', '"upload.php"');
                $this->setInlineJsConfig('relative_urls', 'false');
                $this->setInlineJsConfig('autoresize_on_init', 'false');
                
                $this->setInlineJsConfig('setup', 'function (editor) {
            editor.on("change", function () {
                $(editor.getElement()).change();
            });
        }');
                
                $this->setInlineJsConfig('images_upload_handler', 'function (blobInfo, success, failure) {
        var xhr, formData;
      
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open("POST", "/tinymce_upload.php");
      
        xhr.onload = function() {
            var json;
        
            if (xhr.status != 200) {
                failure("HTTP Error: " + xhr.status);
                return;
            }
        
            json = JSON.parse(xhr.responseText);
        
            if (!json || typeof json.location != "string") {
                failure("Invalid JSON: " + xhr.responseText);
                return;
            }
        
            success(json.location);
        };
      
        formData = new FormData();
        formData.append("file", blobInfo.blob(), blobInfo.filename());
      
        xhr.send(formData);
    }');
            break;
        }
                
                // without images_upload_url set, Upload tab won't show up
    
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