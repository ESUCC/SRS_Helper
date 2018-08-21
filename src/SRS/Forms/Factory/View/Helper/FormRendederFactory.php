<?php

namespace SRS\Forms\Factory\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Makersoft\Forms\View\Helper\FormRenderer;

class FormRendererFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $renderer = $container->get('renderer.bootstrap');
        $renderer->init();
        
        return new FormRenderer($renderer);
    }
}