<?php

namespace SRS\Forms;

use Zend\Form\Form;
use Zend\Form\View\Helper\FormElement;
use Zend\Form\View\Helper\FormLabel;
use Zend\Form\View\Helper\FormElementErrors;
use Zend\View\Helper\EscapeHtml;
use Zend\View\Helper\EscapeHtmlAttr;

class Renderer
{
    public $view = false;
    protected $serviceManager;
    public $_form;
    public $_formStyle;
    public $shouldWrap = true;

    public $localConfig = array();
    public $globalFormConfig = array();
    
    protected $escapeHtmlHelper;
    private $prepared = false;
    protected $form_type = '';
    protected $jsCodeAfter = '';
    
    public function addJsCodeAfter($jsCode){
        $this->jsCodeAfter .= $jsCode;
    }
    
    public function setFormType($formType){
        $this->form_type = $formType;
    }

    public function setFormStyle($formStyle)
    {
        $this->_formStyle = $formStyle;
        return $this;
    }

    public function setForm(Form $form)
    {
        $this->_form = $form;
        $this->_form->setAttribute('novalidate', 'novalidate');
        return $this;
    }

    public function getForm()
    {
        return $this->_form;
    }

    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    public function getView()
    {
        return $this->view;
    }

    public function getCss()
    {
        return (isset($this->localConfig['css'])) ? $this->localConfig['css'] : false;
    }

    public function getJs()
    {
        return (isset($this->localConfig['js'])) ? $this->localConfig['js'] : false;
    }

    public function getSettings()
    {
        return (isset($this->globalFormConfig['settings'])) ? $this->globalFormConfig['settings'] : false;
    }

    public function getJsHolderName()
    {
        return $this->globalFormConfig['settings']['jsPlaceholderName'];
    }

    public function getElementJsContent()
    {
        return '/**start getElementJsContent**/'.$this->view->placeholder($this->getJsHolderName()).'$(document).ready(function(){'.$this->jsCodeAfter.'});/**end getElementJsContent**/';
    }

    public function prepareRenderer()
    {
        if ($this->getCss() && $this->view) {
            foreach ($this->getCss() as $c) {
                $this->view->headLink()->appendStylesheet($c);
            }
        }
        if ($this->getJs() && $this->view) {
            foreach ($this->getJs() as $j) {
                $this->view->headScript()->appendFile($j, 'text/javascript');
            }
        }
    }

    public function prepare()
    {
        if(!$this->prepared)
        {
            $class = '';
            switch($this->form_type)
            {
                case 'responsive':
                    break;
                case 'horizontal':
                    $class = 'form-horizontal';
                    break;
                case 'vertical':
                    $class = 'form-vertical';
                    break;
            }

            $this->prepareRenderer();
            $this->_form->setAttribute('class', $this->_form->getAttribute('class').' '.$class);
            $this->_form->prepare();
            $this->prepared = true;
        }
    }

    public function openTag()
    {
        if(!$this->_form->hasAttribute('target')){
            $this->_form->setAttribute("onsubmit", $this->_form->getName()."_form_js.submit(); return false;");
        }
        return $this->view->form()->openTag($this->_form);
    }

    public function closeTag()
    {
        return $this->view->form()->closeTag();
    }

    public function extractExtendedElementData($element)
    {

        if ($element instanceOf ExtendedElement && $this->view) {

            $js = $element->getJs();
            if(is_array($js)) {
                foreach ($js as $j) {
                    $this->view->headScript()->appendFile($j, 'text/javascript');
                }
            }

            $css = $element->getCss();
            if (is_array($css)) {
                foreach ($css as $c) {
                    $this->view->headLink()->appendStylesheet($c);
                }
            }

            $inlineJs = $element->getInlineJs();
            if (strlen($inlineJs) > 0) {
                $script = sprintf($inlineJs, $element->getAttribute('id'), JsConfigRenderer::encode($element->getInlineJsConfig()));
                
                preg_match_all('/"function[^"]*"/', $script, $matches);
                if(isset($matches[0])){
                    foreach($matches[0] as $match){
                        $script = str_replace($match, str_replace('\\u0027', "'", substr($match, 1, -1)), $script);
                    }
                }

                $this->view->placeholder($this->getJsHolderName())
                    ->append($script);
            }

        }

    }

    public function normalizeElement($element)
    {
        if (!$element->getAttribute('id')) {
            $element->setAttribute('id', $this->getView()->slugify($element->getName()));
        }
    }

    public function formRow($element, $colsLabel, $colsElement)
    {
        // implement it in the specific renderer
    }

    public function formCollection($element)
    {
        // implement it in the specific renderer
    }

    public function formCaptcha($element)
    {
        // implement it in the specific renderer
    }
    
    public function formElement($element){
        // implement it in the specific renderer
    }

    public function formHidden($element)
    {
        return $this->view->formHidden($element);
    }

    /**
     * Retrieve the FormLabel helper
     *
     * @return FormLabel
     */

    protected function getLabelHelper()
    {
        if ($this->labelHelper) {
            return $this->labelHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->labelHelper = $this->view->plugin('form_label');
        }

        if (!$this->labelHelper instanceof FormLabel) {
            $this->labelHelper = new FormLabel;
        }

        return $this->labelHelper;
    }

    /**
     * Retrieve the FormElement helper
     *
     * @return FormElement
     */

    protected function getElementHelper()
    {
        if ($this->elementHelper) {
            return $this->elementHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->elementHelper = $this->view->plugin('form_element');
        }

        if (!$this->elementHelper instanceof FormElement) {
            $this->elementHelper = new FormElement;
        }

        return $this->elementHelper;
    }

    /**
     * Retrieve the FormElementErrors helper
     *
     * @return FormElementErrors
     */

    protected function getElementErrorsHelper()
    {
        if ($this->elementErrorsHelper) {
            return $this->elementErrorsHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->elementErrorsHelper = $this->view->plugin('form_element_errors');
        }

        if (!$this->elementErrorsHelper instanceof FormElementErrors) {
            $this->elementErrorsHelper = new FormElementErrors();
        }

        return $this->elementErrorsHelper;
    }

    /**
     * Retrieve the escapeHtml helper
     *
     * @return EscapeHtml
     */

    protected function getEscapeHtmlHelper()
    {
        if ($this->escapeHtmlHelper) {
            return $this->escapeHtmlHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->escapeHtmlHelper = $this->view->plugin('escapehtml');
        }

        if (!$this->escapeHtmlHelper instanceof EscapeHtml) {
            $this->escapeHtmlHelper = new EscapeHtml();
        }

        return $this->escapeHtmlHelper;
    }

    /**
     * Retrieve the escapeHtmlAttr helper
     *
     * @return EscapeHtmlAttr
     */

    protected function getEscapeHtmlAttrHelper()
    {
        if ($this->escapeHtmlAttrHelper) {
            return $this->escapeHtmlAttrHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->escapeHtmlAttrHelper = $this->view->plugin('escapehtmlattr');
        }

        if (!$this->escapeHtmlAttrHelper instanceof EscapeHtmlAttr) {
            $this->escapeHtmlAttrHelper = new EscapeHtmlAttr();
        }

        return $this->escapeHtmlAttrHelper;
    }
    
    private $makersoft_config = null;
    protected function getSRSConfig(){
        return $this->makersoft_config;
    }
            
    public function setSRSConfig($makersoft_config){
        $this->makersoft_config = $makersoft_config;
    }
    
    function getGlobalFormConfig() {
        return $this->globalFormConfig;
    }

    function setGlobalFormConfig($globalFormConfig) {
        $this->globalFormConfig = $globalFormConfig;
    }

    public function init(){
        if (array_key_exists(get_class($this), $this->globalFormConfig)) {
            $this->localConfig = $this->globalFormConfig[get_class($this)];
        }
        return $this;
    }
    
    protected function initExtendedElement($element){
        if(!$element->inialized_Extended){
            if(!$element->getOption('extended')){
                $element->setOption('extended', []);
            }

            if(isset($this->globalFormConfig[get_class($element)])){
                $element->injectGlobalConfig(
                    $this->globalFormConfig[get_class($element)]
                );
            }
            $this->extractExtendedElementData($element);
            $element->injectSettings($this->getSettings());
            $element->inialized_Extended = true;
        }
    }
}
