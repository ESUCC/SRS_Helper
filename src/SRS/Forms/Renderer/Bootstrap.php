<?php

namespace SRS\Forms\Renderer;

use SRS\Forms\Renderer;
use SRS\Forms\ExtendedElement;
use Zend\Form\FieldsetInterface;
use Zend\Form\ElementInterface;

class Bootstrap extends Renderer
{
    public function formAction($fieldset)
    {
        return $this->view->partial('bootstrap/formAction.phtml', ['element' => $fieldset]);
    }
    
    public function formElement($element){
        if ($element instanceof ExtendedElement AND $element->getTemplate()) {
            return $this->view->partial('bootstrap/' . $element->getTemplate().'Element.phtml', ['element' => $element, 'renderer' => $this]);
        }
        
        if($element instanceof \SRS\Forms\Element\reCAPTCHA){
            return $this->view->partial('bootstrap/reCAPTCHA.phtml', ['google_captcha_key' => $this->getSRSConfig()['google_recaptcha_site_key']]);
        }
        
        if($element instanceof \SRS\Forms\Element\AutoComplete){
            return $this->view->partial('bootstrap/autoCompleteElement.phtml', ['element' => $element]);
        }
		
        if ($element->getAttribute('type') == 'checkbox'){
                return $this->view->partial('bootstrap/singleCheckboxElement.phtml', ['element' => $element]);
        }
        
        if ($element->getAttribute('type') == 'multi_checkbox' || $element->getAttribute('type') == 'radio') {
            return $this->view->partial('bootstrap/checkboxElement.phtml', ['element' => $element]);
        }
        
        if ($element->getAttribute('type') == 'select' || $element instanceof \DoctrineModule\Form\Element\ObjectSelect) {
            return $this->view->partial('bootstrap/selectElement.phtml', ['element' => $element]);
        }
        
        if ($element->getAttribute('type') == 'textarea') {
            return $this->view->partial('bootstrap/textareaElement.phtml', ['element' => $element]);
        }
        
        if ($element->getAttribute('type') == 'file') {
            return $this->view->partial('bootstrap/fileElement.phtml', ['element' => $element]);
        }

        return $this->view->partial('bootstrap/inputElement.phtml', ['element' => $element]);
    }
    
    public function formGroup($element, $showLabel = true){
        
        if($element instanceOf ExtendedElement) {
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
        }
        
        if ($element instanceof ExtendedElement AND $element->getTemplate()) {
            return $this->view->partial('bootstrap/' . $element->getTemplate().'FormGroup.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }

        if($element instanceof \SRS\Forms\Element\AutoComplete){
            return $this->view->partial('bootstrap/autoCompleteFormGroup.phtml', ['element' => $element, 'showLabel' => $showLabel]);
        }
		
        if ($element->getAttribute('type') == 'checkbox'){
                return $this->view->partial('bootstrap/singleCheckboxFormGroup.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }
        
        if ($element->getAttribute('type') == 'multi_checkbox' || $element->getAttribute('type') == 'radio') {
            return $this->view->partial('bootstrap/checkboxFormGroup.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }
        
        if ($element->getAttribute('type') == 'select' || $element instanceof \DoctrineModule\Form\Element\ObjectSelect) {
            return $this->view->partial('bootstrap/selectFormGroup.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }
        
        if ($element->getAttribute('type') == 'textarea') {
            return $this->view->partial('bootstrap/textareaFormGroup.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }
        
        if ($element->getAttribute('type') == 'file') {
            return $this->view->partial('bootstrap/fileFormGroup.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }

        return $this->view->partial('bootstrap/inputFormGroup.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        //}
    }
    
    
    public function formLabel($element){
        return $this->view->partial('bootstrap/label.phtml', ['element' => $element]);
    }
    
    public function form1Col($element){
        $this->normalizeElement($element);
        
        if($element instanceOf ExtendedElement) {
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
        }
        
        if ($element instanceof ExtendedElement AND $element->getTemplate()) {
            return $this->view->partial('bootstrap/' . $element->getTemplate().'_1col.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }
        
        $resolver = $this->serviceManager->get('Zend\View\Resolver\TemplatePathStack');
        if($resolver->resolve('bootstrap/'.$element->getAttribute('type').'_1col.phtml'))
            return $this->view->partial('bootstrap/'.$element->getAttribute('type').'_1col.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        else
            return $this->view->partial('bootstrap/input_1col.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
    }
    
    public function form2Col($element){
        $this->normalizeElement($element);
        
        if($element instanceOf ExtendedElement) {
           if(isset($this->globalFormConfig[get_class($element)])){
                $element->injectGlobalConfig(
                    $this->globalFormConfig[get_class($element)]
                );
            }
            $this->extractExtendedElementData($element);
            $element->injectSettings($this->getSettings());
        }
        
        if ($element instanceof ExtendedElement AND $element->getTemplate()) {
            return $this->view->partial('bootstrap/' . $element->getTemplate().'_2col.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }

        $resolver = $this->serviceManager->get('Zend\View\Resolver\TemplatePathStack');
        if($resolver->resolve('bootstrap/'.$element->getAttribute('type').'_2col.phtml'))
            return $this->view->partial('bootstrap/'.$element->getAttribute('type').'_2col.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        else
            return $this->view->partial('bootstrap/input_2col.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
    }

    public function formRow($element, $showLabel = true)
    {
        $type = "Responsive";
        
        $this->normalizeElement($element);
        
        if($element instanceOf ExtendedElement) {
            if(isset($this->globalFormConfig[get_class($element)])){
                $element->injectGlobalConfig(
                        $this->globalFormConfig[get_class($element)]
                );
            }
            $this->extractExtendedElementData($element);
            $element->injectSettings($this->getSettings());
        }
        
        
        if ($element instanceof ExtendedElement && $element->getTemplate()) {
            return $this->view->partial('bootstrap/' . $element->getTemplate().$type.'.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }
		
        if ($element->getAttribute('type') == 'checkbox'){
                return $this->view->partial('bootstrap/single_checkbox.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }

        if ($element->getAttribute('type') == 'multi_checkbox' || $element->getAttribute('type') == 'radio') {
            return $this->view->partial('bootstrap/checkbox.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }

        if ($element->getAttribute('type') == 'select') {
            return $this->view->partial('bootstrap/select'.$type.'.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }


        if ($element->getAttribute('type') == 'textarea') {
            return $this->view->partial('bootstrap/textarea'.$type.'.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }
		
        return $this->view->partial('bootstrap/input'.$type.'.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
    }
    
    public function formResponsive($element){
        $this->normalizeElement($element);
        
        if($element instanceOf ExtendedElement) {
            if(isset($this->globalFormConfig[get_class($element)])){
                $element->injectGlobalConfig(
                        $this->globalFormConfig[get_class($element)]
                );
            }
            $this->extractExtendedElementData($element);
            $element->injectSettings($this->getSettings());
        }
                
        if ($element instanceof ExtendedElement AND $element->getTemplate()) {
            return $this->view->partial('bootstrap/' . $element->getTemplate().'Responsive.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }
		
        if ($element->getAttribute('type') == 'checkbox'){
                return $this->view->partial('bootstrap/singleCheckboxResponsive.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }

        if ($element->getAttribute('type') == 'multi_checkbox' || $element->getAttribute('type') == 'radio') {
            return $this->view->partial('bootstrap/checkboxResponsive.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }

        if ($element->getAttribute('type') == 'select') {
            return $this->view->partial('bootstrap/selectResponsive.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }


        if ($element->getAttribute('type') == 'textarea') {
            return $this->view->partial('bootstrap/textareaResponsive.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }
		
        return $this->view->partial('bootstrap/inputResponsive.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
    }
    
    public function formCaptcha($element)
    {
        $this->normalizeElement($element);
        return $this->view->partial('bootstrap/captcha.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
    }

    public function formCollection($element)
    {

        $renderer = $this->getView();

        if (!method_exists($renderer, 'plugin')) {
            // Bail early if renderer is not pluggable
            return '';
        }

        $markup = '';
        $escapeHtmlHelper = $this->getEscapeHtmlHelper();

        foreach ($element->getIterator() as $elementOrFieldset) {
            if ($elementOrFieldset instanceof FieldsetInterface) {
                $markup .= $this->formCollection($elementOrFieldset);
            } elseif ($elementOrFieldset instanceof ElementInterface) {
                $markup .= $this->formRow($elementOrFieldset);
            }
        }

        // Every collection is wrapped by a fieldset if needed
        if ($this->shouldWrap) {
            $label = $element->getLabel();
            if (!empty($label)) {
                $label = $escapeHtmlHelper($label);
                $markup = sprintf(
                    '<fieldset><legend>%s</legend>%s</fieldset>', $label, $markup
                );
            }
        }

        return $markup;
        
    }

}
