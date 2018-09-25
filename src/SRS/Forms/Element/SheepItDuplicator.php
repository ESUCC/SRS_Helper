<?php

namespace SRS\Forms\Element;

use SRS\Forms\ExtendedElement;

class SheepItDuplicator extends ExtendedElement
{
    protected $init_data = null;
    protected $disabled = false;
    protected $default_selector = "";
    public $note = "";
    
    public function __construct($name = null, $options = []){
        parent::__construct($name, $options);
        
        $this->setAttribute('id', $name);

    }
    
    public function addNote($note){
        $this->note = $note;
    }
    
    public function initData($init_data = null){
        //return '';
        if($init_data){
            $this->init_data = "$(document).ready(function(){";
            $this->init_data .= 'window.'.$this->getName().'_sheepit_obj.addNForms('.count($init_data).');';
            for($i = 1; $i <= count($init_data); $i++){
                $template = $init_data[$i-1]['template'];
                unset($init_data[$i-1]['template']);
                
                foreach($init_data[$i-1] as $key => $value){
                    $value = str_replace('"', '\"', $value);
                    if($value != ""){
                    $this->init_data .= 'if($("input[name=\''.$this->getName().'['.$template.']['.$i.']['.$key.']\']").length == 1 '
                            . '|| $("select[name=\''.$this->getName().'['.$template.']['.$i.']['.$key.']\']").length == 1'
                            . '|| $("textarea[name=\''.$this->getName().'['.$template.']['.$i.']['.$key.']\']").length == 1){';
                        $this->init_data .= ''
                                . '$("#'.$this->getName().'_'.$template.'_'.$i.'_'.$key.'").val("'.preg_replace( "/\r|\n/", "", $value).'");'
                                . '}';
                    $this->init_data .= 'else{'
                            . '$("input[name=\''.$this->getName().'['.$template.']['.$i.']['.$key.']\'][value!=\''.preg_replace( "/\r|\n/", "", $value).'\']").removeAttr("checked");'
                            . '$("input[name=\''.$this->getName().'['.$template.']['.$i.']['.$key.']\'][value=\''.preg_replace( "/\r|\n/", "", $value).'\']").attr("checked", "checked");'
                            . '}';
                    }
                }
            }
            $this->init_data .= '});';
            return $this;
        }
        return $this->init_data;
    }
    
    
    protected $attributes = array(
        'type' => 'sheepitduplicator',
    );
    
    private $close_button = false;
    public function closeButton($boolean = null){
        if($boolean === null) return $this->close_button;
        $this->close_button = $boolean;
        return $this;
    }
    
    protected $forms = array();
    public function addForm($form, $label_selector = 'default', $template = null){
        $form_name = $form->getAttribute('name');
        if($this->default_selector == ""){ $this->default_selector = $form_name; }
        foreach($form as $e){
            $e->setAttribute('id', $this->getName().'_'.$form_name.'_m_index_m_'.$e->getName());
            $e->setName($this->getName()."[$form_name][m_index_m][".$e->getName()."]");
            if(in_array($e->getAttribute('type'), ['radio', 'Radio'])){
                $e->setAttribute('class', 'sheepItField');
            }
        }
            
        $this->forms[$form_name] = [$form, $template];
        
    }

    public function getForms(){
        return $this->forms;
    }
    
    
    public function getForm($formName = null){
        if(!$formName){ $formName = $this->default_selector; }
        if(!isset($this->forms[$formName])){ return null; }
        return $this->forms[$formName][0];
    }
    
    protected $max_forms = 0;
    public function maxForms($max_forms = NULL){
        if($max_forms  !== NULL){
            $this->max_forms = $max_forms;
            return $this;
        }
        return $this->max_forms;
    }
    
    protected $min_forms = 0;
    public function minForms($min_forms = NULL){
        if($min_forms  !== NULL){
            $this->min_forms = $min_forms;
            return $this;
        }
        return $this->min_forms;
    }
    
    protected $ini_forms = 0;
    public function iniForms($ini_forms = NULL){
        if($ini_forms !== NULL){
            $this->ini_forms = $ini_forms;
            return $this;
        }
        return $this->ini_forms;
    }
    	
    public function render($view){
        $html = "";
        foreach($this->forms as $key => $value){
            $template = ($value[1] ? $value[1] : 'bootstrap/template_sheepitduplicator.phtml');
            $html .= $view->partial($template, ['form' => $value[0], 'sheep_it_element' => $this]);
        }
        return $html;
    }

    protected $singular_label = "";
    public function singularLabel($singular_label = null){
        if($singular_label){
            $this->singular_label = $singular_label;
                return $this;
        }
        return $this->singular_label;
    }
    
    public function setDisabled($disabled){
        $this->disabled = $disabled;
    }
    
    public function getDisabled(){
        return $this->disabled;
    }
    
    function getSelector(){
        return $this->default_selector;
    }
    
    public function renderDataOptions(){
        $html = "";
        
        $html .= ' data-min-forms="'.$this->minForms().'"';
        $html .= ' data-ini-forms="'.$this->iniForms().'"';
        $html .= ' data-template="'.$this->getName().'"';
        $html .= ' data-disabled="'.($this->getDisabled() ? "true" : "false").'"';
        $html .= ' data-max-forms="'.$this->maxForms().'"';
        $html .= ' data-selector="'.$this->getSelector().'"';
        
        return $html;
    }
}