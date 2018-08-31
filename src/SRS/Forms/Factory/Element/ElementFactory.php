<?php

namespace \SRS\Forms\Factory\Element;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class ElementFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');
        if (isset($config['srs-forms'])){
            $config = $config['srs-forms'];
        }else{
            $config = [];
        }

        // follow convention that naming consist form name + entity type
        $formName = str_replace("Controller", "", $requestedName);
        $formName = explode('\\', $formName);
        $formName = array_pop($formName);
        $formService = $container->get($formName . 'Service');
        $formFormViewClassName = $this->formViewDefaultNamespace . $formName . 'Form';
        $formView = new $formFormViewClassName;
        return new $requestedName($formService, $formView, $config);
    }
}