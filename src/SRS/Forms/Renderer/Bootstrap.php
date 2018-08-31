<?php

namespace SRS\Forms\Renderer;

use SRS\Forms\Renderer;
use SRS\Forms\ExtendedElement;

class Bootstrap extends Renderer
{   
    public function formElement($element){
        if($element instanceOf ExtendedElement) {
            $this->initExtendedElement($element);
        }
        
        if ($element instanceOf ExtendedElement && $element->getTemplate()) {
            return $this->view->partial('bootstrap/' . $element->getTemplate().'Element.phtml', ['element' => $element, 'renderer' => $this]);
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

        return $this->view->partial('bootstrap/inputElement.phtml', ['element' => $element]);
    }
    
    public function formGroup($element, $showLabel = true){
        
        if($element instanceOf ExtendedElement) {
            $this->initExtendedElement($element);
        }
        
        if ($element instanceof ExtendedElement && $element->getTemplate()) {
            return $this->view->partial('bootstrap/' . $element->getTemplate().'FormGroup.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
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

        return $this->view->partial('bootstrap/inputFormGroup.phtml', ['element' => $element, 'renderer' => $this, 'showLabel' => $showLabel]);
    }
    
    
    public function formLabel($element){
        return $this->view->partial('bootstrap/label.phtml', ['element' => $element]);
    }

    public function formLabelCol($element, $col){
        return $this->view->partial('bootstrap/labelCol.phtml', ['element' => $element, 'colsLabel' => $col]);
    }

    public function formRow($element, $colsLabel, $colsElement)
    {
        $this->normalizeElement($element);
        
        if($element instanceOf ExtendedElement) {
            $this->initExtendedElement($element);
        }
		
        return $this->view->partial('bootstrap/v_row.phtml', ['element' => $element, 'renderer' => $this, 'colsLabel' => $colsLabel, 'colsElement' => $colsElement]);
    }
}
