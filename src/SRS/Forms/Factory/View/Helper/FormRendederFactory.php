<?php

namespace SRS\Forms\Factory\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use SRS\Forms\View\Helper\FormRenderer;

class FormRendererFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {        
        return new FormRenderer($container);
    }
}