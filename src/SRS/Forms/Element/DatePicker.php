<?php

namespace SRS\Forms\Element;

use SRS\Forms\ExtendedElement;

class DatePicker extends ExtendedElement
{    
    public function __construct($name = null, $options = []){
        parent::__construct($name, $options);
        
        $extended = isset($options['extended']) ? $options['extended'] : [];
        
        if(isset($extended['custom_inlineConfig'])){
            foreach($extended['custom_inlineConfig'] as $key => $value){
                $this->setInlineJsConfig($key, $value);
            }
        }
        
        if(isset($options['attributes'])){
            $this->setAttributes($options['attributes']);
        }
        
        $this->setOption('extended', $extended);
    }
    
    protected $attributes = array(
        'type' => 'text',
    );
}