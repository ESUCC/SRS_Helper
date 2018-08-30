<?php

namespace SRS\Forms\Renderer;

use SRS\Forms\Renderer;
use SRS\Forms\ExtendedElement;

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

    public function formLabelCol($element, $col){
        return $this->view->partial('bootstrap/labelCol.phtml', ['element' => $element, 'colsLabel' => $col]);
    }

    public function formRow($element, $colsLabel, $colsElement)
    {
        $type = 'v_row';
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
            return $this->view->partial('bootstrap/' . $element->getTemplate().$type.'.phtml', ['element' => $element, 'renderer' => $this, 'colsLabel' => $colsLabel, 'colsElement' => $colsElement]);
        }
		
        if ($element->getAttribute('type') == 'checkbox'){
                return $this->view->partial('bootstrap/single_checkbox.phtml', ['element' => $element, 'renderer' => $this, 'colsLabel' => $colsLabel, 'colsElement' => $colsElement]);
        }

        if ($element->getAttribute('type') == 'multi_checkbox' || $element->getAttribute('type') == 'radio') {
            return $this->view->partial('bootstrap/checkbox.phtml', ['element' => $element, 'renderer' => $this, 'colsLabel' => $colsLabel, 'colsElement' => $colsElement]);
        }

        if ($element->getAttribute('type') == 'select') {
            return $this->view->partial('bootstrap/select'.$type.'.phtml', ['element' => $element, 'renderer' => $this, 'colsLabel' => $colsLabel, 'colsElement' => $colsElement]);
            return $this->view->partial('bootstrap/' . $element->getTemplate().$type.'.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
        }


        if ($element->getAttribute('type') == 'textarea') {
            return $this->view->partial('bootstrap/textarea'.$type.'.phtml', ['element' => $element, 'renderer' => $this, 'colsLabel' => $colsLabel, 'colsElement' => $colsElement]);
        }
		
        return $this->view->partial('bootstrap/input'.$type.'.phtml', ['element' => $element, 'renderer' => $this, 'colsLabel' => $colsLabel, 'colsElement' => $colsElement]);
    }
}
