<?php

namespace SRS\Forms\View\Helper;

use \Zend\View\Helper\AbstractHelper;
use Interop\Container\ContainerInterface;


class FormRenderer extends AbstractHelper
{
    private $renderer = null;
    private $container = null;
    
    public function __construct(ContainerInterface $container){
        $this->container = $container;        
    }
    
    public function __invoke($form, $formType)
    {
        $this->renderer = $this->container->get($formType);
        $this->renderer->setGlobalFormConfig($this->container->get('config')['srs_form']);        
        $this->renderer->setView($this->view);
        $this->renderer->setFormType($formType);
        
        $this->view->headLink()
                ->appendStylesheet($this->view->basePath('/css/srs_forms.css')."?v=".filemtime(getcwd()."/public/css/srs_forms.css"))
                ->appendStylesheet($this->view->basePath('/js/libs/jquery.periodpicker/build/jquery.periodpicker.css')."?v=".filemtime(getcwd()."/public/js/libs/jquery.periodpicker/build/jquery.periodpicker.css"));
        
        $this->view->headScript()
                ->appendFile($this->view->basePath('/js/libs/tinymce/js/tinymce/tinymce.min.js')."?v=".filemtime(getcwd()."/public/js/libs/tinymce/js/tinymce/tinymce.min.js"))
                ->appendFile($this->view->basePath('/js/libs/jquery.sheepItPlugin.min.js')."?v=".filemtime(getcwd()."/public/js/libs/jquery.sheepItPlugin.min.js"))
                ->appendFile($this->view->basePath('/js/libs/jquery.periodpicker/build/jquery.periodpicker.full.min.js')."?v=".filemtime(getcwd()."/public/js/libs/jquery.periodpicker/build/jquery.periodpicker.full.min.js"))
                ->appendFile($this->view->basePath('/js/srs_forms.js')."?v=".filemtime(getcwd()."/public/js/srs_forms.js"));
        
        if($form) {
            $this->renderer->setForm($form);
        }

        return $this->renderer;

    }
}
