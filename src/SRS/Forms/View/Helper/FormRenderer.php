<?php

namespace Makersoft\Forms\View\Helper;

use \Zend\View\Helper\AbstractHelper;

class FormRenderer extends AbstractHelper
{
    private $renderer = null;
    
    public function __construct(\Makersoft\Forms\Renderer $renderer){
        $this->renderer = $renderer;        
    }
    
    public function __invoke($form = null, $formType)
    {
        $this->renderer->setView($this->view);
        $this->renderer->setFormType($formType);
        
        if($form) {
            $this->renderer->setForm($form);
        }

        return $this->renderer;

    }
}
