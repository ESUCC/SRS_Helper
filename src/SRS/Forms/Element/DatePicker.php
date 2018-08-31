<?php

namespace SRS\Forms\Element;

use SRS\Forms\ExtendedElement;

class DatePicker extends ExtendedElement
{    
    public function __construct($name = null, $options = []){
        parent::__construct($name, $options);
        
        $this->setAttribute('id', $name);
        
        $extended = $this->getOption('extended');
        if(!$extended){
            $extended = [];
        }
        
        
        if(!isset($extended['date-format'])){
            $extended['date-format'] = 'mm/dd/yyyy';
        }
        
        $this->setOption('extended', $extended);
    }
    
    protected $attributes = array(
        'type' => 'text',
    );
}