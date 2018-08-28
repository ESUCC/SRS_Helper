<?php

namespace SRS\Forms;

use Zend\Form\Element;

class ExtendedElement extends Element implements ExtendedElementInterface
{

    public $localConfig = array();
    public $settings = array();
    protected $serviceManager;
    protected $custom_inlineConfig = array();

    public function getJs()
    {
        return (isset($this->localConfig['js'])) ? $this->localConfig['js'] : false;
    }

    public function getCss()
    {
        return (isset($this->localConfig['css'])) ? $this->localConfig['css'] : false;
    }

    public function getInlineJs()
    {
        return (isset($this->localConfig['inlineJs'])) ? $this->localConfig['inlineJs'] : false;
    }
    
    public function setInlineJs($inlineJs){
        $this->localConfig['inlineJs'] = $this->getInlineJs().$inlineJs;
    }

    public function getInlineJsConfig()
    {
        if($this->localConfig['inlineJsConfig']){
            foreach($this->localConfig['inlineJsConfig'] as $key => $value){
                $this->localConfig['inlineJsConfig'][$key] = sprintf($value, $this->getName());
            }
        }
        return (isset($this->localConfig['inlineJsConfig'])) ? $this->localConfig['inlineJsConfig'] : false;
    }
    
    public function setInlineJsConfig($key, $value){
        $this->custom_inlineConfig[$key] = $value;
    }

    public function getTemplate()
    {
        return (isset($this->localConfig['template'])) ? $this->localConfig['template'] : false;
    }

    public function getJsHolderName()
    {
        return $this->settings['jsPlaceholderName'];
    }

    public function injectGlobalConfig($config)
    {
        if (is_array($config)) {
            if(is_array($this->getOption('extended')))
                $this->localConfig = array_replace_recursive($config, $this->getOption('extended'));
            
            if(isset($config['extended']) AND is_array($config['extended'])) {
                unset($this->localConfig['extended']);
                $this->options['extended'] = array_replace_recursive($config['extended'], $this->options['extended']);
            }

        } else {
            $this->localConfig = $this->getOption('extended');
        }      
        if(isset($this->localConfig['inlineJsConfig'])){
            $this->localConfig['inlineJsConfig'] = array_merge($this->localConfig['inlineJsConfig'], $this->custom_inlineConfig);
        }
        else
            $this->localConfig['inlineJsConfig'] = $this->custom_inlineConfig;

    }

    public function injectSettings($settings)
    {
        if(is_array($settings)) {
            $this->settings = $settings;
        }
    }

}