<?php

namespace SRS\Forms\Factory\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use SRS\Forms\View\Helper\FormRenderer;

class FormRendererFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
<<<<<<< HEAD
        /*echo "FACTORY<br>";
        $renderer = $container->get('renderer.bootstrap');
        $renderer->setGlobalFormConfig($container->get('config')['srs_form']);
        $renderer->init();*/
        
        return new FormRenderer($container);
=======
        $renderer = $container->get('renderer.bootstrap');
        $renderer->setGlobalFormConfig($container->get('config')['srs_form']);
        $renderer->init();
        
        return new FormRenderer($renderer);
>>>>>>> 0ce30c8ff00e9ba4f8cff92e17fa799d47421153
    }
}